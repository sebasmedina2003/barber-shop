<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ServiceModel;
use App\Models\ClientModel;

class CitaModel extends Model
{
    use HasFactory;

    protected $table = 'cita';
    protected $fillable = ['id_cliente', 'id_servicio', 'estado'];

    public function servicio(){
        return $this->belongsTo(ServiceModel::class, 'id_servicio', 'id');
    }

    public function client(){
        return $this->belongsTo(ClientModel::class, 'id_cliente', 'id');
    }

}
