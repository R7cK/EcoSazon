<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('pedidos', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
        $table->string('email_contacto');
        $table->decimal('subtotal', 10, 2);
        $table->decimal('iva', 10, 2);
        $table->decimal('total', 10, 2);
        $table->timestamps();
    });
}

    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
};