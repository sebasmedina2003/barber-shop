<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CitaController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'v1'], function(){

    $client_middlewares = ['auth:sanctum', 'ability:cliente'];
    $barbero_middlewares = ['auth:sanctum', 'ability:barbero'];
    $sanctum_middleware = ['auth:sanctum'];

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

    Route::controller(CitaController::class)->group(function() use($client_middlewares, $barbero_middlewares){
        Route::post('/cita/{id_servicio}', 'store')
        ->name('cita.store')
        ->middleware($client_middlewares);

        Route::get('/cita/{cita_id}', 'show')
        ->name('cita.show')
        ->middleware($client_middlewares);

        Route::post('/cita/{cita_id}/notificar', 'notificar')
        ->name('cita.notificar')
        ->middleware($barbero_middlewares);
    });

});
