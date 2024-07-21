<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarberModel extends Model
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
