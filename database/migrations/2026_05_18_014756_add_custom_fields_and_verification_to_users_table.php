<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('apellido')->after('name');
            $table->string('telefono')->nullable()->after('email');
            $table->string('foto')->nullable()->after('telefono');
            $table->string('verification_code')->nullable()->after('password');
            $table->boolean('is_verified')->default(false)->after('verification_code');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['apellido', 'telefono', 'foto', 'verification_code', 'is_verified']);
        });
    }
};