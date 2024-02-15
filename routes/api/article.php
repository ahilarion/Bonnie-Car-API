<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'article'], function () {
    Route::get('/', [ArticleController::class, 'index']);
    Route::get('/{uuid}', [ArticleController::class, 'show'])->where('uuid', '[a-f0-9]{8}(-[a-f0-9]{4}){3}-[a-f0-9]{12}');

    Route::group(['middleware' => 'auth:sanctum', 'role:admin'], function() {
        Route::post('/', [ArticleController::class, 'store']);
        Route::put('/{uuid}', [ArticleController::class, 'update'])->where('uuid', '[a-f0-9]{8}(-[a-f0-9]{4}){3}-[a-f0-9]{12}');
        Route::delete('/{uuid}', [ArticleController::class, 'destroy'])->where('uuid', '[a-f0-9]{8}(-[a-f0-9]{4}){3}-[a-f0-9]{12}');
    });
});
