<?php

namespace App\Http\Controllers;

use App\Models\Cocina;
use App\Models\Plato;  
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail; 

class EcoSazonController extends Controller
{
    /**
     * Muestra la página principal de EcoSazón.
     */
    public function index()
{
    // Hacemos el Join pero sin el groupBy para evitar el choque con el modo estricto de MySQL
    $cocinas = \App\Models\Cocina::join('platos', 'cocinas.id', '=', 'platos.cocina_id')
        ->select(
            'cocinas.nombre',
            'cocinas.imagen_principal as imagen',
            'platos.nombre as menu_dia',
            'platos.precio as precio_completo',
            'cocinas.calificacion',
            'cocinas.zona',
            'cocinas.categoria',
            'platos.descripcion'
        )
        ->get();

    // Obtenemos las zonas únicas de la tabla cocinas para el filtro
    $zonas = \App\Models\Cocina::select('zona')
                ->distinct()
                ->pluck('zona');
    
    $categorias = \App\Models\Cocina::select('categoria')->distinct()->pluck('categoria');

    return view('ecosazon', compact('cocinas', 'zonas', 'categorias'));
}

    /**
     * Muestra la página de Login
     */
    public function login(Request $request)
    {
        if ($request->query('timeout')) {
            session()->flash('info', 'Su sesión ha expirado por inactividad. Por favor, ingrese de nuevo.');
        }

        $captcha = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
        session(['captcha_text' => $captcha]);
        return view('login', compact('captcha'));
    }

    /**
     * Muestra la página de Registro
     */
    public function register()
    {
        $captcha = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
        session(['captcha_text' => $captcha]);
        return view('register', compact('captcha'));
    }

    /**
     * Dashboard para consumidores comunes
     */
    public function dashboard()
    {
        return view('dashboard'); 
    }

    /**
     * Pantalla específica para Dueños de Cocina
     */
public function ownerDashboard()
{
    $user = Auth::user();
    
    // Obtenemos la cocina vinculada al usuario logueado
    $cocina = Cocina::where('user_id', $user->id)->first();

    // Si el socio aún no ha registrado su cocina, lo redirigimos
    if (!$cocina) {
        return redirect()->route('partner.register')
            ->with('info', 'Bienvenido. Primero completa el registro de tu cocina.');
    }

    $platos = $cocina->platos;
    $comentarios = $cocina->comentarios()->with('user')->latest()->take(5)->get();

    return view('Owners.owner_dashboard', compact('cocina', 'platos', 'comentarios'));
}

    public function partner()
    {
        return view('partner');
    }

    public function proposito()
    {
        return view('proposito');
    }

    public function planes()
    {
        return view('planes');
    }

    public function cocinas()
    {
        $cocinas = Cocina::withAvg('platos', 'precio')->get();
        $categorias = $cocinas->groupBy('categoria');
        $zonas = Cocina::select('zona')->distinct()->pluck('zona');

        return view('cocinas', compact('categorias', 'zonas'));
    }

    public function perfilCocina($slug)
    {
        $cocina = Cocina::with('platos')->where('slug', $slug)->firstOrFail();
        return view('perfil-cocina', compact('cocina'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:cocinas,nombre',
            'zona'   => 'required|string|max:255',
            'categoria' => 'nullable|string|max:255',
        ], [
            'nombre.unique' => 'Error: Esta cocina económica ya está registrada en la base de datos.',
        ]);

        $cocina = new Cocina();
        $cocina->nombre = $request->nombre;
        $cocina->slug = Str::slug($request->nombre);
        $cocina->zona = $request->zona;
        $cocina->categoria = $request->categoria;
        $cocina->save();

        return redirect()->back()->with('success', 'Cocina agregada correctamente.');
    }

    /**
     * Procesa el registro del usuario e inicia sesión con distinción de rol
     */
    public function postRegister(Request $request)
    {
        // 1. Validación de entradas incluyendo el rol
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role'     => 'required|in:user,owner', // Validación del nuevo campo de rol
            'captcha'  => 'required',
        ]);

        // 2. Validación del Captcha
        if ($request->captcha !== session('captcha_text')) {
            return back()->withErrors(['captcha' => 'El código de verificación es incorrecto.'])->withInput();
        }

        // 3. Creación del usuario con su rol correspondiente
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role, 
        ]);

        // 4. ENVÍO DE CORREO DE CONFIRMACIÓN
        Mail::html("
            <div style='font-family: sans-serif; border: 1px solid #eee; padding: 20px; border-radius: 10px;'>
                <h2 style='color: #28a745;'>¡Hola, {$user->name}!</h2>
                <p>Tu cuenta en <strong>EcoSazón</strong> ha sido creada exitosamente como " . ($user->role === 'owner' ? 'Dueño de Cocina' : 'Cliente') . ".</p>
                <a href='".route('login')."' style='background-color: #28a745; color: white; padding: 10px 20px; text-decoration: none; border-radius: 25px;'>Ir al Login</a>
            </div>
        ", function ($message) use ($user) {
            $message->to($user->email)->subject('¡Bienvenido a EcoSazón!');
        });

        // 5. Inicio de sesión automático
        Auth::login($user);

        // 6. Redirección basada en el rol recién creado
        if ($user->role === 'owner') {
            return redirect()->route('owner.dashboard')->with('success', '¡Bienvenido Socio! Tu panel de gestión está listo.');
        }

        return redirect()->route('home')->with('success', 'Cuenta creada exitosamente. Revisa tu correo de bienvenida.');
    }

    /**
     * Procesa el inicio de sesión e identifica el rol para la redirección
     */
    public function postLogin(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Verificamos el rol del usuario que acaba de entrar
            $user = Auth::user();

            if ($user->role === 'owner') {
                // Redirigir a la pantalla de la cocina (Dashboard de Socio)
                return redirect()->route('owner.dashboard');
            }
            
            // Redirigir a la home común para consumidores
            return redirect()->intended(route('home'));
        }

        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->withInput();
    }

    /**
     * Cierra la sesión del usuario
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }

    /**
     * Guarda comentarios en las cocinas
     */
    public function storeComentario(Request $request, $cocinaId)
    {
        $request->validate([
            'contenido' => 'required|string|max:500',
            'calificacion' => 'required|integer|min:1|max:5'
        ]);

        \App\Models\Comentario::create([
            'user_id' => Auth::id(),
            'cocina_id' => $cocinaId,
            'contenido' => $request->contenido,
            'calificacion' => $request->calificacion
        ]);

        return back()->with('success', '¡Gracias por tu comentario!');
    }

    // 1. Guarda la cocina vinculándola al usuario logueado
    public function storeCocina(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:cocinas,nombre',
            'zona'   => 'required|string|max:255',
            'categoria' => 'nullable|string',
        ]);

        $cocina = new Cocina();
        $cocina->nombre = $request->nombre;
        $cocina->slug = \Illuminate\Support\Str::slug($request->nombre);
        $cocina->zona = $request->zona;
        $cocina->categoria = $request->categoria;
        
        // Datos automáticos o temporales para cumplir con la migración
        $cocina->descripcion = 'Descripción pendiente...'; 
        $cocina->imagen_principal = 'default.jpg'; 
        $cocina->user_id = Auth::id(); // Vincula la cocina contigo
        
        $cocina->save();

        // Tras guardar, te mandamos por fin a tu panel
        return redirect()->route('owner.dashboard')->with('success', '¡Cocina registrada con éxito!');
    }

    // 2. Guarda un plato nuevo en el menú
    public function storePlato(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'categoria' => 'nullable|string',
        ]);

        $cocina = Auth::user()->cocina; // Buscamos la cocina del dueño

        $plato = new Plato();
        $plato->nombre = $request->nombre;
        $plato->precio = $request->precio;
        $plato->categoria = $request->categoria;
        $plato->cocina_id = $cocina->id; // Vinculamos el plato a su cocina
        $plato->save();

        return back()->with('success', 'Plato añadido correctamente.');
    }
    public function destroyPlato($id)
    {
        $plato = Plato::findOrFail($id);
        
        // Medida de seguridad: verificar que el plato pertenece a la cocina de este dueño
        if ($plato->cocina_id == Auth::user()->cocina->id) {
            $plato->delete();
            return back()->with('success', 'Plato eliminado correctamente.');
        }

        return back()->with('error', 'No tienes permiso para eliminar este plato.');
    }
    public function updatePlato(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'categoria' => 'nullable|string',
        ]);

        $plato = Plato::findOrFail($id);

        // Medida de seguridad: verificar que el plato pertenece a tu cocina
        if ($plato->cocina_id == Auth::user()->cocina->id) {
            $plato->nombre = $request->nombre;
            $plato->precio = $request->precio;
            $plato->categoria = $request->categoria;
            $plato->save();

            return back()->with('success', 'Plato actualizado correctamente.');
        }

        return back()->with('error', 'No tienes permiso para editar este plato.');
    }
    public function updateAjustes(Request $request)
    {
        // Validamos los datos (horario es opcional, zona es requerida)
        $request->validate([
            'horario' => 'nullable|string|max:255',
            'zona' => 'required|string|max:255',
        ]);

        // Buscamos la cocina del usuario actual
        $cocina = Auth::user()->cocina;

        if ($cocina) {
            $cocina->horario = $request->horario;
            $cocina->zona = $request->zona;
            $cocina->save();

            return back()->with('success', 'Ajustes actualizados correctamente.');
        }

        return back()->with('error', 'Ocurrió un error al actualizar los ajustes.');
    }
}
