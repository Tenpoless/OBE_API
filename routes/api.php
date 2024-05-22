<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EvaluasiController;
use App\Http\Controllers\HalamanUtamaController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/evaluasi', EvaluasiController::class);

Route::middleware('api')->group(function () {
    // Route untuk menampilkan hanya nama dosen
    Route::get('/halaman-utama-nama/{id}', [HalamanUtamaController::class, 'getNamaDosen']);

    // Route untuk menampilkan nama dosen, email, dan nomor telepon
    Route::get('/halaman-utama-profile/{id}', [HalamanUtamaController::class, 'getProfileDosen']);
});