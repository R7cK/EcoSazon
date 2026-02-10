<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>EcoSazón - Sabor Local de Mérida</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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
            font-family: 'Instrument Sans', sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--blanco-crema);
            color: var(--negro-texto);
            overflow-x: hidden;
        }

        /* --- Header --- */
        header {
            background-color: white;
            padding: 1rem 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo {
            font-weight: 700;
            font-size: 1.8rem;
            color: var(--verde-eco);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .logo i { color: var(--naranja-tradicion); }

        nav { display: flex; align-items: center; gap: 20px; }
        
        nav a {
            text-decoration: none;
            color: var(--negro-texto);
            font-weight: 500;
            transition: color 0.3s;
        }
        nav a:hover { color: var(--naranja-tradicion); }

        /* --- Botones --- */
        .btn {
            padding: 10px 25px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-weight: 600;
            text-decoration: none;
            transition: transform 0.2s, box-shadow 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.15); }

        .btn-primary { background-color: var(--naranja-tradicion); color: white; }
        .btn-secondary { background-color: var(--verde-eco); color: white; }
        .btn-outline { border: 2px solid var(--verde-eco); color: var(--verde-eco); background: transparent; }
        .btn-outline:hover { background-color: var(--verde-eco); color: white; }

        /* --- Hero Section --- */
        .hero {
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1605490483868-e4b2a59a7f3f?q=80&w=1470&auto=format&fit=crop'); 
            background-size: cover;
            background-position: center;
            height: 85vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            padding: 0 20px;
        }

        .hero h1 { font-size: 3.5rem; margin-bottom: 15px; line-height: 1.2; }
        .hero p { font-size: 1.2rem; max-width: 700px; margin-bottom: 30px; }
        
        .hero-buttons { display: flex; gap: 20px; flex-wrap: wrap; justify-content: center; }

        /* --- App Interface Mockups --- */
        .app-preview-section {
            padding: 80px 10%;
            background-color: white;
            text-align: center;
        }

        .mockup-container {
            display: flex;
            justify-content: center;
            gap: 40px;
            margin-top: 50px;
            flex-wrap: wrap;
        }

        .phone-mockup {
            width: 280px;
            height: 500px;
            background-color: #f8f9fa;
            border: 12px solid #333;
            border-radius: 40px;
            overflow: hidden;
            position: relative;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
            display: flex;
            flex-direction: column;
        }

        .phone-header { background: var(--verde-eco); height: 50px; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; }
        .phone-body { padding: 15px; flex: 1; display: flex; flex-direction: column; gap: 10px; text-align: left; }
        
        .ui-card { background: white; padding: 10px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); font-size: 0.8rem; }
        .ui-card h4 { margin: 0 0 5px 0; color: var(--naranja-tradicion); }
        .ui-card-row { display: flex; justify-content: space-between; align-items: center; margin-top: 5px; }
        .ui-badge { background: var(--amarillo-maiz); padding: 2px 8px; border-radius: 10px; font-size: 0.6rem; font-weight: bold; }
        .ui-btn-small { background: var(--verde-eco); color: white; border: none; padding: 5px 10px; border-radius: 5px; width: 100%; margin-top: 10px; cursor: pointer; }

        /* --- Features Grid --- */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            padding: 80px 10%;
            background-color: var(--blanco-crema);
        }

        .feature-item {
            background: white;
            padding: 30px;
            border-radius: 20px;
            text-align: center;
            transition: transform 0.3s;
            border-bottom: 4px solid var(--naranja-tradicion);
        }
        .feature-item:hover { transform: translateY(-10px); }
        .feature-icon { font-size: 3rem; color: var(--naranja-tradicion); margin-bottom: 20px; }

        /* --- Pricing Plans --- */
        .pricing-section { padding: 80px 10%; text-align: center; }
        .pricing-container { display: flex; justify-content: center; gap: 30px; margin-top: 40px; flex-wrap: wrap; }
        
        .plan-card {
            background: white;
            padding: 40px;
            border-radius: 20px;
            width: 300px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            position: relative;
            border: 2px solid transparent;
        }

        .plan-premium { border-color: var(--naranja-tradicion); transform: scale(1.05); }
        .plan-tag {
            background: var(--naranja-tradicion); color: white;
            position: absolute; top: -15px; left: 50%; transform: translateX(-50%);
            padding: 5px 15px; border-radius: 20px; font-weight: bold; font-size: 0.9rem;
        }

        .price { font-size: 2.5rem; font-weight: bold; color: var(--negro-texto); margin: 20px 0; }
        .price span { font-size: 1rem; color: #7f8c8d; font-weight: normal; }
        
        /* --- Footer --- */
        footer { background-color: #1a252f; color: white; text-align: center; padding: 50px 20px; }
        .footer-logos { display: flex; justify-content: center; gap: 20px; margin-bottom: 20px; opacity: 0.7; }
        
        @media (max-width: 768px) {
            .hero h1 { font-size: 2.5rem; }
            .partners-section { flex-direction: column; }
        }
    </style>
</head>
<body>

    <header>
        <div class="logo">
            <i class="fas fa-utensils"></i> EcoSazón
        </div>
        <nav class="hidden md:flex">
            <a href="#proposito">Propósito</a>
            <a href="#como-funciona">App</a>
            <a href="#planes">Planes</a>
            <a href="#cocinas">Soy Cocina</a>
        </nav>
        <div>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-primary">Mi Cuenta</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline" style="margin-right: 10px;">Entrar</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-primary">Registro</a>
                    @endif
                @endauth
            @endif
        </div>
    </header>

    <section class="hero">
        <h1>El sabor de casa,<br>a la vuelta de un clic.</h1>
        <p>Conectamos las <strong>cocinas económicas de Mérida</strong> con tu oficina u hogar. Pide medias raciones, ahorra y apoya el comercio local con envíos ecológicos.</p>
        
        <div class="hero-buttons">
            <a href="#planes" class="btn btn-primary"><i class="fas fa-shopping-basket"></i> Ver Menú del Día</a>
            <a href="#cocinas" class="btn btn-secondary"><i class="fas fa-store"></i> Unirse como Cocina</a>
        </div>
    </section>

    <section id="como-funciona" class="app-preview-section">
        <h2 style="color: var(--naranja-tradicion); font-size: 2.5rem;">Digitalizamos el Sazón Local</h2>
        <p>Una experiencia diseñada para tu presupuesto y el medio ambiente.</p>

        <div class="mockup-container">
            <div class="phone-mockup">
                <div class="phone-header">Menú del Día</div>
                <div class="phone-body">
                    <div class="ui-card">
                        <h4>Cocina "Doña Mary"</h4>
                        <p style="font-size: 0.75rem; color: #666;">Col. Francisco de Montejo</p>
                        <div style="margin-top: 10px; font-weight: bold;">Pochuc con arroz</div>
                        <div class="ui-card-row">
                            <span>$80.00</span>
                            <span class="ui-badge" style="background: #e0e0e0;">Entera</span>
                        </div>
                        <div class="ui-card-row" style="background: #fff3cd; padding: 5px; border-radius: 5px; margin-top: 5px;">
                            <span style="font-size: 0.7rem; color: var(--naranja-tradicion);"><i class="fas fa-leaf"></i> Opción Eco</span>
                            <span style="font-weight: bold;">$48.00 (Media)</span>
                        </div>
                        <button class="ui-btn-small">Agregar</button>
                    </div>
                </div>
            </div>

            <div class="phone-mockup">
                <div class="phone-header" style="background-color: var(--naranja-tradicion);">Tu Envío</div>
                <div class="phone-body">
                    <div style="text-align: center; padding: 20px 0;">
                        <i class="fas fa-bicycle" style="font-size: 4rem; color: var(--verde-eco);"></i>
                        <h3 style="margin: 10px 0;">En camino</h3>
                        <p style="font-size: 0.8rem;">Tu repartidor viaja en vehículo eléctrico (Skutter).</p>
                    </div>
                    <div class="ui-card">
                        <div class="ui-card-row">
                            <span>Costo de envío</span>
                            <span style="color: var(--verde-eco); font-weight: bold;">$15.00 MXN</span>
                        </div>
                        <p style="font-size: 0.65rem; color: #999; margin-top:5px;">Tarifa optimizada por distancia corta.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="features-grid" id="proposito">
        <div class="feature-item">
            <div class="feature-icon"><i class="fas fa-utensils"></i></div>
            <h3>Personalización</h3>
            <p>Elige medias raciones (60% del costo) o dietas especiales (vegana, sin picante).</p>
        </div>
        <div class="feature-item">
            <div class="feature-icon"><i class="fas fa-leaf"></i></div>
            <h3>Logística Verde</h3>
            <p>Entregas ecológicas mediante bicicletas y vehículos eléctricos.</p>
        </div>
        <div class="feature-item">
            <div class="feature-icon"><i class="fas fa-hand-holding-dollar"></i></div>
            <h3>Precios Justos</h3>
            <p>Apoyamos a las cocinas de barrio con comisiones bajas (12%-15%).</p>
        </div>
    </div>

    <section id="planes" class="pricing-section">
        <h2>Elige cómo quieres comer</h2>
        <div class="pricing-container">
            <div class="plan-card">
                <h3>Usuario Casual</h3>
                <div class="price">$0 <span>/ mes</span></div>
                <p>Paga solo el menú + envío.</p>
                <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">
                <ul style="text-align: left; list-style: none; padding: 0; line-height: 2;">
                    <li><i class="fas fa-check" style="color: var(--verde-eco);"></i> Acceso a todas las cocinas</li>
                    <li><i class="fas fa-check" style="color: var(--verde-eco);"></i> Opción de Medias Raciones</li>
                    <li><i class="fas fa-info-circle" style="color: #95a5a6;"></i> Envío estándar ($15 - $30)</li>
                </ul>
                <a href="{{ route('register') }}" class="btn btn-outline" style="width: 100%; justify-content: center; margin-top: 20px;">Registrarse Gratis</a>
            </div>

            <div class="plan-card plan-premium">
                <div class="plan-tag">POPULAR</div>
                <h3>EcoSazón Plus</h3>
                <div class="price">$99 <span>/ mes</span></div>
                <p>Para los amantes del sabor diario.</p>
                <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">
                <ul style="text-align: left; list-style: none; padding: 0; line-height: 2;">
                    <li><i class="fas fa-check" style="color: var(--naranja-tradicion);"></i> <strong>Envíos GRATIS</strong> cercanos</li>
                    <li><i class="fas fa-check" style="color: var(--naranja-tradicion);"></i> Prioridad en pedidos</li>
                    <li style="background-color: #fff3cd; padding: 0 5px; border-radius: 5px;"><i class="fas fa-star" style="color: var(--naranja-tradicion);"></i> Prioridad en Pib y Navidad</li>
                </ul>
                <a href="{{ route('register') }}?plan=plus" class="btn btn-primary" style="width: 100%; justify-content: center; margin-top: 20px;">Suscribirse</a>
            </div>
        </div>
    </section>

    <section id="cocinas" style="background-color: var(--negro-texto); color: white; padding: 80px 10%; text-align: center;">
        <h2 style="color: var(--amarillo-maiz);">¿Tienes una Cocina Económica?</h2>
        <p style="max-width: 600px; margin: 20px auto;">Digitaliza tu negocio sin complicaciones. Sin flota propia y con comisiones justas.</p>
        <a href="{{ route('register') }}?role=partner" class="btn btn-primary">Registrar mi Cocina</a>
    </section>

    <footer>
        <p><strong>EcoSazón - Sabor Local a Domicilio</strong></p>
        <p style="font-size: 0.9rem; color: #bdc3c7;">Proyecto U1ACA1 - Negocios Electrónicos</p>
        <p style="font-size: 0.9rem; color: #bdc3c7;">Universidad Autónoma de Yucatán | Facultad de Contaduría y Administración</p>
        <p style="font-size: 0.8rem; margin-top: 20px; color: #7f8c8d;">Hecho en Mérida, Yucatán.</p>
    </footer>

</body>
</html>