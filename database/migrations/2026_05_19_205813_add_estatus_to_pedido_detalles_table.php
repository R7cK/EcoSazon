<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::table('pedido_detalles', function (Blueprint $table) {
        // Estatus posibles: pendiente, en entrega, entregado, cancelado
        $table->string('estatus')->default('pendiente')->after('subtotal');
    });
}

public function down()
{
    Schema::table('pedido_detalles', function (Blueprint $table) {
        $table->dropColumn('estatus');
    });
}
};
