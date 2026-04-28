<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cocina extends Model
{
    use HasFactory;

    // Permitir asignación masiva
    protected $guarded = [];

    /**
     * Una cocina tiene muchos platos
     */
    public function platos(): HasMany
    {
        return $this->hasMany(Plato::class);
    }

    /**
     * Una cocina tiene muchos comentarios
     */
    public function comentarios(): HasMany
    {
        return $this->hasMany(Comentario::class)->latest();
    }

    /**
     * Relación con el Usuario (Dueño)
     * Cambiamos el nombre de 'owner' a 'user' para que coincida con el controlador
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}