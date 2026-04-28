@extends('layouts.auth') 

@section('titulopagina', 'Iniciar Sesión - EcoSazón')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-4">
        {{-- overflow-hidden asegura que la cabecera amarilla respete los bordes redondos --}}
        <div class="card border-0 shadow-lg" style="border-radius: 25px; overflow: hidden;">
            
            {{-- Header amarillo con el logo adentro --}}
            <div class="card-header border-0 text-center py-3" style="background-color: #FFC107;">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('imagenes/logo1.png') }}" alt="EcoSazón" class="auth-logo">
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
                                X7B9A
                            </div>
                            {{-- Botón para recargar letras --}}
                            <button type="button" class="btn btn-outline-secondary btn-sm rounded-circle d-flex align-items-center justify-content-center" onclick="generarCaptcha()" style="width: 35px; height: 35px;" title="Cambiar letras">
                                <i class="fas fa-sync-alt"></i>
                            </button>
                        </div>
                        
                        <input type="text" name="captcha" class="form-control rounded-pill px-3 text-center" placeholder="Ingresa el código anterior" required>
                        @error('captcha')
                            <small class="text-danger ps-3">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success w-100 rounded-pill py-2 shadow fw-bold">Entrar</button>
                </form>

                <x-social-login />

                <p class="text-center mt-4 small mb-0">¿Eres nuevo? <a href="{{ route('register') }}" class="text-success fw-bold">Regístrate</a></p>
            </div>
        </div>
    </div>
</div>

{{-- Script para cambiar las letras aleatoriamente --}}
<script>
    function generarCaptcha() {
        const caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        let resultado = '';
        for (let i = 0; i < 5; i++) {
            resultado += caracteres.charAt(Math.floor(Math.random() * caracteres.length));
        }
        document.getElementById('captcha-texto').innerText = resultado;
    }

    // Generar el primer código en cuanto carga la página
    document.addEventListener('DOMContentLoaded', generarCaptcha);
</script>
@endsection