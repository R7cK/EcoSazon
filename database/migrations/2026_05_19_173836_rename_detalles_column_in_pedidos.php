<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up(): void
{
    // Solo crea la tabla si NO existe previamente
    if (!Schema::hasTable('pedidos')) {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('email_contacto');
            $table->decimal('subtotal', 10, 2);
            $table->decimal('iva', 10, 2);
            $table->decimal('total', 10, 2);
            $table->text('nota_pedido')->nullable(); // Cambiamos a text para evitar errores JSON
            $table->timestamps();
        });
    }
}

    /**
     * Reverse the migrations.
     */
   public function down(): void
{
    Schema::table('pedidos', function ($table) {
        $table->renameColumn('nota_pedido', 'detalles');
    });
}
};
