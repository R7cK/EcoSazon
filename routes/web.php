<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EcoSazonController;

// Establecemos la vista 'empresa' como la principal
Route::get('/', [HomeController::class, 'empresa'])->name('home');

// Rutas funcionales para los botones
Route::get('/menu', [EcoSazonController::class, 'index'])->name('menu.index');
Route::get('/login', [EcoSazonController::class, 'login'])->name('login');
Route::get('/register', [EcoSazonController::class, 'register'])->name('register');
Route::get('/contacto', function() {
    return view('contact', ['nombre' => 'Equipo EcoSazón', 'carrera' => 'Soporte']);
})->name('contact');
// Ruta para el registro de nuevas cocinas (Partners)
Route::get('/partner', [EcoSazonController::class, 'partner'])->name('partner.register');