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
    // Route untuk menampilkan daftar data dosen
    Route::get('/halaman-utama', [HalamanUtamaController::class, 'index']);
    
    // Route untuk menampilkan data dosen berdasarkan ID
    Route::get('/halaman-utama/{id}', [HalamanUtamaController::class, 'show']);
});