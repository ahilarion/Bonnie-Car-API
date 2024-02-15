<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'post'], function () {
    Route::get('/', 'PostController@index');
    Route::get('/{uuid}', 'PostController@show')->where('uuid', '[a-f0-9]{8}(-[a-f0-9]{4}){3}-[a-f0-9]{12}');

    Route::group(['middleware' => 'auth:sanctum'], function() {
        Route::post('/', 'PostController@store');
        Route::put('/{uuid}', 'PostController@update')->where('uuid', '[a-f0-9]{8}(-[a-f0-9]{4}){3}-[a-f0-9]{12}');
        Route::delete('/{uuid}', 'PostController@destroy')->where('uuid', '[a-f0-9]{8}(-[a-f0-9]{4}){3}-[a-f0-9]{12}');
    });
});
