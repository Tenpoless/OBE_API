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

    // Route::apiResource('/evaluasi', EvaluasiController::class);
    //screen 4
    Route::get('/detailrps/minggu/{id_matkul}', [DetailRpsController::class, 'showMinggu']);
    Route::get('/evaluasi/{id_matkul}/{minggu}', [EvaluasiController::class, 'showEvaluasi']);
    Route::get('/detailrps/{id_detailrps}', [DetailRpsController::class, 'show']);
    Route::get('/detailrps', [DetailRpsController::class, 'index']);
    Route::get('/subcpmk/{id_detailrps}', [SubCpmkController::class, 'show']);
    Route::get('/eval/{id_detailrps}', [EvaluasiController::class, 'show']);
    Route::put('/eval/{id_detailrps}', [EvaluasiController::class, 'update']);
});