<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PedidoDetalle extends Model {
    protected $fillable = ['pedido_id', 'plato_nombre', 'cocina_nombre', 'cantidad', 'precio_unitario', 'subtotal'];
    public function pedido() { return $this->belongsTo(Pedido::class); }
}