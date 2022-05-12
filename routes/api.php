<?php

use App\Http\Controllers\Api\v1\Auth\LoginController;
use App\Http\Controllers\Api\v1\Auth\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/v1'], function () {
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout']);
    Route::post('/register-with-email', [RegistrationController::class, 'registerWithEmail']);
});

//Main route group
Route::middleware(['auth:api'])->group(function () {
    Route::group(['prefix' => '/v1'], function (){



    });
});

