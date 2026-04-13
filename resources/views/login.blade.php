@extends('layouts.auth') 

@section('titulopagina', 'Iniciar Sesión - EcoSazón')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card border-0 shadow-lg p-4" style="border-radius: 25px;">
            <h2 class="text-center fw-bold mb-4" style="color: var(--verde);">Acceder</h2>
            
            {{-- Formulario apuntando a la ruta POST de login --}}
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

                {{-- Llamada al componente Captcha --}}
                <x-captcha :code="$captcha" />
                <div class="mb-3">
                    <input type="text" name="captcha" class="form-control rounded-pill px-3" placeholder="Ingresa el código anterior" required>
                    @error('captcha')
                        <small class="text-danger ps-3">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success w-100 rounded-pill py-2 shadow">Entrar</button>
            </form>

            {{-- Llamada al componente de Redes Sociales --}}
            <x-social-login />

            <p class="text-center mt-4 small mb-0">¿Eres nuevo? <a href="{{ route('register') }}" class="text-success fw-bold">Regístrate</a></p>
        </div>
    </div>
</div>
@endsection