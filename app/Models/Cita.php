<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Service;
use App\Models\Client;

class Cita extends Model
{
    use HasFactory;

    protected $table = 'cita';
    protected $fillable = ['id_cliente', 'id_servicio', 'estado', 'fecha'];

    protected $hidden = ['updated_at', 'id_cliente', 'id_servicio'];

    public const ESTADOS = ['pendiente', 'aceptada', 'cancelada', 'finalizada'];

    public function servicio(){
        return $this->belongsTo(Service::class, 'id_servicio', 'id');
    }

    public function client(){
        return $this->belongsTo(Client::class, 'id_cliente', 'id');
    }

}
