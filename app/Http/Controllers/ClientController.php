<?php

namespace App\Http\Controllers;

use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Client;
use App\Models\Cita;
use DB;

class ClientController
{
    public function store(Request $request){
        $validatedData = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:6',
            'name' => 'required|string',
            'last_name' => 'required|string',
            'cedula' => 'required|string|min:7|max:8',
            'telefono' => 'required|string|min:11|max:11',
        ]);

        try{
            DB::transaction(function() use($validatedData){
                $user = new User();
                $user->email = $validatedData['email'];
                $user->password = bcrypt($validatedData['password']);
                $user->is_barber = false;
                $user->save();
    
                $client = new Client();
                $client->user_id = $user->id;
                $client->nombre = $validatedData['name'];
                $client->apellido = $validatedData['last_name'];
                $client->cedula = $validatedData['cedula'];
                $client->telefono = $validatedData['telefono'];
                $client->direccion = "";
                $client->save();
            });

        } catch (UniqueConstraintViolationException $e){
            return response()->json(['message' => 'Email already exists'], 400);
        }

        return response()->json(['message' => 'User created successfully'], 201);
    }
    
    public function index_finalizadas(Request $request){
        $client = $request->user()->client;

        $appointments = Cita::where('estado', 'finalizada')->where('id_cliente', $client->id)->orderBy('fecha')->get();
        return response()->json($appointments, 200);
    }

    public function index_citas(Request $request){
        $citas = $request->user()->client->citas;

        return response()->json($citas, 200);
    }

}
