<?php

use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CitaController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'v1'], function(){

    $client_middlewares = ['auth:sanctum', 'ability:cliente'];
    $barbero_middlewares = ['auth:sanctum', 'ability:barbero'];
    $sanctum_middleware = ['auth:sanctum'];

    Route::controller(AuthController::class)->group(function() use($sanctum_middleware){
        Route::post('/login', 'login')
        ->name('login');

        Route::post('/logout', 'logout')
        ->name('logout')
        ->middleware($sanctum_middleware);
    });

    Route::controller(ClientController::class)->group(function() use($client_middlewares){
        // Crear un nuevo cliente
        Route::post('/client', 'store')
        ->name('register');

        // Mostrar citas finalizadas
        Route::get('/service/cita/finalizadas', 'index_finalizadas')
        ->name('cita.index_finalizadas')
        ->middleware($client_middlewares);
    });

    Route::controller(CitaController::class)->group(function() use($client_middlewares, $barbero_middlewares, $sanctum_middleware){
        // Crear un nuevo servicio
        Route::post('/service/{id_servicio}/cita', 'store')
        ->name('cita.store')
        ->middleware($client_middlewares);

        // Mostrar una cita
        Route::get('/service/cita/{cita_id}', 'show')
        ->name('cita.show')
        ->middleware($sanctum_middleware);

        // Notificar a un cliente sobre una cita
        Route::post('/service/cita/{cita_id}/notificar', 'notificar')
        ->name('cita.notificar')
        ->middleware($barbero_middlewares);

        // Actualizar una cita
        Route::put('/service/cita/{cita_id}', 'update')
        ->name('cita.update')
        ->middleware($sanctum_middleware);
    });

    Route::controller(ServiceController::class)->group(function() use($barbero_middlewares, $client_middlewares){

        // Mostrar todos los servicios
        Route::get('/service', 'index')
        ->name('service.index');


        // Crear un nuevo servicio
        Route::post('/barbero/service', 'store')
        ->name('service.store')
        ->middleware($barbero_middlewares);

        // Mostrar un servicio
        Route::put('/barbero/service/{id_service}', 'update')
        ->name('service.update')
        ->middleware($barbero_middlewares);

        // Eliminar un servicio
        Route::delete('/barbero/service/{id_service}', 'destroy')
        ->name('service.destroy')
        ->middleware($barbero_middlewares);

        // Servicios por barbero
        Route::get('/barbero/service', 'indexByBarber')
        ->name('barber.service.index')
        ->middleware($barbero_middlewares);
    });

});
