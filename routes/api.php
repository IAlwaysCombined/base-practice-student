<?php

use App\Http\Controllers\Api\v1\Auth\LoginController;
use App\Http\Controllers\Api\v1\Auth\RegistrationController;
use App\Http\Controllers\Api\v1\PortfolioController;
use App\Http\Controllers\Api\v1\SearchController;
use App\Http\Controllers\Api\v1\StackController;
use App\Http\Controllers\Api\v1\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/v1'], static function () {
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout']);
    Route::post('/register-student',
        [RegistrationController::class, 'registerStudent']);
});

//Main route group
Route::middleware(['auth:api'])->group(function () {
    Route::group(['prefix' => '/v1'], static function () {

        Route::group(['prefix' => '/student'], static function () {
            Route::get('/all', [UserController::class, 'getStudents']);
            Route::get('/{id}', [UserController::class, 'showStudent']);
        });

        Route::group(['prefix' => '/company'], static function () {
            Route::get('/all', [UserController::class, 'getCompanies']);
        });

        Route::group(['prefix' => '/user'], static function () {
            Route::get('/me', [UserController::class, 'me']);
            Route::patch('/update', [UserController::class, 'update']);
            Route::post('/update/avatar', [UserController::class, 'uploadAvatar']);
            Route::delete('/delete/avatar', [UserController::class, 'deleteAvatar']);
        });

        Route::group(['prefix' => '/portfolio'], static function () {
            Route::post('/create', [PortfolioController::class, 'store']);
            Route::get('/all/{id}', [PortfolioController::class, 'index']);
            Route::patch('/update/{id}', [PortfolioController::class, 'update']);
            Route::delete('/delete/{id}', [PortfolioController::class, 'destroy']);
            Route::post('/photo/add/{id}', [PortfolioController::class, 'storePhoto']);
            Route::delete('photo/delete/{id_portfolio}/{id_photo}', [PortfolioController::class, 'deletePhoto']);
        });

        Route::group(['prefix' => '/stack'], static function () {
            Route::get('/all/{id}', [StackController::class, 'index']);
            Route::post('/create', [StackController::class, 'store']);
            Route::patch('/update/{id}', [StackController::class, 'update']);
            Route::delete('/delete/{id}', [StackController::class, 'destroy']);
        });

        Route::group(['prefix' => '/search'], static function () {
            Route::get('/company', [SearchController::class, 'company']);
            Route::get('/student', [SearchController::class, 'student']);
        });

    });
});

