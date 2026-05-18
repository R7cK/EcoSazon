@extends('layouts.app') 

@section('titulopagina', 'Iniciar Sesión - EcoSazón')

@section('content')

{{-- CONTENEDOR DE FONDO CON FILTRO OSCURO: Ocupa toda la pantalla 100vh --}}
<div class="auth-bg d-flex align-items-center" style="background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.7)), url('{{ asset('imagenes/ima.avif') }}') center/cover no-repeat; min-height: 100vh; padding: 40px 0;">

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">
                {{-- overflow-hidden asegura que la cabecera amarilla respete los bordes redondos --}}
                <div class="card border-0 shadow-lg" style="border-radius: 25px; overflow: hidden;">
                    
                    {{-- Header amarillo con el logo adentro --}}
                    <div class="card-header border-0 text-center py-3" style="background-color: #FFC107;">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('imagenes/logo1.png') }}" alt="EcoSazón" class="auth-logo" style="height: 70px;">
                        </a>
                    </div>

                    <div class="card-body p-4 bg-white">
                        <h2 class="text-center fw-bold mb-4" style="color: var(--verde, #198754);">Acceder</h2>
                        
                        <form action="{{ route('login.post') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <input type="email" name="email" class="form-control rounded-pill px-3" placeholder="Correo Electrónico" value="{{ old('email') }}" required>
                                @error('email')
                                    <small class="text-danger ps-3">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <input type="password" name="password" class="form-control rounded-pill px-3" placeholder="Contraseña" required>
                            </div>

                            {{-- Nueva Verificación de Seguridad Dinámica --}}
                            <div class="mb-4 bg-light rounded-4 p-3 border">
                                <label class="form-label text-muted small fw-bold text-center w-100 mb-2">Verificación de Seguridad</label>
                                
                                <div class="d-flex justify-content-center align-items-center mb-3">
                                    {{-- Caja de las letras --}}
                                    <div id="captcha-texto" class="bg-dark text-white rounded px-3 py-2 fw-bold text-decoration-line-through me-2 shadow-sm" style="letter-spacing: 5px; font-family: monospace; font-size: 1.1rem; user-select: none;">
                                        {{-- Aquí imprimimos la variable de PHP para que coincida con la validación del backend --}}
                                        {{ session('captcha_text', 'X7B9A') }}
                                    </div>
                                    {{-- Botón para recargar la página y obtener un nuevo código --}}
                                    <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-sm rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;" title="Cambiar letras">
                                        <i class="fas fa-sync-alt"></i>
                                    </a>
                                </div>
                                
                                <input type="text" name="captcha" class="form-control rounded-pill px-3 text-center" placeholder="Ingresa el código anterior" required>
                                @error('captcha')
                                    <small class="text-danger ps-3">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Botones de acción --}}
                            <div class="d-flex gap-2 mt-4">
                                <a href="{{ route('home') }}" class="btn btn-outline-secondary w-50 rounded-pill py-2 shadow-sm fw-bold">
                                    Cancelar
                                </a>
                                <button type="submit" class="btn btn-success w-50 rounded-pill py-2 shadow-sm fw-bold">
                                    Entrar
                                </button>
                            </div>
                        </form>

                        @if(isset($component))
                            <x-social-login />
                        @endif

                        <div class="text-center mt-4 pt-3 border-top">
                            <p class="text-center mt-3 small mb-0">¿Eres nuevo? <a href="{{ route('register') }}" class="text-success fw-bold text-decoration-none">Regístrate</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div> {{-- FIN DEL CONTENEDOR DE FONDO --}}
@endsection