<?php
namespace App\Http\Controllers;

use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Models\Service;
use DB;

class ServiceController
{
    public function store(Request $request, int $id_barbero) {
        $validatedData = $request->validate([
            'titulo' => 'required|string',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric',
            'tiempo_estimado' => 'required|string',
        ]);

        try{
            DB::transaction(function() use($validatedData, $id_barbero) {
                $service = new Service();
                $service->id_barbero = $id_barbero;
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

    public function update(Request $request, int $id_service) {
        $validatedData = $request->validate([
            'titulo' => 'required|string',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric',
            'tiempo_estimado' => 'required|string',
        ]);

        try {
            DB::transaction(function() use($validatedData, $id_service) {
                $service = Service::findOrFail($id_service);
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

    public function delete(Request $request, int $id_service) {
        try {
            DB::transaction(function() use($id_service) {
                $service = Service::findOrFail($id_service);
                $service->delete();
            });

        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Service not found'], 404);
        }

        return response()->json(['message' => 'Service deleted successfully'], 200);
    }
}
