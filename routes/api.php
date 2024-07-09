<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CplController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SubCpmkController;
use App\Http\Controllers\EvaluasiController;
use App\Http\Controllers\DetailRpsController;
use App\Http\Controllers\MatkulCplController;
use App\Http\Controllers\PengampuMkController;
use App\Http\Controllers\HalamanUtamaController;
use App\Http\Controllers\EvaluasiMahasiswaController;
use App\Http\Controllers\EvaluasiMahasiswaDataController;
use App\Http\Controllers\EvaluasiMahasiswaDetailController;

//screen 1
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // screen 2
    Route::get('/halaman-utama-nama', [HalamanUtamaController::class, 'getNamaDosen']);
    Route::get('/halaman-utama-profile', [HalamanUtamaController::class, 'getProfileDosen']);

    // screen 3
    Route::get('/matkul', [PengampuMkController::class, 'show']);
    Route::get('/matkul/{id_matkul}/{id_pengampu}', [PengampuMkController::class, 'showMatkul']);

    // screen 4
    Route::get('/detailrps/minggu/{id_matkul}', [DetailRpsController::class, 'showMinggu']);
    Route::get('/evaluasi/{id_matkul}/{id_detailrps}/{id_evaluasi}', [EvaluasiController::class, 'showEvaluasi']);
    Route::get('/subcpmk/{id_detailrps}', [SubCpmkController::class, 'showSubcpmk']);
    Route::post('/evaluasi', [EvaluasiController::class, 'store']);
    Route::put('/evaluasi/{id_evaluasi}', [EvaluasiController::class, 'update']);
    Route::delete('/evaluasi/{id_evaluasi}', [EvaluasiController::class, 'destroy']);

    // screen 5
    Route::get('/mahasiswa-by-matkul/{id_matkul}', [EvaluasiMahasiswaDataController::class, 'showByMatkul']);
    Route::get('/evaluasi-mahasiswa-detail/{id_user}', [EvaluasiMahasiswaDetailController::class, 'getByUserId']);
    Route::post('/evaluasi-mahasiswa-detail/{id_user}/{id_matkul}', [EvaluasiMahasiswaDetailController::class, 'store']);
    Route::put('/evaluasi-mahasiswa-detail/{id_user}/{id_matkul}/{id_evaluasimhs}', [EvaluasiMahasiswaDetailController::class, 'update']);
    Route::delete('/evaluasi-mahasiswa-detail/{id_user}/{id_matkul}/{id_evaluasimhs}', [EvaluasiMahasiswaDetailController::class, 'destroy']);
    Route::post('/evaluasi_mahasiswa_hitung/{id_matkul}/{id_user}/{id_evaluasimhs}/{id_pengampu}', [EvaluasiMahasiswaDetailController::class, 'calculateEvaluasi']);

    // screen 6
    Route::get('/matkul-cpl/{userId}', [MatkulCplController::class, 'showByUserId']);
    Route::get('/total_cpl/{id_user}', [CplController::class, 'show']);
});