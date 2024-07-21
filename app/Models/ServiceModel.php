<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceModel extends Model
{
    use HasFactory;
    protected $table = "servicio";

    protected $fillable = [
        'titulo',
        'descripcion',
        'precio',
        'tiempo_estimado',
        'id_barbero',
        'id_cliente'
    ];
}
