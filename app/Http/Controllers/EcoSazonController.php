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
        // Simulamos datos de cocinas locales de Mérida
        $cocinas = [
            [
                'nombre' => 'Cocina Doña Lupe (Barrio de Santiago)',
                'imagen' => 'imagenes/Imagen02.jfif',
                'menu_dia' => 'Poc Chuc con guarnición',
                'precio_completo' => 85.00,
                'calificacion' => 4.8,
                'descripcion' => 'Cerdo marinado en naranja agria, servido con arroz y frijol con puerco.'
            ],
            [
                'nombre' => 'La Tía de Pacabtún',
                'imagen' => 'imagenes/Imagen03.jpg',
                'menu_dia' => 'Sopa de Lima y Salbutes',
                'precio_completo' => 75.00,
                'calificacion' => 4.9,
                'descripcion' => 'Caldo tradicional con tiras de tortilla y lima fresca de la región.'
            ],
            [
                'nombre' => 'El Sazón de San Sebastián',
                'imagen' => 'imagenes/paisaje.jpg', // Usamos placeholder de tus archivos
                'menu_dia' => 'Relleno Negro',
                'precio_completo' => 90.00,
                'calificacion' => 4.7,
                'descripcion' => 'Platillo tradicional hecho con chilmole y carne de pavo.'
            ]
        ];

        return view('ecosazon', compact('cocinas'));
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
     public function partner()
    {
        return view('partner');
    }
}