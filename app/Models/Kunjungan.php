<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'nama_lengkap',
        'instansi',
        'alamat',
        'jam_datang',
        // 'jam_kembali',
        'keperluan',
        'nomor_kendaraan',
        'foto',
    ];
}