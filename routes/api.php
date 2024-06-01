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

//screen 1
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Route::apiResource('/evaluasi', EvaluasiController::class);
    //screen 4
    Route::get('/detailrps/{id_detailrps}', [DetailRpsController::class, 'show']);
    Route::get('/detailrps', [DetailRpsController::class, 'index']);
    Route::get('/subcpmk/{id_detailrps}', [SubCpmkController::class, 'show']);
    Route::get('/eval/{id_detailrps}', [EvaluasiController::class, 'show']);
    Route::put('/eval/{id_detailrps}', [EvaluasiController::class, 'update']);

    //screen 3
    Route::get('/matkul', [PengampuMkController::class, 'show']);
    Route::get('/matkul/{id_matkul}/{id_pengampu}', [PengampuMkController::class, 'showMatkul']);
    //screen 6
    Route::get('/total_cpl/{id_user}', [CplController::class, 'show']);
    
    // SCR6
    Route::get('/matkul-cpl/{userId}', [MatkulCplController::class, 'showByUserId']);
});