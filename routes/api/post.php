<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'post'], function () {
    Route::get('/', 'PostController@index');
    Route::get('/{uuid}', 'PostController@show')->where('uuid', '[a-f0-9]{8}(-[a-f0-9]{4}){3}-[a-f0-9]{12}');

    Route::get('/search/{keyword}', [PostController::class, 'search'])->where('keyword', '[a-zA-Z0-9]+');
    Route::get('/lastMoto', [PostController::class, 'lastMoto']);
    Route::get('/lastCar', [PostController::class, 'lastCar']);
    
    Route::group(['middleware' => 'auth:sanctum'], function() {
        Route::post('/', 'PostController@store');
        Route::put('/{uuid}', 'PostController@update')->where('uuid', '[a-f0-9]{8}(-[a-f0-9]{4}){3}-[a-f0-9]{12}');
        Route::delete('/{uuid}', 'PostController@destroy')->where('uuid', '[a-f0-9]{8}(-[a-f0-9]{4}){3}-[a-f0-9]{12}');
    });
});
