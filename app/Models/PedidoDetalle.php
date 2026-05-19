<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

// app/Models/PedidoDetalle.php

class PedidoDetalle extends Model {
    // Añadir 'estatus' al arreglo
    protected $fillable = ['pedido_id', 'plato_nombre', 'cocina_nombre', 'cantidad', 'precio_unitario', 'subtotal', 'estatus'];
    
    public function pedido() { return $this->belongsTo(Pedido::class); }
}