<?php

use App\Http\Controllers\API\MarqueController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'vehicle'], function () {
    Route::group(['prefix' => 'marque'], function () {
        Route::get('/', [MarqueController::class, 'index']);
        Route::get('/{marque}', [MarqueController::class, 'show'])->where('marque', '[A-Za-z]+');
        Route::post('/', [MarqueController::class, 'store']);
        Route::put('/{marque}', [MarqueController::class, 'update'])->where('marque', '[A-Za-z]+');
        Route::delete('/{marque}', [MarqueController::class, 'destroy'])->where('marque', '[A-Za-z]+');
    });

    Route::group(['prefix' => 'model'], function () {

    });

    Route::group(['prefix' => 'type'], function () {

    });
});
