<?php

use App\Http\Controllers\API\VehicleMarqueController;
use App\Http\Controllers\API\VehicleModelController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'vehicle'], function () {
    Route::group(['prefix' => 'marque'], function () {
        Route::get('/', [VehicleMarqueController::class, 'index']);
        Route::get('/{marque}', [VehicleMarqueController::class, 'show'])->where('marque', '[A-Za-z]+');
        Route::post('/', [VehicleMarqueController::class, 'store']);
        Route::put('/{marque}', [VehicleMarqueController::class, 'update'])->where('marque', '[A-Za-z]+');
        Route::delete('/{marque}', [VehicleMarqueController::class, 'destroy'])->where('marque', '[A-Za-z]+');
    });

    Route::group(['prefix' => 'model'], function () {
        Route::get('/', [VehicleModelController::class, 'index']);
        Route::get('/{model}', [VehicleModelController::class, 'show'])->where('model', '[A-Za-z]+');
        Route::post('/', [VehicleModelController::class, 'store']);
        Route::put('/{model}', [VehicleModelController::class, 'update'])->where('model', '[A-Za-z]+');
        Route::delete('/{model}', [VehicleModelController::class, 'destroy'])->where('model', '[A-Za-z]+');
    });

    Route::group(['prefix' => 'type'], function () {

    });
});
