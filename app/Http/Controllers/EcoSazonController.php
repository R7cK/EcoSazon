<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EcoSazonController extends Controller
{
    /**
     * Muestra la página principal de EcoSazón.
     */
    public function index()
    {
        return view('ecosazon'); // Asegúrate que tu vista se llame 'ecosazon.blade.php'
    }

    /**
     * Simula la página de Login
     */
    public function login()
    {
        // Por ahora retornamos un texto simple para probar
        return "Aquí iría el formulario de Iniciar Sesión";
    }

    /**
     * Simula la página de Registro
     */
    public function register()
    {
        // Por ahora retornamos un texto simple para probar
        return "Aquí iría el formulario de Registro";
    }

    /**
     * Simula el Dashboard de usuario logueado
     */
    public function dashboard()
    {
        return "Bienvenido al Dashboard de EcoSazón";
    }
}