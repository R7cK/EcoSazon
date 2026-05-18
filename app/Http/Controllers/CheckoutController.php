<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarjeta;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    /**
     * Muestra la pantalla de confirmación y formulario de pago.
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        if (count($cart) === 0) {
            return redirect()->route('cart.index')->with('error', 'Tu carrito está vacío.');
        }

        $total = 0;
        foreach($cart as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }

        // Recuperar las tarjetas que el usuario ha guardado previamente
        $tarjetasGuardadas = Tarjeta::where('user_id', Auth::id())->get();

        return view('cart.checkout', compact('cart', 'total', 'tarjetasGuardadas'));
    }

    /**
     * Procesa la simulación de cobro.
     */
    public function procesarPago(Request $request)
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach($cart as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }

        // 1. Validar las reglas del formulario de pago
        // MODIFICACIÓN: Se añadió la regla "exclude_if" para ignorar totalmente los campos 
        // de la pestaña que no está activa, evitando conflictos de validación.
        $request->validate([
            'metodo_tarjeta' => 'required|in:nueva,guardada',
            // Si es nueva tarjeta (Se ignora si usa guardada):
            'nombre_titular' => 'exclude_if:metodo_tarjeta,guardada|required_if:metodo_tarjeta,nueva|string|max:255',
            'numero_tarjeta' => 'exclude_if:metodo_tarjeta,guardada|required_if:metodo_tarjeta,nueva|numeric|digits:16',
            'mes_expiracion' => 'exclude_if:metodo_tarjeta,guardada|required_if:metodo_tarjeta,nueva|numeric|between:1,12',
            'ano_expiracion' => 'exclude_if:metodo_tarjeta,guardada|required_if:metodo_tarjeta,nueva|numeric|min:' . date('Y'),
            // El CVV SIEMPRE es requerido en el request para validar la "acción" de compra
            'cvv'            => 'required|numeric|digits_between:3,4', 
            // Si es tarjeta guardada (Se ignora si usa nueva):
            'tarjeta_id'     => 'exclude_if:metodo_tarjeta,nueva|required_if:metodo_tarjeta,guardada|exists:tarjetas,id'
        ]);

        // 2. Determinar el origen de la tarjeta y su balance actual
        if ($request->metodo_tarjeta === 'guardada') {
            // Tarjeta cargada desde la base de datos
            $tarjeta = Tarjeta::where('id', $request->tarjeta_id)
                              ->where('user_id', Auth::id())
                              ->firstOrFail();
        } else {
            // Es una tarjeta nueva. Buscamos si ya se había registrado antes para conservar su saldo,
            // de lo contrario, creamos una instancia temporal con el saldo inicial de $1,200,000
            $tarjetaExistente = Tarjeta::where('numero_tarjeta', $request->numero_tarjeta)
                                       ->where('user_id', Auth::id())
                                       ->first();

            if ($tarjetaExistente) {
                $tarjeta = $tarjetaExistente;
            } else {
                $tarjeta = new Tarjeta();
                $tarjeta->user_id = Auth::id();
                $tarjeta->nombre_titular = $request->nombre_titular;
                $tarjeta->numero_tarjeta = $request->numero_tarjeta;
                $tarjeta->mes_expiracion = $request->mes_expiracion;
                $tarjeta->ano_expiracion = $request->ano_expiracion;
                $tarjeta->balance_simulado = 1200000.00; // Saldo por defecto inicial
            }
        }

        // 3. Validar fondos suficientes
        if ($tarjeta->balance_simulado < $total) {
            return redirect()->back()->withErrors(['saldo' => 'Fondos insuficientes en la tarjeta simulada (Saldo: $' . number_format($tarjeta->balance_simulado, 2) . ').']);
        }

        // 4. Descontar el dinero de la simulación
        $tarjeta->balance_simulado -= $total;

        // 5. Guardar la tarjeta en la BD únicamente si es nueva y marcó la opción,
        // o si ya existía y solo actualizamos su saldo. ¡NUNCA SE ASIGNA NI GUARDA EL CVV!
        if ($request->metodo_tarjeta === 'guardada' || $request->has('guardar_tarjeta') || $tarjeta->exists) {
            $tarjeta->save(); 
        }

        // 6. Limpiar el Carrito de la sesión al completarse la orden exitosamente
        session()->forget('cart');

        return redirect()->route('cart.index')->with('success', '¡Compra simulada con éxito! Se descontaron $' . number_format($total, 2) . ' MXN de tu tarjeta.');
    }
}