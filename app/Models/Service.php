<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $table = "servicio";

    protected $fillable = [
        'titulo',
        'descripcion',
        'precio',
        'tiempo_estimado',
        'id_barbero',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'id_barbero'
    ];
}
