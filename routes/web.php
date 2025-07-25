<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KunjunganController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;

Route::get('/', [KunjunganController::class, 'create'])->name('kunjungan.create');
Route::post('/kunjungan', [KunjunganController::class, 'store'])->name('kunjungan.store');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/kunjungan', [KunjunganController::class, 'index'])->name('kunjungan.index');
    Route::get('/kunjungan/laporan', [KunjunganController::class, 'report'])->name('kunjungan.report');
    Route::get('/kunjungan/cetak_pdf', [KunjunganController::class, 'cetakPdf'])->name('kunjungan.cetak_pdf');
    Route::delete('/kunjungan/{kunjungan}', [KunjunganController::class, 'destroy'])->name('kunjungan.destroy');

    Route::get('/user', [AdminController::class, 'index'])->name('user.index');
    Route::post('/user', [AdminController::class, 'store'])->name('user.store');
    Route::get('/user/{user}/edit', [AdminController::class, 'edit'])->name('user.edit');
    Route::put('/user/{user}', [AdminController::class, 'update'])->name('user.update');
    Route::delete('/user/{user}', [AdminController::class, 'destroy'])->name('user.destroy');
});