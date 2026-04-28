<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
    {
        User::create([
            'name' => 'Administrador EcoSazón',
            'email' => 'admin@ecosazon.com',
            'password' => Hash::make('password_seguro'),
            'role' => 'admin', // Aquí asignas el rol
        ]);
    }
}
