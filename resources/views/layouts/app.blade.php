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
    .hero{
      background:
        linear-gradient(rgba(0,0,0,.45), rgba(0,0,0,.45)),
        url("{{ asset('imagenes/ima.avif') }}");
      background-size:cover;
      background-position:center;
      color:white;
      min-height:420px;
      display:flex;
      align-items:center;
      text-align:center;
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
      <img src="{{ asset('imagenes/logo1.png') }}" alt="EcoSazón" class="logo-img">
    </div>

    <div>
      <a href="#" class="me-3 text-dark text-decoration-none">Propósito</a>
      <a href="#" class="me-3 text-dark text-decoration-none">Planes</a>
      <a href="#" class="me-3 text-dark text-decoration-none">Cocinas</a>
      <a href="#" class="btn btn-success btn-sm rounded-pill">Iniciar Sesión</a>
    </div>

  </div>
</div>

<!-- HERO -->
<div class="hero">
  <div class="container">
    <h1>@yield('titulo')</h1>
    <p>@yield('subtitulo')</p>

    <div class="mt-4">
      <button class="btn btn-orange me-2">Ver Menú del Día</button>
      <button class="btn btn-green">Unirse como Partner</button>
    </div>
  </div>
</div>

<!-- CONTENIDO -->
<div class="container mt-5 text-center">
  <h3>¿Por qué elegir EcoSazón?</h3>
  <p class="mt-3">
    Conectamos cocinas locales con personas que buscan comida auténtica,
    hecha con amor y tradición.
  </p>
</div>

<!-- FOOTER -->
<div class="footer-small text-center mt-5">
  <div>
    © 2026 @yield("Autor") – @yield("actividad")
  </div>
  <div class="mt-1">
    <i class="fa-brands fa-facebook"></i>
    <i class="fa-brands fa-instagram"></i>
    <i class="fa-brands fa-whatsapp"></i>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
