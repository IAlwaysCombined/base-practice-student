<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Main route group
Route::middleware(['auth:api'])->group(function () {
    Route::group(['prefix' => 'v1'], function (){

    });
});

