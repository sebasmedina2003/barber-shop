<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ClientModel;

class UserController
{
    public function index()
    {
        $clientes = ClientModel::with('user:id,email')->get(["nombre", "apellido", "user_id"]);

        return response()->json($clientes);
    }
}
