<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EcoSazonController;
use App\Http\Controllers\Admin\AdminCocinaController;
use App\Http\Controllers\Admin\AdminUserController;
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
Route::post('/partner/store', [EcoSazonController::class, 'store'])->name('owner.cocina.store')->middleware('auth');
Route::post('/owner/platos/store', [EcoSazonController::class, 'storePlato'])->name('owner.platos.store')->middleware('auth');
Route::post('/owner/cocina/update-ajustes', [EcoSazonController::class, 'updateAjustes'])->name('owner.cocina.updateAjustes')->middleware('auth');
Route::delete('/owner/platos/{id}', [EcoSazonController::class, 'destroyPlato'])->name('owner.platos.destroy')->middleware('auth');
Route::put('/owner/platos/{id}', [EcoSazonController::class, 'updatePlato'])->name('owner.platos.update')->middleware('auth');
// Rutas de Ajustes para el Dueño de Cocina
Route::get('/owner/cocina/ajustes', [EcoSazonController::class, 'ajustes'])->name('owner.cocina.ajustes')->middleware('auth');
Route::post('/owner/cocina/update-ajustes', [EcoSazonController::class, 'updateAjustes'])->name('owner.cocina.updateAjustes')->middleware('auth');
// --- RUTAS PARA EL CLIENTE (CARRITO Y UBICACIÓN) ---
// --- RUTAS PARA EL CLIENTE (CARRITO Y UBICACIÓN) ---
Route::post('/set-location', function(\Illuminate\Http\Request $request) {
    session()->put('user_zona', $request->zona);
    return back()->with('success', 'Ubicación actualizada a: ' . $request->zona);
})->name('set.location');

Route::get('/carrito', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
Route::post('/carrito/add/{id}', [App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
Route::post('/carrito/remove/{id}', [App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
Route::post('/comprar-ahora/{id}', [App\Http\Controllers\CartController::class, 'buyNow'])->name('cart.buyNow');

// RUTAS DE PAGO E INVITADOS
Route::get('/checkout', [App\Http\Controllers\CheckoutController::class, 'index'])->name('cart.checkout');
Route::post('/checkout/pagar', [App\Http\Controllers\CheckoutController::class, 'procesarPago'])->name('cart.pagar'); 
Route::get('/checkout/confirmacion/{id}', [App\Http\Controllers\CheckoutController::class, 'confirmacion'])->name('cart.confirmacion');
Route::get('/checkout/recibo/{id}/pdf', [App\Http\Controllers\CheckoutController::class, 'descargarPdf'])->name('cart.recibo.pdf');

// RUTA PROTEGIDA PARA HISTORIAL (Solo Logueados)
Route::middleware('auth')->group(function() {
    Route::get('/mis-compras', [App\Http\Controllers\CheckoutController::class, 'misCompras'])->name('mis.compras');
});
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [EcoSazonController::class, 'adminDashboard'])->name('admin.dashboard');
    
    // Rutas para el CRUD de cocinas (index, create, store, edit, update, destroy)
    Route::resource('/admin/cocinas', AdminCocinaController::class)->names('admin.cocinas');
    Route::resource('/admin/usuarios', AdminUserController::class)->names('admin.usuarios');
    Route::patch('/admin/cocinas/{cocina}/toggle-status', [\App\Http\Controllers\Admin\AdminCocinaController::class, 'toggleStatus'])->name('admin.cocinas.toggleStatus');
    // Rutas de Verificación de Correo Obligatoria
    });

// ✅ LAS RUTAS DE VERIFICACIÓN DEBEN IR AQUÍ (PÚBLICAS)
Route::get('/verify-email', [EcoSazonController::class, 'showVerifyForm'])->name('verify.email');
Route::post('/verify-email', [EcoSazonController::class, 'postVerifyCode'])->name('verify.email.post');
Route::post('/verify-email/resend', [EcoSazonController::class, 'resendCode'])->name('verify.email.resend');

// NUEVA RUTA PARA CANCELAR EL REGISTRO
Route::get('/verify-email/cancel', [EcoSazonController::class, 'cancelVerification'])->name('verify.email.cancel');