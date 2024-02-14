<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'user'], function () {
    Route::group(['middleware' => 'auth:sanctum'], function() {
        Route::get('/me', [UserController::class, 'me']);

        Route::group(['middleware' => 'role:admin'], function() {
            Route::get('/', [UserController::class, 'index']);
            Route::get('/{uuid}', [UserController::class, 'show'])->where('uuid', '[a-f0-9]{8}(-[a-f0-9]{4}){3}-[a-f0-9]{12}');
            Route::put('/{uuid}', [UserController::class, 'update'])->where('uuid', '[a-f0-9]{8}(-[a-f0-9]{4}){3}-[a-f0-9]{12}');
            Route::delete('/{uuid}', [UserController::class, 'destroy'])->where('uuid', '[a-f0-9]{8}(-[a-f0-9]{4}){3}-[a-f0-9]{12}');
        });
    });
});
