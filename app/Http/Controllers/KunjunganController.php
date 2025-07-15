<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use Illuminate\Http\Request;

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
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048', // maks 2MB
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
        // Tentukan tanggal target. Default ke hari ini jika tidak ada input.
        $targetDate = $request->input('tanggal') ?: now()->format('Y-m-d');

        // Hitung total pengunjung untuk tanggal target.
        $visitorCount = Kunjungan::whereDate('tanggal', $targetDate)->count();

        // Query untuk tabel, sudah difilter berdasarkan tanggal.
        $kunjungansQuery = Kunjungan::query()->whereDate('tanggal', $targetDate);

        // Terapkan filter nama jika ada.
        if ($request->filled('nama_lengkap')) {
            $kunjungansQuery->where('nama_lengkap', 'like', '%' . $request->nama_lengkap . '%');
        }

        // Ambil data dengan paginasi dan pastikan parameter filter tetap ada di link pagination.
        $kunjungans = $kunjungansQuery->latest()->paginate(10)->withQueryString();

        // Format tanggal untuk ditampilkan di view.
        $displayDate = \Carbon\Carbon::parse($targetDate)->translatedFormat('d F Y');

        return view('admin.kunjungan.index', compact('kunjungans', 'visitorCount', 'displayDate'));
    }
}