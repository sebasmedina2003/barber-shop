<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CitaModel extends Model
{
    use HasFactory;

    protected $table = 'cita';
    protected $primaryKey = 'id';
    protected $fillable = ['id_cliente', 'id_servicio', 'estado'];
    
}
