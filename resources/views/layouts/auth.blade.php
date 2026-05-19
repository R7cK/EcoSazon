<!DOCTYPE html>
<html lang="es">
<head>
    <title>@yield('titulopagina')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <style>
        body { 
            /* Fondo con opacidad oscura y la imagen de fondo */
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('{{ asset('imagenes/fondo-cocina.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Segoe UI', sans-serif; 
            display: flex; 
            align-items: center; 
            min-height: 100vh; 
        }
        .auth-logo { height: 60px; }
    </style>
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>