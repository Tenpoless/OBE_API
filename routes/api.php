<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DetailRpsController;
use App\Http\Controllers\SubCpmkController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EvaluasiController;
use App\Http\Controllers\PengampuMkController;
use App\Http\Controllers\CplController;

//screen 1
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    //screen 3
    Route::get('/matkul', [PengampuMkController::class, 'show']);
    Route::get('/matkul/{id_matkul}/{id_pengampu}', [PengampuMkController::class, 'showMatkul']);

    //screen 4
    Route::get('/detailrps/minggu/{id_matkul}', [DetailRpsController::class, 'showMinggu']);
    Route::get('/evaluasi/{id_matkul}/{minggu}', [EvaluasiController::class, 'showEvaluasi']);
    Route::post('/evaluasi', [EvaluasiController::class, 'store']);
    Route::put('/evaluasi/{id_evaluasi}', [EvaluasiController::class, 'update']);
    Route::delete('/evaluasi/{id_evaluasi}', [EvaluasiController::class, 'destroy']);

    //screen 6
    Route::get('/total_cpl/{id_user}', [CplController::class, 'show']);

    // Route::get('/detailrps/{id_detailrps}', [DetailRpsController::class, 'show']);
    // Route::get('/detailrps', [DetailRpsController::class, 'index']);
    // Route::get('/subcpmk/{id_detailrps}', [SubCpmkController::class, 'show']);
    // Route::get('/eval/{id_detailrps}', [EvaluasiController::class, 'show']);
});