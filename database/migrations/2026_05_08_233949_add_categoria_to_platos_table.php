<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('platos', function (Blueprint $table) {
            // Agregamos la columna categoria después de precio
            $table->string('categoria')->nullable()->after('precio');
        });
    }

    public function down(): void
    {
        Schema::table('platos', function (Blueprint $table) {
            $table->dropColumn('categoria');
        });
    }
};