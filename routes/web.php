<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EcoSazonController;

/*
|--------------------------------------------------------------------------
| Rutas Públicas de Navegación
|--------------------------------------------------------------------------
*/

// Página de inicio
Route::get('/', [HomeController::class, 'empresa'])->name('home');

// Propósito, Planes y Catálogo de Cocinas
Route::get('/proposito', [EcoSazonController::class, 'proposito'])->name('proposito');
Route::get('/planes', [EcoSazonController::class, 'planes'])->name('planes.index');
Route::get('/cocinas', [EcoSazonController::class, 'cocinas'])->name('cocinas.index');

// Perfil dinámico de una cocina específica
Route::get('/cocina/{slug}', [EcoSazonController::class, 'perfilCocina'])->name('cocina.perfil');

// Página de contacto
Route::get('/contacto', function() {
    return view('contact', ['nombre' => 'Equipo EcoSazón', 'carrera' => 'Soporte']);
})->name('contact');

// Registro de nuevas cocinas (Partners) y Menú
Route::get('/partner', [EcoSazonController::class, 'partner'])->name('partner.register');
Route::get('/menu', [EcoSazonController::class, 'index'])->name('menu.index');

/*
|--------------------------------------------------------------------------
| Rutas de Autenticación y Sesiones
|--------------------------------------------------------------------------
*/

// Vistas de acceso y registro (GET)
Route::get('/login', [EcoSazonController::class, 'login'])->name('login');
Route::get('/register', [EcoSazonController::class, 'register'])->name('register');

// Procesamiento de formularios de sesión (POST)
Route::post('/login', [EcoSazonController::class, 'postLogin'])->name('login.post');
Route::post('/register', [EcoSazonController::class, 'postRegister'])->name('register.post');
Route::post('/logout', [EcoSazonController::class, 'logout'])->name('logout');

// Dashboard o Perfil de usuario
Route::get('/dashboard', [EcoSazonController::class, 'dashboard'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Rutas de Funcionalidades (Features)
|--------------------------------------------------------------------------
*/

// Ruta para procesar y guardar los comentarios de las cocinas
Route::post('/cocina/{id}/comentario', [EcoSazonController::class, 'storeComentario'])->name('cocina.comentario');

Route::get('Owners/owner/dashboard', [EcoSazonController::class, 'ownerDashboard'])->name('owner.dashboard')->middleware('auth');