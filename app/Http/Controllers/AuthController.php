<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\BarberModel;
use App\Models\ClientModel;
use Auth;

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
        $profile = $user->is_barber ? BarberModel::where('id_usuario', $user->id)->first() : ClientModel::where('id_usuario', $user->id)->first();

        return response()->json([
            'message' => 'Logged in successfully',
            'token' => $user->createToken('auth_token', $abilities)->plainTextToken,
            'abilities' => $abilities[0],
            'name' => "$profile->nombre $profile->apellido",
            'email' => $user->email,
        ], 200);
    }

    public function logout(Request $request){
        // Log out the user
        auth()->user()->tokens()->delete();

        // Return a response
        return response()->json(['message' => 'Logged out successfully'], 200);
    }
}