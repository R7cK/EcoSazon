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
        // Lógica para la home si es necesaria
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
        $todasLasCocinas = Cocina::all();
        $categorias = $todasLasCocinas->groupBy('categoria');
        $zonas = Cocina::select('zona')->distinct()->orderBy('zona')->pluck('zona');

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
            'user_id' => auth()->id(),
            'cocina_id' => $cocinaId,
            'contenido' => $request->contenido,
            'calificacion' => $request->calificacion
        ]);

        return back()->with('success', '¡Gracias por tu comentario!');
    }
}