<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientModel extends Model
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
        return $this->belongsTo(User::class);
    }
}
