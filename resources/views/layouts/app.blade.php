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

<footer class="footer-small text-center mt-5">
  <div class="container">
    <div>© 2026 @yield("Autor", "Equipo EcoSazón") – @yield("actividad", "Mérida, Yucatán")</div>
    <div class="mt-2 h4">
      <i class="fa-brands fa-facebook mx-2"></i>
      <i class="fa-brands fa-instagram mx-2"></i>
      <i class="fa-brands fa-whatsapp mx-2"></i>
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
