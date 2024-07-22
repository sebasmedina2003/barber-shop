<?php

namespace App\Http\Controllers;

use App\Models\CitaModel;
use Illuminate\Http\Request;

class CitaController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function store(Request $request, int $id_servicio)
    {
        $cita = new CitaModel();
        $cita->id_cliente = $request->user()->id;
        $cita->id_servicio = $id_servicio;
        $cita->estado = true;
        $cita->save();

        return response()->json(['message' => 'Cita creada con éxito'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $cita_id)
    {
        return response()->json(CitaModel::with('servicio')->find($cita_id), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CitaModel $citaModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CitaModel $citaModel)
    {
        //
    }
}
