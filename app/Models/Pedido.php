<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model {
    protected $fillable = ['user_id', 'email_contacto', 'subtotal', 'iva', 'total', 'notas'];
    public function detalles() { return $this->hasMany(PedidoDetalle::class); }
    public function user() { return $this->belongsTo(User::class); }
}