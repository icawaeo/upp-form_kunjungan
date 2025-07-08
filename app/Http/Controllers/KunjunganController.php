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
        $query = Kunjungan::query();

        if ($request->has('nama_lengkap') && $request->nama_lengkap != '') {
            $query->where('nama_lengkap', 'like', '%' . $request->nama_lengkap . '%');
        }

        if ($request->has('tanggal') && $request->tanggal != '') {
            $query->whereDate('tanggal', $request->tanggal);
        }

        $kunjungans = $query->latest()->paginate(10);

        return view('admin.kunjungan.index', compact('kunjungans'));
    }
}