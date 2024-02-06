<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('register', [AuthController::class, 'register'])->name('register');

    Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
    Route::get('verify-email', [AuthController::class, 'verifyEmail'])->name('verification.verify');

    Route::group(['middleware' => 'auth:sanctum'], function() {
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    });
});
