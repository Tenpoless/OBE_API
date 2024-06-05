<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HalamanUtamaController;
use App\Http\Controllers\EvaluasiMahasiswaController;
use App\Http\Controllers\EvaluasiMahasiswaDataController;
use App\Http\Controllers\EvaluasiMahasiswaDetailController;

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:api')->group(function () {
    // Route untuk menampilkan hanya nama dosen - SCR2.1
    Route::get('/halaman-utama-nama', [HalamanUtamaController::class, 'getNamaDosen']);

    // Route untuk menampilkan nama dosen, email, dan nomor telepon - SCR2.2
    Route::get('/halaman-utama-profile', [HalamanUtamaController::class, 'getProfileDosen']);
    
    // Route untuk mendapatkan mahasiswa berdasarkan dosen ID - SCR5.1
    Route::get('/evaluasi-mahasiswa-detail/{id_user}', [EvaluasiMahasiswaDetailController::class, 'show']);

    // Route untuk mendapatkan detail mahasiswa berdasarkan mahasiswa ID - SCR5.2
    Route::get('/evaluasi-mahasiswa-detail/{id}', [EvaluasiMahasiswaDetailController::class, 'getEvaluasiDetailsByUserId']);

    // Route untuk mendapatkan hasil hitung nilai mahasiswa berdasarkan mahasiswa ID
    Route::patch('hitung/{id_user}', [EvaluasiMahasiswaDetailController::class, 'hitungByUserId']);
});
