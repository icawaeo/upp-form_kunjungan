<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use Illuminate\Http\Request;
use PDF; 

class KunjunganController extends Controller
{
    public function create()
    {
        return view('kunjungan.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tanggal' => 'required|date',
            'nama_lengkap' => 'required|string|max:255',
            'alamat' => 'required|string',
            'jam_datang' => 'required',
            'jam_kembali' => 'required',
            'keperluan' => 'required|string|max:255',
            'nomor_kendaraan' => 'required|string|max:20',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048', 
        ]);

        if ($request->hasFile('foto')) {
            $namaFile = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('fotos'), $namaFile);
            $validatedData['foto'] = 'fotos/' . $namaFile;
        }

        Kunjungan::create($validatedData);

        return redirect('/')->with('success', 'Terima kasih! Data kunjungan Anda telah berhasil dikirim.');
    }

    public function index(Request $request)
    {
        $targetDate = $request->input('tanggal') ?: now()->format('Y-m-d');

        $visitorCount = Kunjungan::whereDate('tanggal', $targetDate)->count();

        $kunjungansQuery = Kunjungan::query()->whereDate('tanggal', $targetDate);

        if ($request->filled('nama_lengkap')) {
            $kunjungansQuery->where('nama_lengkap', 'like', '%' . $request->nama_lengkap . '%');
        }

        $kunjungans = $kunjungansQuery->latest()->paginate(10)->withQueryString();

        $displayDate = \Carbon\Carbon::parse($targetDate)->translatedFormat('d F Y');

        return view('admin.kunjungan.index', compact('kunjungans', 'visitorCount', 'displayDate'));
    }

    public function report(Request $request)
    {
        $query = Kunjungan::query();
        $filterType = $request->get('filter_type', 'harian');
        $date = $request->get('date');
        $month = $request->get('month');

        if ($filterType == 'harian' && $date) {
            $query->whereDate('tanggal', $date);
            $period = \Carbon\Carbon::parse($date)->translatedFormat('d F Y');
        } elseif ($filterType == 'bulanan' && $month) {
            $query->whereYear('tanggal', \Carbon\Carbon::parse($month)->year)
                  ->whereMonth('tanggal', \Carbon\Carbon::parse($month)->month);
            $period = \Carbon\Carbon::parse($month)->translatedFormat('F Y');
        } else {
            $date = now()->format('Y-m-d');
            $query->whereDate('tanggal', $date);
            $period = now()->translatedFormat('d F Y');
        }

        $kunjungans = $query->latest()->get();

        return view('admin.kunjungan.report', compact('kunjungans', 'period', 'filterType', 'date', 'month'));
    }

    public function cetakPdf(Request $request)
    {
        $query = Kunjungan::query();
        $filterType = $request->get('filter_type', 'harian');
        $date = $request->get('date');
        $month = $request->get('month');
        $period = '';
        $title = 'Laporan Kunjungan Tamu';

        if ($filterType == 'harian' && $date) {
            $query->whereDate('tanggal', $date);
            $period = "Tanggal: " . \Carbon\Carbon::parse($date)->translatedFormat('d F Y');
            $title .= " Harian";
        } elseif ($filterType == 'bulanan' && $month) {
            $query->whereYear('tanggal', \Carbon\Carbon::parse($month)->year)
                  ->whereMonth('tanggal', \Carbon\Carbon::parse($month)->month);
            $period = "Bulan: " . \Carbon\Carbon::parse($month)->translatedFormat('F Y');
            $title .= " Bulanan";
        }

        $kunjungans = $query->latest()->get();

        $pdf = PDF::loadView('admin.kunjungan.pdf', compact('kunjungans', 'title', 'period'));
        
        $fileName = 'laporan-kunjungan-' . Str::slug($period) . '.pdf';
        
        return $pdf->stream($fileName); 
    }
}