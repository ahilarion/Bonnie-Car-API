<?php

use App\Http\Controllers\API\PostController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'post'], function () {
    Route::get('/', [PostController::class, 'index']);
    Route::get('/{name}', [PostController::class, 'show'])->where('name', '[A-Za-z]+');

    Route::group(['middleware' => 'auth:sanctum'], function() {
        Route::post('/', [PostController::class, 'store']);
        Route::put('/{name}', [PostController::class, 'update'])->where('name', '[A-Za-z]+');
        Route::delete('/{name}', [PostController::class, 'destroy'])->where('name', '[A-Za-z]+');
    });
});
