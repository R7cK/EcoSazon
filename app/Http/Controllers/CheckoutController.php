<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarjeta;
use App\Models\Pedido;
use App\Models\PedidoDetalle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;

class CheckoutController extends Controller
{
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

        $tarjetasGuardadas = Auth::check() ? Tarjeta::where('user_id', Auth::id())->get() : collect();
        return view('cart.checkout', compact('cart', 'total', 'tarjetasGuardadas'));
    }

    public function procesarPago(Request $request)
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach($cart as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }

        // --- ELIMINACIÓN DEL IVA ---
        // El subtotal ahora es exactamente la suma de los platillos y el IVA es 0
        $subtotal = $total;
        $iva = 0;

        $request->validate([
            'metodo_tarjeta' => 'required|in:nueva,guardada',
            'nombre_titular' => 'exclude_if:metodo_tarjeta,guardada|required_if:metodo_tarjeta,nueva|string|max:255',
            'numero_tarjeta' => 'exclude_if:metodo_tarjeta,guardada|required_if:metodo_tarjeta,nueva|numeric|digits:16',
            'mes_expiracion' => 'exclude_if:metodo_tarjeta,guardada|required_if:metodo_tarjeta,nueva|numeric|between:1,12',
            'ano_expiracion' => 'exclude_if:metodo_tarjeta,guardada|required_if:metodo_tarjeta,nueva|numeric|min:' . date('Y'),
            'cvv'            => 'required|numeric|digits_between:3,4', 
            'tarjeta_id'     => 'exclude_if:metodo_tarjeta,nueva|required_if:metodo_tarjeta,guardada|exists:tarjetas,id',
            'email_invitado' => !Auth::check() ? 'required|email' : 'nullable'
        ]);

        $emailContacto = Auth::check() ? Auth::user()->email : $request->email_invitado;

        if ($request->metodo_tarjeta === 'guardada') {
            $tarjeta = Tarjeta::where('id', $request->tarjeta_id)->where('user_id', Auth::id())->firstOrFail();
        } else {
            $tarjetaExistente = Auth::check() ? Tarjeta::where('numero_tarjeta', $request->numero_tarjeta)->where('user_id', Auth::id())->first() : null;

            if ($tarjetaExistente) {
                $tarjeta = $tarjetaExistente;
            } else {
                $tarjeta = new Tarjeta();
                $tarjeta->user_id = Auth::id(); // Si es guest, quedará null
                $tarjeta->nombre_titular = $request->nombre_titular;
                $tarjeta->numero_tarjeta = $request->numero_tarjeta;
                $tarjeta->mes_expiracion = $request->mes_expiracion;
                $tarjeta->ano_expiracion = $request->ano_expiracion;
                $tarjeta->balance_simulado = 1200000.00; 
            }
        }

        if ($tarjeta->balance_simulado < $total) {
            return redirect()->back()->withErrors(['saldo' => 'Fondos insuficientes en la tarjeta.']);
        }
        
        $tarjeta->balance_simulado -= $total;

        if (Auth::check() && ($request->metodo_tarjeta === 'guardada' || $request->has('guardar_tarjeta') || $tarjeta->exists)) {
            $tarjeta->save(); 
        }

        // GUARDADO DE LA ORDEN EN BASE DE DATOS PARA EL HISTORIAL / RECIBO
        $pedido = Pedido::create([
            'user_id' => Auth::id(),
            'email_contacto' => $emailContacto,
            'subtotal' => $subtotal,
            'iva' => $iva,
            'total' => $total,
            'notas' => $request->input('detalles', 'Sin comentarios adicionales') // Valor por defecto
        ]);

        foreach($cart as $item) {
            PedidoDetalle::create([
                'pedido_id' => $pedido->id,
                'plato_nombre' => $item['nombre'],
                'cocina_nombre' => $item['cocina'],
                'cantidad' => $item['cantidad'],
                'precio_unitario' => $item['precio'],
                'subtotal' => $item['precio'] * $item['cantidad']
            ]);
        }

        // ENVÍO DE CORREO AUTOMÁTICO
        Mail::send('emails.recibo', ['pedido' => $pedido], function($message) use ($emailContacto) {
            $message->to($emailContacto)->subject('Recibo de tu compra en EcoSazón');
        });

        session()->forget('cart');
        return redirect()->route('cart.confirmacion', $pedido->id)->with('success', '¡Compra aprobada!');
    }

    public function confirmacion($id)
    {
        $pedido = Pedido::findOrFail($id);
        return view('cart.confirmacion', compact('pedido'));
    }

    public function descargarPdf($id)
    {
        $pedido = Pedido::with('detalles')->findOrFail($id);
        
        // Evita que otro usuario descargue un recibo ajeno
        if ($pedido->user_id && $pedido->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para ver este recibo.');
        }

        $pdf = Pdf::loadView('pdf.recibo', compact('pedido'));
        return $pdf->download('EcoSazon_Orden_' . str_pad($pedido->id, 5, '0', STR_PAD_LEFT) . '.pdf');
    }

    public function misCompras()
    {
        // Añadimos ->with('detalles') para poder ver los platillos individuales
        $pedidos = Pedido::with('detalles')->where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('compras.index', compact('pedidos'));
    }

    // NUEVO MÉTODO
    public function confirmarRecepcion($id)
    {
        $detalle = PedidoDetalle::findOrFail($id);
        
        // Seguridad: Verificar que el usuario autenticado es el dueño de esta orden
        if ($detalle->pedido->user_id !== auth()->id()) {
            abort(403, 'Acceso denegado.');
        }

        $detalle->estatus = 'entregado';
        $detalle->save();

        return back()->with('success', '¡Gracias por confirmar la recepción de tu platillo!');
    }
}