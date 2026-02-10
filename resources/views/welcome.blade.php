<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'EcoSazón') }} - Sabor Local a Domicilio</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <style>
        /* Paleta de Colores Oficial */
        :root {
            --naranja-tradicion: #E67E22;
            --verde-eco: #27AE60;
            --amarillo-maiz: #F1C40F;
            --blanco-crema: #FDFEFE;
            --negro-texto: #2C3E50;
        }

        body {
            font-family: 'Instrument Sans', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--blanco-crema);
            color: var(--negro-texto);
        }

        header {
            background-color: white;
            padding: 1rem 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo {
            font-weight: bold;
            font-size: 1.5rem;
            color: var(--verde-eco);
        }

        nav {
            display: flex;
            align-items: center;
        }

        nav a {
            margin-left: 20px;
            text-decoration: none;
            color: var(--negro-texto);
            font-weight: 500;
        }

        .hero {
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            height: 60vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            padding: 0 20px;
        }

        .hero h1 { font-size: 3rem; margin-bottom: 10px; }

        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
            margin: 10px;
            display: inline-block;
            transition: opacity 0.3s;
        }
        
        .btn:hover {
            opacity: 0.9;
        }

        .btn-primary { background-color: var(--naranja-tradicion); color: white; }
        .btn-secondary { background-color: var(--verde-eco); color: white; }

        /* Ajuste para botones pequeños en el nav */
        .btn-sm {
            padding: 8px 15px;
            margin: 0 0 0 10px;
            font-size: 0.9rem;
        }

        .container { padding: 50px 10%; }

        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        .feature-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            border-top: 5px solid var(--amarillo-maiz);
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            text-align: center;
        }

        .pricing-table {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .price-box {
            border: 2px solid var(--verde-eco);
            padding: 30px;
            border-radius: 15px;
            min-width: 280px;
            text-align: center;
            background-color: white;
        }

        footer {
            background-color: var(--negro-texto);
            color: white;
            text-align: center;
            padding: 40px;
            margin-top: 50px;
        }
    </style>
</head>
<body>

    <header>
        <div class="logo">EcoSazón</div>
        <nav>
            <a href="#proposito">Propósito</a>
            <a href="#planes">Planes</a>
            <a href="#partners">Cocinas</a>

            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-secondary btn-sm">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-secondary btn-sm">Iniciar Sesión</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Registrarse</a>
                    @endif
                @endauth
            @endif
        </nav>
    </header>

    <section class="hero">
        <h1>El sabor de casa, a la vuelta de un clic</h1> 
        <p>Digitalizamos el ecosistema de las cocinas económicas para conectarte con el sazón local.</p> 
        <div>
            <a href="#planes" class="btn btn-primary">Ver Menú del Día</a>
            <a href="#partners" class="btn btn-secondary">Unirse como Partner</a>
        </div>
    </section>

    <div class="container" id="proposito">
        <h2 style="text-align: center;">¿Por qué elegir EcoSazón?</h2>
        <div class="features">
            <div class="feature-card">
                <h3>Personalización</h3>
                <p>Elige medias raciones y ajusta tu pedido a tu presupuesto y dieta (vegana, picante, etc.).</p> 
            </div>
            <div class="feature-card">
                <h3>Logística Verde</h3>
                <p>Entregas mediante bicicletas o vehículos eléctricos para cuidar el medio ambiente.</p> 
            </div>
            <div class="feature-card">
                <h3>Comercio Local</h3>
                <p>Apoyamos a las cocinas de barrio con comisiones justas del 12% al 15%.</p> 
            </div>
        </div>
    </div>

    <section class="container" id="planes" style="background-color: #f2f2f2;">
        <h2 style="text-align: center;">Nuestros Planes</h2>
        <div class="pricing-table">
            <div class="price-box">
                <h3>Usuario Casual</h3>
                <p>Registro gratuito.</p> 
                <p>Paga solo el menú + envío ($15 - $30 MXN).</p> 
            </div>
            <div class="price-box" style="border-color: var(--naranja-tradicion);">
                <h3>EcoSazón Plus</h3>
                <p><strong>$99 MXN / mes</strong></p> 
                <p>Envíos gratis en pedidos cercanos y prioridad en cenas especiales.</p> 
            </div>
        </div>
    </section>

    <footer>
        <p>EcoSazón - Sabor Local a Domicilio</p>
        <p>Proyecto U1ACA1 - Negocios Electrónicos</p>
        <p>Universidad Autónoma de Yucatán | Facultad de Contaduría y Administración</p>
    </footer>

</body>
</html>