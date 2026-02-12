<!DOCTYPE html>
<html lang="es">
<head>
  <title>@yield('titulopagina')</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
  
  <style>
    :root{
      --verde:#27AE60;
      --amarillo:#F1C40F;
      --blanco:#FDFEFE;
    }

    body{
      background:#FDFEFE;
    }

    /* HEADER BLANCO */
    .top-header{
      background:#F1C40F;
      padding:15px 0;
      border-bottom:1px solid #eee;
    }

    .logo-img{
      height:100px;   
      width:auto;
    }

    /* HERO */
   .hero {
      background: linear-gradient(rgba(0,0,0,.5), rgba(0,0,0,.5)), url("{{ asset('imagenes/ima.avif') }}");
      background-size: cover;
      background-position: center;
      color: white;
      min-height: 450px;
      display: flex;
      align-items: center;
      justify-content: center; /* Esto quita el desplazamiento a los lados */
      text-align: center;
    }

    /* Limitamos el ancho del texto para que no ocupe toda la pantalla */
    .hero-content {
      max-width: 800px;
      padding: 20px;
    }

    .hero h1{
      font-size:2.6rem;
      font-weight:bold;
    }

    .hero p{
      font-size:1.1rem;
      max-width:700px;
      margin:15px auto;
    }

    .btn-orange{
      background:#F39C12;
      color:white;
      border-radius:30px;
      padding:10px 22px;
      border:none;
    }

    .colorblanco
    {color:white;}
    
    .btn-green{
      background:#27AE60;
      color:white;
      border-radius:30px;
      padding:10px 22px;
      border:none;
    }

    /* FOOTER */
    .footer-small{
      background:#1e1e1e;
      color:#ccc;
      padding:10px 0;
      font-size:0.85rem;
    }

    .footer-small i{
      margin:0 6px;
      color:#F1C40F;
      cursor:pointer;
    }
  </style>
</head>

<body>

<div class="top-header">
  <div class="container d-flex justify-content-between align-items-center">
    <div>
      <a href="{{ route('home') }}">
        <img src="{{ asset('imagenes/logo1.png') }}" alt="EcoSazón" class="logo-img">
      </a>
    </div>

    <div class="d-none d-md-block">
      <a href="{{ route('proposito') }}" class="me-3 text-dark text-decoration-none fw-medium">Propósito</a>
      <a href="{{ route('planes.index') }}" class="me-3 text-dark text-decoration-none fw-medium">Planes</a>
      <a href="{{ route('cocinas.index') }}" class="me-3 text-dark text-decoration-none fw-medium">Cocinas</a>
      <a href="{{ route('login') }}" class="btn btn-success btn-sm rounded-pill px-4">Iniciar Sesión</a>
    </div>
  </div>
</div>

{{-- Solo muestra el Hero si NO estamos en la página de login o registro --}}
@if(!Route::is('login') && !Route::is('register'))
<div class="hero">
  <div class="hero-content">
    <h1 class="display-4 fw-bold">@yield('titulo')</h1>
    <p class="fs-5 mb-4">@yield('subtitulo')</p>

    <x-search-location />

    <div class="mt-4 d-flex justify-content-center gap-3">
        <a href="{{ route('menu.index') }}" class="btn btn-orange btn-sm text-decoration-none shadow">Ver todos los menús</a>
        <a href="{{ route('partner.register') }}" class="btn btn-green text-decoration-none shadow" >Unirse como Partner</a>
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
                    <p><a href="{{ route('home') }}" class="text-white text-decoration-none">Inicio</a></p>
                    <p><a href="{{ route('menu.index') }}" class="text-white text-decoration-none">Buscar Comida</a></p>
                    <p><a href="{{ route('planes.index') }}" class="text-white text-decoration-none">Planes</a></p>
                    <p><a href="{{ route('partner.register') }}" class="text-white text-decoration-none">Ser Partner</a></p>
                </div>

                {{-- Columna 3: Legal y Soporte --}}
                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4 fw-bold text-warning">Soporte</h5>
                    <p><a href="#" class="text-white text-decoration-none">Centro de Ayuda</a></p>
                    <p><a href="#" class="text-white text-decoration-none">Términos y Condiciones</a></p>
                    <p><a href="#" class="text-white text-decoration-none">Política de Privacidad</a></p>
                    <p><a href="{{ route('contact') }}" class="text-white text-decoration-none">Contáctanos</a></p>
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
