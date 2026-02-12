<!DOCTYPE html>
<html lang="es">
<head>
    <title>@yield('titulopagina')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <style>
        body { background: #f8f9fa; font-family: 'Segoe UI', sans-serif; display: flex; align-items: center; min-height: 100vh; }
        .auth-logo { height: 60px; margin-bottom: 2rem; }
    </style>
</head>
<body>
    <div class="container">
        <div class="text-center">
            <a href="{{ route('home') }}">
                <img src="{{ asset('imagenes/logo1.png') }}" alt="EcoSazón" class="auth-logo">
            </a>
        </div>
        @yield('content')
    </div>
</body>
</html>