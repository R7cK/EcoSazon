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
    // Hacemos el Join y agregamos el where para filtrar por estatus
    $cocinas = \App\Models\Cocina::join('platos', 'cocinas.id', '=', 'platos.cocina_id')
        ->where('cocinas.estatus', 'activa') // <-- NUEVA LÍNEA PARA FILTRAR
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

    // Filtramos zonas y categorías para que solo aparezcan las que tienen cocinas activas
    $zonas = \App\Models\Cocina::where('estatus', 'activa')
                ->select('zona')
                ->distinct()
                ->pluck('zona');
    
    $categorias = \App\Models\Cocina::where('estatus', 'activa')
                ->select('categoria')
                ->distinct()
                ->pluck('categoria');

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
    // Solo traemos las cocinas con estatus 'activa'
    $cocinas = Cocina::where('estatus', 'activa')
                     ->withAvg('platos', 'precio')
                     ->get();
                     
    $categorias = $cocinas->groupBy('categoria');
    
    // También filtramos las zonas para no mostrar zonas de cocinas inactivas
    $zonas = Cocina::where('estatus', 'activa')
                   ->select('zona')
                   ->distinct()
                   ->pluck('zona');

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
    // 1. Validación estricta de todos los campos requeridos
    $request->validate([
        'name'     => 'required|string|max:255',
        'apellido' => 'required|string|max:255',
        'email'    => 'required|string|email|max:255|unique:users',
        'telefono' => 'required|string|max:20',
        'foto'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        'password' => 'required|string|min:8|confirmed',
        'role'     => 'required|in:user,owner', 
        'captcha'  => 'required',
    ]);

    // 2. Validación del Captcha
    if ($request->captcha !== session('captcha_text')) {
        return back()->withErrors(['captcha' => 'El código de verificación humana es incorrecto.'])->withInput();
    }

    // 3. Procesamiento opcional de la Foto de Perfil
    $fotoPath = null;
    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $filename = time() . '-' . \Illuminate\Support\Str::slug($request->name) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('Imagenes/Usuarios'), $filename);
        $fotoPath = 'Imagenes/Usuarios/' . $filename;
    }

    // 4. Generar el código numérico de 6 dígitos
    $codigoVerificacion = rand(100000, 999999);

    // 5. Guardar en la Base de Datos con estado NO VERIFICADO (is_verified = false)
    // El usuario se crea aquí pero se mantiene bloqueado e inaccesible
    $user = User::create([
        'name'              => $request->name,
        'apellido'          => $request->apellido,
        'email'             => $request->email,
        'telefono'          => $request->telefono,
        'foto'              => $fotoPath,
        'password'          => Hash::make($request->password),
        'role'              => $request->role, 
        'verification_code' => $codigoVerificacion,
        'is_verified'       => false, // <-- CLAVE: Cuenta inactiva
    ]);

    // 6. Envío del correo usando las credenciales SMTP configuradas
    Mail::html("
        <div style='font-family: sans-serif; border: 1px solid #eee; padding: 20px; border-radius: 10px; max-width: 500px; margin: auto;'>
            <h2 style='color: #28a745; text-align: center;'>Código de Activación EcoSazón</h2>
            <p>Hola <strong>{$user->name}</strong>,</p>
            <p>Introduce el siguiente código en la pantalla de verificación para activar tu cuenta:</p>
            <div style='background-color: #f8f9fa; border: 1px dashed #28a745; padding: 15px; font-size: 24px; font-weight: bold; text-align: center; letter-spacing: 5px; color: #333; margin: 20px 0;'>
                {$codigoVerificacion}
            </div>
        </div>
    ", function ($message) use ($user) {
        $message->to($user->email)->subject('Código de Verificación - EcoSazón');
    });

    // 7. Guardar el correo en la sesión para que el formulario sepa a qué usuario validar
    session(['pending_verification_email' => $user->email]);

    // 8. REDIRECCIÓN INMEDIATA Y FORZADA A LA PANTALLA DEL CÓDIGO
    // Se eliminó el Auth::login() para evitar que asuma el acceso directo
    return redirect()->route('verify.email')->with('success', 'Se ha enviado un correo de confirmación. Por favor, escribe el código de verificación enviado para activar tu cuenta.');
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
        $totalPlatos = \App\Models\Plato::count(); // <-- NUEVA MÉTRICA

        // Traemos datos para las tablas usando paginate()
        $cocinas = Cocina::with('user')->latest()->paginate(5);
        $usuariosRecientes = User::latest()->paginate(6);

        return view('Admin.dashboard', compact(
            'totalUsuarios', 
            'totalCocinas', 
            'totalComentarios', 
            'totalPlatos', // <-- PASAMOS LA VARIABLE A LA VISTA
            'cocinas', 
            'usuariosRecientes'
        ));
    }

    public function postLogin(Request $request)
{
    $credentials = $request->validate([
        'email'    => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        // SI NO ESTÁ VERIFICADO, EXPULSARLO Y REDIRIGIRLO A LA PANTALLA DE CÓDIGO
        if (!$user->is_verified) {
            Auth::logout();
            session(['pending_verification_email' => $user->email]);
            return redirect()->route('verify.email')->with('info', 'Debes verificar tu cuenta primero. Ingresa el código que te enviamos.');
        }

        $request->session()->regenerate();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role === 'owner') {
            return redirect()->route('owner.dashboard');
        }
        
        return redirect()->intended(route('home'));
    }

    return back()->withErrors(['email' => 'Credenciales incorrectas.'])->withInput();
}

    /**
 * Muestra la vista para introducir el código enviado.
 */
public function showVerifyForm()
{
    if (!session()->has('pending_verification_email')) {
        return redirect()->route('register')->with('error', 'No hay ninguna verificación de cuenta pendiente.');
    }
    return view('auth.verify-code');
}

public function postVerifyCode(Request $request)
{
    $request->validate([
        'code' => 'required|numeric',
    ]);

    $email = session('pending_verification_email');
    $user = User::where('email', $email)->first();

    if (!$user || $user->verification_code != $request->code) {
        return back()->withErrors(['code' => 'El código de verificación es incorrecto o ha expirado.']);
    }

    // Activación oficial del usuario
    $user->is_verified = true;
    $user->verification_code = null; 
    $user->save();

    session()->forget('pending_verification_email');

    // Ahora sí iniciamos sesión de manera segura
    Auth::login($user);

    if ($user->role === 'owner') {
        return redirect()->route('owner.dashboard')->with('success', '¡Cuenta verificada! Panel listo.');
    }

    return redirect()->route('home')->with('success', 'Tu cuenta ha sido creada y verificada exitosamente.');
}

public function resendCode()
{
    $email = session('pending_verification_email');
    $user = User::where('email', $email)->where('is_verified', false)->first();

    if (!$user) {
        return redirect()->route('register')->with('error', 'No se encontró una verificación pendiente.');
    }

    $nuevoCodigo = rand(100000, 999999);
    $user->verification_code = $nuevoCodigo;
    $user->save();

    Mail::html("
        <div style='font-family: sans-serif; border: 1px solid #eee; padding: 20px; border-radius: 10px; max-width: 500px; margin: auto;'>
            <h2 style='color: #28a745; text-align: center;'>Tu nuevo código en EcoSazón</h2>
            <div style='background-color: #f8f9fa; border: 1px dashed #28a745; padding: 15px; font-size: 24px; font-weight: bold; text-align: center; letter-spacing: 5px; color: #333; margin: 20px 0;'>
                {$nuevoCodigo}
            </div>
        </div>
    ", function ($message) use ($user) {
        $message->to($user->email)->subject('Nuevo Código de Verificación - EcoSazón');
    });

    return back()->with('success', 'Se ha reenviado un nuevo código de verificación a tu correo.');
}
}