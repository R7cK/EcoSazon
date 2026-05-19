<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plato;
use App\Models\Cocina;

class CartController extends Controller
{
    // Mostrar el carrito
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach($cart as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }
        return view('cart.index', compact('cart', 'total'));
    }

    // Añadir plato al carrito con cantidad personalizada
    public function add(Request $request, $id)
    {
        $plato = Plato::findOrFail($id);
        $cart = session()->get('cart', []);
        
        // Obtenemos la cantidad ingresada, si no existe, por defecto es 1
        $cantidad = (int) $request->input('cantidad', 1);

        // Seguridad: evitamos que manden números negativos o ceros
        if ($cantidad < 1) {
            $cantidad = 1;
        }

        // Si el plato ya está en el carrito, sumamos la cantidad nueva
        if(isset($cart[$id])) {
            $cart[$id]['cantidad'] += $cantidad;
        } else {
            // Si no está, lo añadimos
            $cart[$id] = [
                "nombre" => $plato->nombre,
                "cantidad" => $cantidad,
                "precio" => $plato->precio,
                "imagen" => $plato->imagen,
                "cocina" => $plato->cocina->nombre
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', '¡Se agregaron ' . $cantidad . 'x ' . $plato->nombre . ' al carrito!');
    }

    // Comprar Ahora (Añade con cantidad y va a checkout)
    public function buyNow(Request $request, $id)
    {
        $plato = Plato::findOrFail($id);
        $cart = session()->get('cart', []);

        $cantidad = (int) $request->input('cantidad', 1);
        if ($cantidad < 1) {
            $cantidad = 1;
        }

        // 1. En lugar de sobrescribir, lo sumamos al carrito existente
        if(isset($cart[$id])) {
            $cart[$id]['cantidad'] += $cantidad;
        } else {
            $cart[$id] = [
                "nombre" => $plato->nombre,
                "cantidad" => $cantidad,
                "precio" => $plato->precio,
                "imagen" => $plato->imagen,
                "cocina" => $plato->cocina->nombre
            ];
        }

        // 2. Guardamos los cambios en la sesión
        session()->put('cart', $cart);

        // 3. Redirigimos DIRECTAMENTE a la pantalla de pago (checkout)
        return redirect()->route('cart.checkout')->with('info', '¡Platillos listos! Tienes 5 minutos para completar tu transacción.');
    }

    // Eliminar un elemento del carrito
    public function remove($id)
    {
        $cart = session()->get('cart');
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Platillo eliminado del carrito.');
    }
}