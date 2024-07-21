<?php

namespace App\Http\Controllers;

use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ClientModel;
use Auth;
use Db;

class AuthController
{
    public function login(Request $request){
        $validatedData = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:6',
        ]);

        if (!Auth::attempt($validatedData)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user = User::where('email', $request->email)->firstOrFail();
        $abilities = $user->is_barber ? ['barbero'] : ['cliente'];

        return response()->json([
            'message' => 'Logged in successfully',
            'token' => $user->createToken('auth_token', $abilities)->plainTextToken,
            'abilities' => $abilities[0],
        ], 200);
    }

    public function logout(Request $request){
        // Log out the user
        auth()->user()->tokens()->delete();

        // Return a response
        return response()->json(['message' => 'Logged out successfully'], 200);
    }

    public function store_user(Request $request){
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