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
    $captcha = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
    session(['captcha_text' => $captcha]);
    return view('login', compact('captcha'));
}

public function register()
{
    $captcha = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
    session(['captcha_text' => $captcha]);
    return view('register', compact('captcha'));
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
    public function proposito()
{
    return view('proposito');
}

public function cocinas()
{
    // Datos simulados de zonas en Mérida basados en la propuesta
    $categorias = [
        'Cocinas de Barrio' => [
            ['nombre' => 'El Rincón de Itzimná', 'zona' => 'Itzimná', 'especialidad' => 'Menú del día'],
            ['nombre' => 'Sabor a Chuburná', 'zona' => 'Chuburná de Hidalgo', 'especialidad' => 'Comida regional'],
        ],
        'Cocinas Especializadas' => [
            ['nombre' => 'Eco-Sazón Vegano', 'zona' => 'García Ginerés', 'especialidad' => 'Dieta basada en plantas'],
            ['nombre' => 'Pueblo Maya Fit', 'zona' => 'Caucel', 'especialidad' => 'Bajo en calorías'],
        ]
    ];

    return view('cocinas', compact('categorias'));
}
public function planes()
{
    return view('planes');
}


}