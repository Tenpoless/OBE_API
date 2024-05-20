<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\EvaluasiController;

Route::group([
    'middleware' => ['auth:sanctum']
], function () {
    //View Profile
    Route::get('profile', [loginController::class, 'profile']);

    //Logout
    Route::get('logout', [loginController::class, 'logout']);

    //CRUD
    Route::apiResource('/evaluasi', EvaluasiController::class);
});