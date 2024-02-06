<?php

use App\Http\Controllers\API\VehicleMarqueController;
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

    });

    Route::group(['prefix' => 'type'], function () {

    });
});
