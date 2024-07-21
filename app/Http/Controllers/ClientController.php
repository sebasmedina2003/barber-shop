<?php

namespace App\Http\Controllers;

use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ClientModel;
use Db;

class ClientController
{
    public function store(Request $request){
        $validatedData = $request->validate([
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6',
            'name' => 'required|string',
            'last_name' => 'required|string',
        ]);

        try{
            Db::transaction(function() use($validatedData){
                $user = new User();
                $user->email = $validatedData['email'];
                $user->password = bcrypt($validatedData['password']);
                $user->is_barber = false;
                $user->save();
    
                $client = new ClientModel();
                $client->user_id = $user->id;
                $client->name = $validatedData['name'];
                $client->last_name = $validatedData['last_name'];
                $client->save();
            });

        } catch (UniqueConstraintViolationException $e){
            return response()->json(['message' => 'Email already exists'], 400);
        }

        return response()->json(['message' => 'User created successfully'], 201);
    }
}
