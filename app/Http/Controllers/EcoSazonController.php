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
        // 1. Validación condicional utilizando 'required_unless' de Laravel
        $request->validate([
            'nombre'           => 'required|string|max:255|unique:cocinas,nombre',
            'zona'             => 'required|string|max:255',
            'categoria'        => 'required|string|max:255',
            'descripcion'      => 'required|string',
            'imagen_principal' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            // Obligatorio solo si NO se marcó la casilla de usar la misma imagen
            'imagen_fachada'   => 'required_unless:usar_misma_imagen,1|image|mimes:jpeg,png,jpg,webp|max:2048', 
            'telefono'         => 'nullable|string|max:255',
            'horario'          => 'nullable|string|max:255',
        ], [
            'nombre.unique' => 'Error: Esta cocina económica ya está registrada.',
            'imagen_fachada.required_unless' => 'Debes subir la imagen de la fachada o marcar la casilla para duplicar la principal.'
        ]);

        $cocina = new Cocina();
        $cocina->user_id = Auth::id(); 
        $cocina->nombre = $request->nombre;
        
        $slug = Str::slug($request->nombre);
        $cocina->slug = $slug;
        
        $cocina->zona = $request->zona;
        $cocina->categoria = $request->categoria;
        $cocina->descripcion = $request->descripcion;
        $cocina->telefono = $request->telefono;
        $cocina->horario = $request->horario;
        
        // Mapeo dinámico de categorías a carpetas físicas
        $carpetasCategorias = [
            'Comida Yucateca'     => 'Yucateca',
            'Antojitos Regionales'=> 'Regional',
            'Comida Tradicional'  => 'Tradicional',
            'Comida Casera'       => 'Casera',
            'Mariscos'            => 'Mariscos',
            'Saludable'           => 'Saludable',
            'Vegana'              => 'Vegano'
        ];
        $subcarpeta = $carpetasCategorias[$request->categoria] ?? Str::slug($request->categoria);

        // 2. Procesar Imagen Principal
        if ($request->hasFile('imagen_principal')) {
            $fileP = $request->file('imagen_principal');
            $filenameP = $slug . '-principal.' . $fileP->getClientOriginalExtension();
            $fileP->move(public_path("Imagenes/Cocinas/{$subcarpeta}"), $filenameP);
            $cocina->imagen_principal = "Imagenes/Cocinas/{$subcarpeta}/{$filenameP}";

            // Si se seleccionó usar la misma imagen, clonamos el archivo físicamente
            if ($request->has('usar_misma_imagen')) {
                $filenameF = $slug . '-fachada.' . $fileP->getClientOriginalExtension();
                copy(public_path("Imagenes/Cocinas/{$subcarpeta}/{$filenameP}"), public_path("Imagenes/Cocinas/{$subcarpeta}/{$filenameF}"));
                $cocina->imagen_fachada = "Imagenes/Cocinas/{$subcarpeta}/{$filenameF}";
            }
        }

        // 3. Procesar Imagen de Fachada independiente (si no se marcó la casilla de duplicar)
        if (!$request->has('usar_misma_imagen') && $request->hasFile('imagen_fachada')) {
            $fileF = $request->file('imagen_fachada');
            $filenameF = $slug . '-fachada.' . $fileF->getClientOriginalExtension();
            $fileF->move(public_path("Imagenes/Cocinas/{$subcarpeta}"), $filenameF);
            $cocina->imagen_fachada = "Imagenes/Cocinas/{$subcarpeta}/{$filenameF}";
        }

        $cocina->save();

        return redirect()->route('owner.dashboard')->with('success', '¡Cocina registrada exitosamente!');
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
  // En app/Http/Controllers/EcoSazonController.php

public function postLogin(Request $request)
{
    $credentials = $request->validate([
        'email'    => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        $user = Auth::user();

        // 1. Redirigir si es Admin
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // 2. Redirigir si es Dueño (Owner)
        if ($user->role === 'owner') {
            return redirect()->route('owner.dashboard');
        }
        
        // 3. Cliente común
        return redirect()->intended(route('home'));
    }

    return back()->withErrors(['email' => 'Credenciales incorrectas.'])->withInput();
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

   public function storePlato(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'nombre'      => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio'      => 'required|numeric|min:0',
            'categoria'   => 'nullable|string|max:255',
            'imagen'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'nombre.required' => 'El nombre del platillo es obligatorio.',
            'precio.required' => 'Debes asignar un precio al platillo.',
            'precio.numeric'  => 'El precio debe ser un número válido.',
        ]);

        $cocina = \App\Models\Cocina::where('user_id', \Illuminate\Support\Facades\Auth::id())->firstOrFail();

        $plato = new \App\Models\Plato();
        $plato->cocina_id   = $cocina->id;
        $plato->nombre      = $request->nombre;
        $plato->descripcion = $request->descripcion;
        $plato->precio      = $request->precio;
        $plato->categoria   = $request->categoria;

        // GUARDADO FÍSICO DIRECTO EN PUBLIC/IMAGENES/PLATOS
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $filename = \Illuminate\Support\Str::slug($request->nombre) . '-' . time() . '.' . $file->getClientOriginalExtension();
            
            // Movemos directamente a la carpeta pública
            $file->move(public_path('Imagenes/Platos'), $filename);
            
            // Guardamos la ruta limpia en la base de datos
            $plato->imagen = 'Imagenes/Platos/' . $filename;
        }

        $plato->save();

        return redirect()->route('owner.dashboard')->with('success', '¡Platillo agregado al menú correctamente!');
    }
    /**
     * Elimina un platillo del menú asegurando que pertenezca a la cocina del dueño autenticado.
     */
    public function destroyPlato($id)
    {
        $cocina = \App\Models\Cocina::where('user_id', \Illuminate\Support\Facades\Auth::id())->firstOrFail();
        $plato = \App\Models\Plato::where('id', $id)->where('cocina_id', $cocina->id)->firstOrFail();

        // ELIMINAR LA IMAGEN FÍSICA DIRECTA
        if ($plato->imagen && file_exists(public_path($plato->imagen))) {
            unlink(public_path($plato->imagen));
        }

        $plato->delete();

        return redirect()->route('owner.dashboard')->with('success', '¡El platillo ha sido eliminado de tu menú!');
    }

    /**
     * Actualiza la información de un platillo existente.
     */
    public function updatePlato(\Illuminate\Http\Request $request, $id)
    {
        $request->validate([
            'nombre'      => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio'      => 'required|numeric|min:0',
            'categoria'   => 'nullable|string|max:255',
            'imagen'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $cocina = \App\Models\Cocina::where('user_id', \Illuminate\Support\Facades\Auth::id())->firstOrFail();
        
        $plato = \App\Models\Plato::where('id', $id)
                                  ->where('cocina_id', $cocina->id)
                                  ->firstOrFail();

        $plato->nombre      = $request->nombre;
        $plato->descripcion = $request->descripcion;
        $plato->precio      = $request->precio;
        $plato->categoria   = $request->categoria;

        // ACTUALIZACIÓN DE IMAGEN CON GUARDADO DIRECTO
        if ($request->hasFile('imagen')) {
            // Eliminar imagen física anterior si existe
            if ($plato->imagen && file_exists(public_path($plato->imagen))) {
                unlink(public_path($plato->imagen));
            }
            
            $file = $request->file('imagen');
            $filename = \Illuminate\Support\Str::slug($request->nombre) . '-' . time() . '.' . $file->getClientOriginalExtension();
            
            $file->move(public_path('Imagenes/Platos'), $filename);
            $plato->imagen = 'Imagenes/Platos/' . $filename;
        }

        $plato->save();

        return redirect()->route('owner.dashboard')->with('success', '¡Platillo actualizado correctamente!');
    }
    /**
 * Muestra la pantalla completa de ajustes de la cocina.
 */
public function ajustes()
{
    // Obtener la cocina vinculada al dueño actual
    $cocina = Cocina::where('user_id', Auth::id())->first();

    // Si no tiene cocina, redirigir al registro
    if (!$cocina) {
        return redirect()->route('partner.register')
            ->with('info', 'Primero completa el registro de tu cocina.');
    }

    return view('Owners.ajustes', compact('cocina'));
}

/**
     * Actualiza los ajustes generales de la cocina del dueño.
     */
public function updateAjustes(Request $request)
    {
        $cocina = Cocina::where('user_id', Auth::id())->firstOrFail();

        $request->validate([
            'nombre'           => 'required|string|max:255|unique:cocinas,nombre,' . $cocina->id,
            'zona'             => 'required|string|max:255',
            'categoria'        => 'required|string|max:255',
            'descripcion'      => 'required|string',
            'horario'          => 'nullable|string|max:255',
            'telefono'         => 'nullable|string|max:255',
            'imagen_principal' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'imagen_fachada'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $cocina->nombre      = $request->nombre;
        $slug = Str::slug($request->nombre);
        $cocina->slug        = $slug;
        $cocina->zona        = $request->zona;
        $cocina->categoria   = $request->categoria;
        $cocina->descripcion = $request->descripcion;
        $cocina->horario     = $request->horario;
        $cocina->telefono    = $request->telefono;

        $carpetasCategorias = [
            'Comida Yucateca'     => 'Yucateca',
            'Antojitos Regionales'=> 'Regional',
            'Comida Tradicional'  => 'Tradicional',
            'Comida Casera'       => 'Casera',
            'Mariscos'            => 'Mariscos',
            'Saludable'           => 'Saludable',
            'Vegana'              => 'Vegano'
        ];
        $subcarpeta = $carpetasCategorias[$request->categoria] ?? Str::slug($request->categoria);

        // Caso A: Sube una nueva imagen principal
        if ($request->hasFile('imagen_principal')) {
            $fileP = $request->file('imagen_principal');
            $filenameP = $slug . '-principal.' . $fileP->getClientOriginalExtension();
            $fileP->move(public_path("Imagenes/Cocinas/{$subcarpeta}"), $filenameP);
            $cocina->imagen_principal = "Imagenes/Cocinas/{$subcarpeta}/{$filenameP}";

            // Si además pide replicarla a la fachada en este momento
            if ($request->has('usar_misma_imagen')) {
                $filenameF = $slug . '-fachada.' . $fileP->getClientOriginalExtension();
                copy(public_path("Imagenes/Cocinas/{$subcarpeta}/{$filenameP}"), public_path("Imagenes/Cocinas/{$subcarpeta}/{$filenameF}"));
                $cocina->imagen_fachada = "Imagenes/Cocinas/{$subcarpeta}/{$filenameF}";
            }
        } 
        // Caso B: No sube nueva principal, pero marca la casilla para heredar la que ya está guardada en la BD
        elseif ($request->has('usar_misma_imagen') && $cocina->imagen_principal) {
            // Extraer la extensión actual de la base de datos o usar por defecto png
            $ext = pathinfo($cocina->imagen_principal, PATHINFO_EXTENSION) ?: 'png';
            $filenameF = $slug . '-fachada.' . $ext;
            
            if (file_exists(public_path($cocina->imagen_principal))) {
                copy(public_path($cocina->imagen_principal), public_path("Imagenes/Cocinas/{$subcarpeta}/{$filenameF}"));
                $cocina->imagen_fachada = "Imagenes/Cocinas/{$subcarpeta}/{$filenameF}";
            }
        }

        // Caso C: Sube una fachada independiente (solo si no se marcó reutilizar la misma)
        if (!$request->has('usar_misma_imagen') && $request->hasFile('imagen_fachada')) {
            $fileF = $request->file('imagen_fachada');
            $filenameF = $slug . '-fachada.' . $fileF->getClientOriginalExtension();
            $fileF->move(public_path("Imagenes/Cocinas/{$subcarpeta}"), $filenameF);
            $cocina->imagen_fachada = "Imagenes/Cocinas/{$subcarpeta}/{$filenameF}";
        }

        $cocina->save();

        return redirect()->route('owner.cocina.ajustes')->with('success', '¡Establecimiento actualizado con éxito!');
    }
  public function adminDashboard()
    {
        // Obtenemos los conteos para las tarjetas
        $totalUsuarios = User::count();
        $totalCocinas = Cocina::count();
        $totalComentarios = \App\Models\Comentario::count();

        // Traemos datos para las tablas usando paginate() en lugar de get()
        $cocinas = Cocina::with('user')->latest()->paginate(5);
        $usuariosRecientes = User::latest()->paginate(6);

        return view('Admin.dashboard', compact(
            'totalUsuarios', 
            'totalCocinas', 
            'totalComentarios', 
            'cocinas', 
            'usuariosRecientes'
        ));
    }
}