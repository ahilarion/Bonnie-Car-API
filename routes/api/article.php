<?php

use App\Http\Controllers\API\ArticleController;
use App\Http\Controllers\API\AuthController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'article'], function () {
    Route::get('/', [ArticleController::class, 'index']);
    Route::get('/{uuid}', [ArticleController::class, 'show']);

    Route::group(['middleware' => 'auth:sanctum'], function() {
        Route::post('/', [ArticleController::class, 'store']);
        Route::put('/{uuid}', [ArticleController::class, 'update']);
        Route::delete('/{uuid}', [ArticleController::class, 'destroy']);
    });
});


