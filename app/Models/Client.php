<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $table = 'cliente';

    protected $fillable = [
        'nombre',
        'apellido',
        'telefono',
        'direccion',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function citas()
    {
        return $this->hasMany(Cita::class, 'id_cliente', 'id');
    }
}
