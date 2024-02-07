<?php

use App\Http\Controllers\API\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/test', [TestController::class, 'test']);
