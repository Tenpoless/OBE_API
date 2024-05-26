<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DetailRpsController;
use App\Http\Controllers\SubCpmkController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EvaluasiController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('/evaluasi', EvaluasiController::class);
    Route::get('/detailrps/{id_detailrps}', [DetailRpsController::class, 'show']);
    Route::get('/detailrps', [DetailRpsController::class, 'index']);
    Route::get('/subcpmk/{id_subcpmk}', [SubCpmkController::class, 'show']);
});