<?php

namespace App\Http\Controllers;

use App\Models\CitaModel;
use App\Mail\Notification;
use Illuminate\Http\Request;
use Mail;

class CitaController
{
    public function store(Request $request, int $id_servicio)
    {
        $cita = new CitaModel();
        $cita->id_cliente = $request->user()->id;
        $cita->id_servicio = $id_servicio;
        $cita->estado = true;
        $cita->save();

        return response()->json(['message' => 'Cita creada con éxito'], 201);
    }

    public function notificar(Request $request, int $id_cita)
    {
        $cita = CitaModel::find($id_cita);
        $user = $cita->client->user;
        
        Mail::to($user->email)->send(new Notification());

        return response()->json(['message' => 'Notificación enviada con éxito'], 200);
        
    }

}
