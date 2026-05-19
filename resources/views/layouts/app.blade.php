<!DOCTYPE html>
<html lang="es">
<head>
  <title>@yield('titulopagina')</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
  
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

    :root{
      --verde:#27AE60;
      --verde-oscuro: #1e8449;
      --amarillo:#F1C40F;
      --blanco:#FDFEFE;
      --naranja:#F39C12;
    }

    body{
      background:#FDFEFE;
      font-family: 'Poppins', sans-serif;
      font-size: 1.15rem; 
    }

    .top-header{
      background:#F1C40F;
      padding: 10px 0;
      border-bottom: 1px solid rgba(0,0,0,0.05);
      transition: all 0.3s ease;
    }

    .logo-img{
      height: 115px; 
      width: auto;
      transition: height 0.3s ease;
    }

    .dropdown-menu {
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        border-radius: 15px;
        padding: 10px;
    }

    .dropdown-item {
        border-radius: 8px;
        transition: all 0.2s;
    }

    .dropdown-item:hover {
        background-color: #f8f9fa;
        color: var(--verde-oscuro);
    }

    .navbar-toggler {
        border: none !important;
        padding: 0.5rem;
        color: #333;
    }
    
    .navbar-toggler:focus {
        box-shadow: none;
        outline: none;
    }

    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(0, 0, 0, 0.7)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='3' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
    }

    @media (max-width: 767.98px) {
        .navbar-brand {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            top: -10px;
        }

        .logo-img { height: 110px; }

        .navbar-toggler {
            margin-left: auto;
            margin-top: 10px; 
        }
        
        .navbar-collapse {
            background: rgba(255, 255, 255, 0.98);
            margin-top: 20px;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            position: relative;
            z-index: 2000;
        }

        .nav-link {
            text-align: center;
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
            color: #555 !important;
            font-size: 1.25rem;
        }

        .nav-link:last-child { border-bottom: none; }
    }

    @media (min-width: 768px) {
        .nav-link {
            position: relative;
            font-weight: 500;
            font-size: 1.2rem;
        }
        
        .nav-link:not(.dropdown-toggle)::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 5px;
            left: 0;
            background-color: var(--verde-oscuro);
            transition: width 0.3s;
        }

        .nav-link:not(.dropdown-toggle):hover::after { width: 100%; }
    }

    .btn-orange{
      background:#F39C12;
      color:white;
      border-radius:30px;
      padding:12px 30px;
      border:none;
      transition: transform 0.2s;
    }
    
    .btn-green{
      background:#27AE60;
      color:white;
      border-radius:30px;
      padding:12px 30px;
      border:none;
      transition: transform 0.2s;
    }

    .btn-orange:hover { transform: translateY(-2px); color: white !important; background-color: #E67E22 !important; }
    .btn-green:hover { transform: translateY(-2px); color: white !important; background-color: #1E8449 !important; }

    .hero {
      background: linear-gradient(rgba(0,0,0,.5), rgba(0,0,0,.5)), url("{{ asset('imagenes/ima.avif') }}");
      background-size: cover;
      background-position: center;
      color: white;
      min-height: 500px;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
    }

    .footer-link { text-decoration: none; color: white; transition: color 0.2s; }
    .footer-link:hover { color: var(--amarillo); }
    
    .footer-social-icon {
        display: inline-flex; align-items: center; justify-content: center; width: 50px; height: 50px;
        border-radius: 50%; background-color: rgba(255,255,255,0.1); transition: all 0.3s ease;
    }
    
    .footer-social-icon:hover { background-color: var(--amarillo); color: #000 !important; transform: translateY(-3px); }

    .font-large { font-size: 1.4rem !important; }
    .font-large h1, .font-large .display-3 { font-size: 3.5rem !important; }
    .font-large .nav-link, .font-large p { font-size: 1.5rem !important; }

    :focus { outline: 4px solid var(--naranja) !important; outline-offset: 4px; }

    .accessibility-bar {
        position: fixed; bottom: 20px; left: 20px; z-index: 2000; display: flex; flex-direction: column; gap: 10px;
    }

    .acc-btn {
        width: 50px; height: 50px; border-radius: 50%; border: none; background: var(--verde); color: white;
        box-shadow: 0 4px 10px rgba(0,0,0,0.3); cursor: pointer; transition: all 0.3s;
    }

    .acc-btn:hover { transform: scale(1.1); background: var(--verde-oscuro); }
  </style>
</head>
<body>

{{-- MODIFICACIÓN: El navbar NO aparecerá en login, register ni en verify.email --}}
@if(!Route::is('register') && !Route::is('login') && !Route::is('verify.email'))
<div class="top-header sticky-top shadow-sm" style="z-index: 1050;">
    <nav class="navbar navbar-expand-md p-0">
        <div class="container position-relative" style="min-height: 100px;"> 
            <a class="navbar-brand p-0" href="{{ Auth::check() ? (Auth::user()->role === 'admin' ? route('admin.dashboard') : (Auth::user()->role === 'owner' ? route('owner.dashboard') : route('home'))) : route('home') }}">
                <img src="{{ asset('imagenes/logo1.png') }}" alt="EcoSazón" class="logo-img">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuEcoSazon" aria-controls="menuEcoSazon" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menuEcoSazon">
                <div class="navbar-nav ms-auto align-items-center">
                    
                    @auth
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="nav-link me-md-4 text-dark fw-bold">Panel Admin</a>
                            <a href="{{ route('admin.cocinas.index') }}" class="nav-link me-md-4 text-dark">Gestión de Cocinas</a>
                            
                        @elseif(Auth::user()->role === 'owner')
                            <a href="{{ route('owner.dashboard') }}" class="nav-link me-md-4 text-dark fw-bold">Mi Tablero</a>
                            <a href="{{ route('owner.cocina.ajustes') }}" class="nav-link me-md-4 text-dark">Ajustes</a>
                            <a href="#" class="nav-link me-md-4 text-dark">Mis Platos</a>
                            <a href="#" class="nav-link me-md-4 text-dark">Pedidos</a>
                        @else
                            <a href="{{ route('proposito') }}" class="nav-link me-md-4 text-dark">Propósito</a>
                            <a href="{{ route('planes.index') }}" class="nav-link me-md-4 text-dark">Planes</a>
                            <a href="{{ route('cocinas.index') }}" class="nav-link me-md-4 text-dark">Cocinas</a>
                            
                            <a href="#" class="nav-link me-md-3 text-dark fw-bold" data-bs-toggle="modal" data-bs-target="#locationModal">
                                <i class="fas fa-map-marker-alt text-danger me-1"></i> 
                                {{ session('user_zona', 'Mi Ubicación') }}
                            </a>

                            <a href="{{ route('cart.index') }}" class="nav-link me-md-4 text-dark position-relative">
                                <i class="fas fa-shopping-cart fs-5"></i>
                                @if(session('cart'))
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success" style="font-size: 0.65rem;">
                                        {{ count(session('cart')) }}
                                    </span>
                                @endif
                            </a>
                        @endif
                    @endauth

                    @guest
                        <a href="{{ route('proposito') }}" class="nav-link me-md-4 text-dark">Propósito</a>
                        <a href="{{ route('planes.index') }}" class="nav-link me-md-4 text-dark">Planes</a>
                        <a href="{{ route('cocinas.index') }}" class="nav-link me-md-4 text-dark">Cocinas</a>
                        <a href="{{ route('login') }}" class="btn btn-success btn-lg rounded-pill px-4 btn-inicio-sesion shadow-sm">Iniciar Sesión</a>
                    @endguest

                    @auth
                    <div class="nav-item dropdown ms-md-3">
                        <a class="nav-link dropdown-toggle d-flex align-items-center gap-2 text-dark" href="#" id="navbarUser" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            
                            @if(Auth::user()->foto)
                                <img src="{{ asset(Auth::user()->foto) }}" alt="Perfil" class="rounded-circle object-fit-cover shadow-sm" style="width: 45px; height: 45px; border: 2px solid var(--verde);">
                            @else
                                <i class="fas fa-user-circle fs-1" style="color: var(--naranja);"></i>
                            @endif

                            <div class="d-flex flex-column text-start" style="line-height: 1.1;">
                                <span class="fw-bold" style="font-size: 0.95rem;">
                                    {{ Auth::user()->email }}
                                </span>
                                <span class="text-muted" style="font-size: 0.75rem; font-weight: 500;">
                                    @if(Auth::user()->role === 'admin') 
                                        <i class="fas fa-shield-alt text-success me-1"></i>Administrador
                                    @elseif(Auth::user()->role === 'owner') 
                                        <i class="fas fa-store text-warning me-1"></i>Dueño de Cocina
                                    @else 
                                        <i class="fas fa-user text-info me-1"></i>Cliente
                                    @endif
                                </span>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end rounded-4 p-2 shadow" aria-labelledby="navbarUser">
                            <li><a class="dropdown-item py-2" href="#" onclick="alert('¡La sección de Perfil estará habilitada muy pronto!'); return false;"><i class="fas fa-user-cog me-2"></i>Ajustes de Perfil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="m-0 p-0">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger py-2 w-100 border-0 bg-transparent text-start">
                                        <i class="fas fa-sign-out-alt me-2"></i>Cerrar Sesión
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
</div>
@endif
{{-- FIN CONDICIONAL DE NAVBAR --}}

{{-- MODIFICACIÓN CRÍTICA: Se excluye el Hero de la ruta verify.email también --}}
@if(!Route::is('login') && !Route::is('register') && !Route::is('verify.email') && !Route::is('cocina.perfil') && !Route::is('cart.index') && !Route::is('cocinas.index') && !(Auth::check() && in_array(Auth::user()->role, ['owner', 'admin'])))
<div class="hero">
  <div class="hero-content">
    <h1 class="display-3 fw-bold mb-3">@yield('titulo')</h1>
    <p class="fs-4 mb-5 opacity-75">@yield('subtitulo')</p>

    <div class="mt-4 d-flex justify-content-center gap-3 flex-wrap">
        <a href="{{ route('menu.index') }}" class="btn btn-orange fs-5 fw-bold shadow">Ver todos los menús</a>
        <a href="{{ route('partner.register') }}" class="btn btn-green fs-5 fw-bold shadow" >Unirse como Partner</a>
    </div>
  </div>
</div>
@endif

<div class="main-content">
    @yield('content')
</div>

{{-- MODIFICACIÓN: El Footer NO aparecerá en las rutas de Auth para dejar el fondo limpio --}}
@if(!Route::is('register') && !Route::is('login') && !Route::is('verify.email'))
<footer class="bg-dark text-white pt-5 pb-4 mt-5">
    <div class="container text-center text-md-start">
        <div class="row text-center text-md-start mb-4">
            
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 fw-bold text-warning fs-4">EcoSazón</h5>
                <p>
                    Conectando el sabor casero de Mérida con tu mesa. Apoya el comercio local y disfruta de comida real, todos los días.
                </p>
            </div>

            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 fw-bold text-warning">Menú</h5>
                <p><a href="{{ route('home') }}" class="footer-link">Inicio</a></p>
                <p><a href="{{ route('menu.index') }}" class="footer-link">Buscar Comida</a></p>
                <p><a href="{{ route('planes.index') }}" class="footer-link">Planes</a></p>
                <p><a href="{{ route('partner.register') }}" class="footer-link">Ser Partner</a></p>
            </div>

            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 fw-bold text-warning">Soporte</h5>
                <p><a href="#" class="footer-link">Centro de Ayuda</a></p>
                <p><a href="#" class="footer-link">Términos y Condiciones</a></p>
                <p><a href="#" class="footer-link">Política de Privacidad</a></p>
                <p><a href="{{ route('contact') }}" class="footer-link">Contáctanos</a></p>
            </div>

            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 fw-bold text-warning">Contacto</h5>
                <p><i class="fas fa-home me-3"></i> Mérida, Yucatán, MX</p>
                <p><i class="fas fa-envelope me-3"></i> hola@ecosazon.com</p>
                <p><i class="fas fa-phone me-3"></i> +52 999 123 4567</p>
            </div>
        </div>

        <div class="row align-items-center border-top border-secondary pt-4">
            <div class="col-md-6 text-center text-md-start">
                <p class="mb-0"> © {{ date('Y') }} <strong>EcoSazón</strong>. Todos los derechos reservados.
                    <br><small>Desarrollado por: @yield("Autor", "Equipo EcoSazón")</small>
                </p>
            </div>

            <div class="col-md-6 mt-4 mt-md-0 text-center text-md-end">
                <div class="d-inline-flex gap-3">
                    <a href="#" class="text-white footer-social-icon fs-4"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-white footer-social-icon fs-4"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-white footer-social-icon fs-4"><i class="fab fa-tiktok"></i></a>
                    <a href="#" class="text-white footer-social-icon fs-4"><i class="fab fa-x-twitter"></i></a>
                    <a href="#" class="text-white footer-social-icon fs-4"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>
@endif

<div class="accessibility-bar d-print-none">
    <button class="acc-btn" onclick="toggleFontSize()" title="Aumentar tamaño de letra" aria-label="Aumentar tamaño de letra">
        <i class="fas fa-font"></i>
    </button>
    <button class="acc-btn" onclick="readPage()" title="Leer página en voz alta" aria-label="Leer página en voz alta">
        <i class="fas fa-volume-up"></i>
    </button>
    <button class="acc-btn" onclick="stopReading()" title="Detener lectura" aria-label="Detener lectura">
        <i class="fas fa-stop"></i>
    </button>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<div class="modal fade" id="locationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content rounded-4 border-0 shadow">
            <form action="{{ route('set.location') }}" method="POST">
                @csrf
                <div class="modal-header border-0 p-3">
                    <h6 class="modal-title fw-bold">¿Dónde te encuentras?</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-3 pt-0">
                    <p class="small text-muted mb-2">Ingresa tu zona para mostrarte las cocinas económicas más cercanas.</p>
                    <input type="text" name="zona" class="form-control rounded-pill px-3" placeholder="Ej. Centro, Caucel, Altabrisa" value="{{ session('user_zona') }}" required>
                </div>
                <div class="modal-footer border-0 p-3 pt-0">
                    <button type="submit" class="btn btn-primary w-100 rounded-pill">Actualizar Ubicación</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: '¡Excelente!',
                text: "{{ session('success') }}",
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3500,
                timerProgressBar: true,
            });
        @endif

        @if(session('error') || $errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Atención',
                text: "{{ session('error') ?? 'Hubo un error al procesar tu solicitud. Verifica los datos.' }}",
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4500,
                timerProgressBar: true,
            });
        @endif

        @if(session('info'))
            Swal.fire({
                icon: 'info',
                title: 'Información',
                text: "{{ session('info') }}",
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
            });
        @endif
    });

    function toggleFontSize() {
        document.body.classList.toggle('font-large');
        const isLarge = document.body.classList.contains('font-large');
        localStorage.setItem('accessibleFont', isLarge);
    }

    if (localStorage.getItem('accessibleFont') === 'true') {
        document.body.classList.add('font-large');
    }

    let synth = window.speechSynthesis;
    let utterance;

    function readPage() {
        synth.cancel();
        const elements = document.querySelectorAll('h1, h2, h3, p, a, label');
        let fullText = "Iniciando lectura de la página. ";
        elements.forEach(el => {
            if (el.innerText.trim() !== "") {
                fullText += el.innerText + ". ";
            }
        });
        utterance = new SpeechSynthesisUtterance(fullText);
        utterance.lang = 'es-MX';
        utterance.rate = 1;       
        synth.speak(utterance);
    }

    function stopReading() {
        synth.cancel();
    }
</script>
</body>
</html>