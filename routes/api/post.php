<?php

use App\Http\Controllers\API\PostController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'post'], function () {
    Route::get('/', [PostController::class, 'index']);
    Route::get('/last-post', [PostController::class, 'lastPost']);
    Route::get('/{uuid}', [PostController::class, 'show'])->where('uuid', '[A-Za-z]+');

    Route::group(['middleware' => 'auth:sanctum'], function() {
        Route::post('/', [PostController::class, 'store']);
        Route::put('/{uuid}', [PostController::class, 'update'])->where('uuid', '[A-Za-z]+');
        Route::delete('/{uuid}', [PostController::class, 'destroy'])->where('uuid', '[A-Za-z]+');
    });
});
