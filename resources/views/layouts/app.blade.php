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
    }

    body{
      background:#FDFEFE;
      font-family: 'Poppins', sans-serif;
    }

    /* HEADER */
    .top-header{
      background:#F1C40F;
      padding: 10px 0;
      border-bottom: 1px solid rgba(0,0,0,0.05);
      transition: all 0.3s ease;
    }

    /* LOGO - AUMENTADO DE TAMAÑO */
    .logo-img{
      height: 100px; /* Tamaño base para PC más grande */
      width: auto;
      transition: height 0.3s ease;
    }

    /* BOTÓN HAMBURGUESA MEJORADO */
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

    /* ESTILOS ESPECÍFICOS PARA MÓVIL */
    @media (max-width: 767.98px) {
        /* Centrar Logo Absolutamente */
        .navbar-brand {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            top: 0px; /* Ajustado para que el logo grande no choque arriba */
        }

        /* Logo más grande en móvil */
        .logo-img {
            height: 85px; /* Aumentado de 60px a 85px */
        }

        /* El botón hamburguesa se queda a la derecha */
        .navbar-toggler {
            margin-left: auto;
            margin-top: 10px; /* Un pequeño ajuste para centrarlo con el logo */
        }
        
        /* Estilo del Menú Desplegable (Tarjeta Blanca) */
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
            font-size: 1.1rem; /* Texto un poco más grande */
        }

        .nav-link:last-child {
            border-bottom: none;
        }
        
        .btn-inicio-sesion {
            width: 100%;
            margin-top: 15px;
            padding: 12px;
            font-size: 1rem;
        }
    }

    /* ESTILOS DE ESCRITORIO */
    @media (min-width: 768px) {
        .nav-link {
            position: relative;
            font-weight: 500;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 5px;
            left: 0;
            background-color: var(--verde-oscuro);
            transition: width 0.3s;
        }

        .nav-link:hover::after {
            width: 100%;
        }
    }

    /* HERO */
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

    .hero-content {
      max-width: 800px;
      padding: 20px;
    }

    .btn-orange{
      background:#F39C12;
      color:white;
      border-radius:30px;
      padding:10px 25px;
      border:none;
      transition: transform 0.2s;
    }
    
    .btn-green{
      background:#27AE60;
      color:white;
      border-radius:30px;
      padding:10px 25px;
      border:none;
      transition: transform 0.2s;
    }

    .btn-orange:hover, .btn-green:hover {
        transform: translateY(-2px);
        color: white;
    }
    
    /* Footer links */
    .footer-link {
        text-decoration: none;
        color: white;
        transition: color 0.2s;
    }
    .footer-link:hover {
        color: var(--amarillo);
    }

  </style>
</head>

<body>

<div class="top-header sticky-top shadow-sm" style="z-index: 1050;">
    <nav class="navbar navbar-expand-md p-0">
        <div class="container position-relative" style="min-height: 90px;"> 
            <a class="navbar-brand p-0" href="{{ route('home') }}">
                <img src="{{ asset('imagenes/logo1.png') }}" alt="EcoSazón" class="logo-img">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuEcoSazon" aria-controls="menuEcoSazon" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menuEcoSazon">
                <div class="navbar-nav ms-auto align-items-center">
                    <a href="{{ route('proposito') }}" class="nav-link me-md-4 text-dark">Propósito</a>
                    <a href="{{ route('planes.index') }}" class="nav-link me-md-4 text-dark">Planes</a>
                    <a href="{{ route('cocinas.index') }}" class="nav-link me-md-4 text-dark">Cocinas</a>
                    <a href="{{ route('login') }}" class="btn btn-success btn-sm rounded-pill px-4 mt-3 mt-md-0 btn-inicio-sesion shadow-sm">Iniciar Sesión</a>
                </div>
            </div>
        </div>
    </nav>
</div>

@if(!Route::is('login') && !Route::is('register'))
<div class="hero">
  <div class="hero-content">
    <h1 class="display-4 fw-bold mb-3">@yield('titulo')</h1>
    <p class="fs-5 mb-5 opacity-75">@yield('subtitulo')</p>

    <div class="bg-white p-3 rounded-4 shadow-lg mx-auto" style="max-width: 600px;">
        <x-search-location />
    </div>

    <div class="mt-5 d-flex justify-content-center gap-3 flex-wrap">
        <a href="{{ route('menu.index') }}" class="btn btn-orange fw-bold shadow">Ver todos los menús</a>
        <a href="{{ route('partner.register') }}" class="btn btn-green fw-bold shadow" >Unirse como Partner</a>
    </div>
  </div>
</div>
@endif

<div class="main-content">
    @yield('content')
</div>

<footer class="bg-dark text-white pt-5 pb-4 mt-5">
    <div class="container text-center text-md-start">
        <div class="row text-center text-md-start">
            
            {{-- Columna 1: Marca y Slogan --}}
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 fw-bold text-warning">EcoSazón</h5>
                <p>
                    Conectando el sabor casero de Mérida con tu mesa. Apoya el comercio local y disfruta de comida real, todos los días.
                </p>
            </div>

            {{-- Columna 2: Enlaces Útiles --}}
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 fw-bold text-warning">Menú</h5>
                <p><a href="{{ route('home') }}" class="footer-link">Inicio</a></p>
                <p><a href="{{ route('menu.index') }}" class="footer-link">Buscar Comida</a></p>
                <p><a href="{{ route('planes.index') }}" class="footer-link">Planes</a></p>
                <p><a href="{{ route('partner.register') }}" class="footer-link">Ser Partner</a></p>
            </div>

            {{-- Columna 3: Legal y Soporte --}}
            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 fw-bold text-warning">Soporte</h5>
                <p><a href="#" class="footer-link">Centro de Ayuda</a></p>
                <p><a href="#" class="footer-link">Términos y Condiciones</a></p>
                <p><a href="#" class="footer-link">Política de Privacidad</a></p>
                <p><a href="{{ route('contact') }}" class="footer-link">Contáctanos</a></p>
            </div>

            {{-- Columna 4: Contacto --}}
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 fw-bold text-warning">Contacto</h5>
                <p><i class="fas fa-home me-3"></i> Mérida, Yucatán, MX</p>
                <p><i class="fas fa-envelope me-3"></i> hola@ecosazon.com</p>
                <p><i class="fas fa-phone me-3"></i> +52 999 123 4567</p>
            </div>
        </div>

        <hr class="mb-4">

        <div class="row align-items-center">
            <div class="col-md-7 col-lg-8">
                <p> © {{ date('Y') }} <strong>EcoSazón</strong>. Todos los derechos reservados.
                    <br><small>Desarrollado por: @yield("Autor", "Equipo EcoSazón")</small>
                </p>
            </div>

            <div class="col-md-5 col-lg-4">
                <div class="text-center text-md-end">
                    <ul class="list-unstyled list-inline">
                        <li class="list-inline-item">
                            <a href="#" class="btn-floating btn-sm text-white" style="font-size: 23px;"><i class="fab fa-facebook"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="btn-floating btn-sm text-white" style="font-size: 23px;"><i class="fab fa-twitter"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="btn-floating btn-sm text-white" style="font-size: 23px;"><i class="fab fa-instagram"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>