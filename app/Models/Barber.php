<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cita;
use App\Models\Service;

class Barber extends Model
{
    use HasFactory;
    protected $table = 'barbero';

    protected $fillable = [
        'user_id',
        'nombre',
        'apellido',
        'telefono',
        'direccion',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'id_barbero');
    }

    public function citas()
    {
        return $this->hasManyThrough(Cita::class, Service::class, 'id_barbero', 'id_servicio', 'id')->where('cita.estado', 'finalizada');
    }
}
