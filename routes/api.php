<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DetailRpsController;
use App\Http\Controllers\SubCpmkController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EvaluasiController;
use App\Http\Controllers\PengampuMkController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Route::apiResource('/evaluasi', EvaluasiController::class);
    Route::get('/detailrps/{id_detailrps}', [DetailRpsController::class, 'show']);
    Route::get('/detailrps', [DetailRpsController::class, 'index']);
    Route::get('/subcpmk/{id_detailrps}', [SubCpmkController::class, 'show']);
    Route::get('/eval/{id_detailrps}', [EvaluasiController::class, 'show']);
    Route::put('/eval/{id_detailrps}', [EvaluasiController::class, 'update']);
    Route::get('/matkul', [PengampuMkController::class, 'show']);
});