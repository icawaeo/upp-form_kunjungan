<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KunjunganController;

Route::get('/', [KunjunganController::class, 'create'])->name('kunjungan.create');

Route::post('/kunjungan', [KunjunganController::class, 'store'])->name('kunjungan.store');
Route::get('/admin/kunjungan', [KunjunganController::class, 'index'])->name('admin.kunjungan.index');