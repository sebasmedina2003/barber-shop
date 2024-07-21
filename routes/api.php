<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'v1'], function(){

    $client_middlewares = ['auth:sanctum', 'ability:cliente'];
    $barbero_middlewares = ['auth:sanctum', 'ability:barbero'];
    $sanctum_middlewares = ['auth:sanctum'];

    Route::controller(UserController::class)->group(function(){
        Route::get('users', 'index');
    });

});
