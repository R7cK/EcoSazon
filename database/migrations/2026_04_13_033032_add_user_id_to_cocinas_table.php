<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cocinas', function (Blueprint $table) {
            // Creamos la llave foránea. 
            // 'nullable' permite que las cocinas actuales no fallen si no tienen dueño aún.
            // 'constrained' asume que la tabla se llama 'users'.
            // 'onDelete(cascade)' borra la cocina si el usuario es eliminado.
            $table->foreignId('user_id')->nullable()->after('id')->constrained()->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('cocinas', function (Blueprint $table) {
            // Pasos inversos para revertir la migración
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};