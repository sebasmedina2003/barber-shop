<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Mail\Notification;
use App\Mail\NotificationEstado;
use Illuminate\Http\Request;
use Mail;

class CitaController
{
    public function store(Request $request, int $id_servicio)
    {
        $request->validate([
            'fecha' => 'required|date',
        ]);

        $cita = new Cita();
        $cita->id_cliente = $request->user()->id;
        $cita->id_servicio = $id_servicio;
        $cita->fecha = $request->fecha;
        $cita->save();

        return response()->json(['message' => 'Cita creada con éxito'], 201);
    }

    public function notificar(Request $request, int $id_cita)
    {
        $cita = Cita::find($id_cita);
        $user = $cita->client->user;
        
        Mail::to($user->email)->send(new Notification());

        return response()->json(['message' => 'Notificación enviada con éxito'], 200);
        
    }

    public function show(Request $request, int $cita_id)
    {
        $cita = Cita::with('servicio')->find($cita_id);
        return response()->json($cita, 200);
    }

    public function update(Request $request, int $cita_id)
    {
        $cita = Cita::find($cita_id);
        
        if($request->has('estado')){
            $cita->estado = $request->estado;
        }

        if($request->has('fecha')){
            $cita->fecha = $request->fecha;
        }

        $cita->save();

        Mail::to($cita->client->user->email)->send(new NotificationEstado($cita->estado, $cita->client->nombre, $cita->fecha));

        return response()->json(['message' => 'Cita actualizada con éxito'], 200);
    }
}
