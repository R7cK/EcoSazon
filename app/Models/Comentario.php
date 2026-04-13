<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    /**
     * Los atributos que se pueden asignar de manera masiva.
     * Esto soluciona el error "Add [user_id] to fillable property".
     */
    protected $fillable = [
        'user_id',
        'cocina_id',
        'contenido',
        'calificacion',
    ];

    /**
     * Relación: Un comentario pertenece a un usuario.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación: Un comentario pertenece a una cocina.
     */
    public function cocina()
    {
        return $this->belongsTo(Cocina::class);
    }
}