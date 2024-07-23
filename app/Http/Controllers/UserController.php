<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Client;

class UserController
{
    public function index()
    {
        $clientes = Client::with('user:id,email')->get(["nombre", "apellido", "user_id"]);

        return response()->json($clientes);
    }
}
