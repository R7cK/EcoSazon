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
    Schema::create('tarjetas', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Vinculada al cliente
        $table->string('nombre_titular');
        $table->string('numero_tarjeta'); // Guardaremos el número completo para la simulación
        $table->string('mes_expiracion', 2);
        $table->string('ano_expiracion', 4);
        // Balance simulación solicitado: $1,200,000.00 MXN por defecto
        $table->decimal('balance_simulado', 15, 2)->default(1200000.00); 
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarjetas');
    }
};
