<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarjeta extends Model
{
    protected $table = 'tarjetas';

    protected $fillable = [
        'user_id',
        'nombre_titular',
        'numero_tarjeta',
        'mes_expiracion',
        'ano_expiracion',
        'balance_simulado'
    ];

    // Relación inversa: Una tarjeta pertenece a un usuario cliente
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}