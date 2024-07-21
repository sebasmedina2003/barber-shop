<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'v1'], function(){

    $client_middlewares = ['auth:sanctum', 'ability:cliente'];
    $barbero_middlewares = ['auth:sanctum', 'ability:barbero'];
    $sanctum_middleware = ['auth:sanctum'];

    Route::controller(UserController::class)->group(function(){
        Route::get('users', 'index');
    });

    // Rutas de autenticación y registro de usuarios
    Route::controller(AuthController::class)->group(function() use($sanctum_middleware){
        Route::post('/login', 'login')
        ->name('login');

        Route::post('/logout', 'logout')
        ->name('logout')
        ->middleware($sanctum_middleware);
    });

    Route::controller(ClientController::class)->group(function() use($client_middlewares){
        Route::post('/client', 'store')
        ->name('register');
    });

});
