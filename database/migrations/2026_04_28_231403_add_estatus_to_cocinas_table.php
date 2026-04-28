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
    Schema::table('cocinas', function (Blueprint $table) {
        $table->enum('estatus', ['activa', 'inactiva'])->default('activa')->after('categoria');
    });
}

public function down()
{
    Schema::table('cocinas', function (Blueprint $table) {
        $table->dropColumn('estatus');
    });
}
};
