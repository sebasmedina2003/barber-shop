<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\Barber;

class BarberController
{
    public function index_citas_finalizadas(Request $request){
        $barber = $request->user()->barber;

        $appointments = $barber->citas;
        return response()->json($appointments, 200);
    }
}
