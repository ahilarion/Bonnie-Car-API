<?php

use App\Http\Controllers\API\MarqueController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'vehicle'], function () {
    Route::group(['prefix' => 'marque'], function () {
        Route::get('/', [MarqueController::class, 'index']);
    });

    Route::group(['prefix' => 'model'], function () {
        Route::resource('/', 'API\VehicleModelController');
    });

    Route::group(['prefix' => 'type'], function () {
        Route::resource('/', 'API\VehicleTypeController');
    });
});
