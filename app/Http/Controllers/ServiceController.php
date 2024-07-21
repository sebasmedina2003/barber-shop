<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Models\Service;

class ServiceController
{
    public function store(Request $request){
        $validatedData = $request->validate([
            'titulo' => 'required|string',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric',
            'tiempo_estimado' => 'required|string',
            'id_barbero' => 'required|string',
            'id_cliente' => 'required|string',
        ]);

        try{
            DB::transaction(function() use($validatedData){
                $service = new Service();
                $service->titulo = $validatedData['titulo'];
                $service->descripcion = $validatedData['descripcion'];
                $service->precio = $validatedData['precio'];
                $service->tiempo_estimado = $validatedData['tiempo_estimado'];
                $service->save();
            });

        } catch (UniqueConstraintViolationException $e){
            return response()->json(['message' => 'Service already exists'], 400);
        }

        return response()->json(['message' => 'Service created successfully'], 201);
    }

    public function update(Request $request) {
        $validatedData = $request->validate([
            'id' => 'required|numeric',
            'titulo' => 'required|string',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric',
            'tiempo_estimado' => 'required|string',
        ]);

        try {
            DB::transaction(function() use($validatedData) {
                $service = Service::findOrFail($request->id);
                $service->titulo = $validatedData['titulo'];
                $service->descripcion = $validatedData['descripcion'];
                $service->precio = $validatedData['precio'];
                $service->tiempo_estimado = $validatedData['tiempo_estimado'];
                $service->save();
            });

        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Service not found'], 404);
        }

        return response()->json(['message' => 'Service updated successfully'], 200);
    }

    public function delete(Request $request) {
        try {
            DB::transaction(function() use($request) {
                $service = Service::findOrFail($request->id);
                $service->delete();
            });

        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Service not found'], 404);
        }

        return response()->json(['message' => 'Service deleted successfully'], 200);
    }
}
