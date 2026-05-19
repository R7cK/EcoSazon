<?php

use App\Http\Middleware\IsAdmin;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Session\TokenMismatchException; // <--- OBLIGATORIO PARA DETECTAR EL 419
use Illuminate\Support\Facades\Auth;           // <--- OBLIGATORIO PARA FORZAR EL LOGOUT
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Mantenemos tu configuración actual de alias
        $middleware->alias([
            'admin' => IsAdmin::class,
        ]);

        // INTERCEPCIÓN 1: Navegación (Rutas privadas GET)
        // Usamos una función flecha para evitar fallas por nombres de parámetros internos de Laravel
        $middleware->redirectTo(fn () => '/');
    })
    ->withExceptions(function (Exceptions $exceptions) {
        
        // INTERCEPCIÓN 2: Formularios y Botones (Peticiones POST / Error 419)
        // Si presionas "Cerrar Sesión" u otro botón cuando el token de la página ya caducó,
        // destruimos la sesión en el acto y te enviamos al Home completamente deslogueado.
        $exceptions->render(function (TokenMismatchException $e, Request $request) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            return redirect()->route('home')->with('info', 'Tu sesión ha expirado por inactividad.');
        });

    })->create();