@extends('layouts.app')

@section('content')

{{-- CONTENEDOR DE FONDO CON FILTRO OSCURO: Ocupa toda la pantalla 100vh --}}
<div class="auth-bg d-flex align-items-center" style="background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.7)), url('{{ asset('imagenes/ima.avif') }}') center/cover no-repeat; min-height: 100vh; padding: 40px 0;">
    
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card border-0 shadow-lg rounded-4 p-4">
                    
                    {{-- AÑADIMOS EL LOGO AL FORMULARIO PORQUE NO HAY NAVBAR --}}
                    <div class="text-center mb-4">
                        <img src="{{ asset('imagenes/logo1.png') }}" alt="EcoSazón Logo" style="height: 70px; margin-bottom: 10px;">
                        <h2 class="fw-bold text-success">Crea tu Cuenta</h2>
                        <p class="text-muted small">Únete a EcoSazón como Cliente o Socio de Cocina</p>
                    </div>

                    <form action="{{ route('register.post') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label small fw-bold text-secondary">Nombre</label>
                                <input type="text" name="name" id="name" class="form-control rounded-3 @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="apellido" class="form-label small fw-bold text-secondary">Apellido</label>
                                <input type="text" name="apellido" id="apellido" class="form-control rounded-3 @error('apellido') is-invalid @enderror" value="{{ old('apellido') }}" required>
                                @error('apellido')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label small fw-bold text-secondary">Correo Electrónico</label>
                            <input type="email" name="email" id="email" class="form-control rounded-3 @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="telefono" class="form-label small fw-bold text-secondary">Número Telefónico</label>
                            <input type="tel" name="telefono" id="telefono" class="form-control rounded-3 @error('telefono') is-invalid @enderror" value="{{ old('telefono') }}" required>
                            @error('telefono')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="foto" class="form-label small fw-bold text-secondary">Foto de Perfil (Opcional)</label>
                            <input type="file" name="foto" id="foto" class="form-control rounded-3 @error('foto') is-invalid @enderror" accept="image/*">
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label small fw-bold text-secondary">¿Cómo deseas unirte?</label>
                            <select name="role" id="role" class="form-select rounded-3 @error('role') is-invalid @enderror" required>
                                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Quiero ser Cliente (Descubrir y comprar)</option>
                                <option value="owner" {{ old('role') == 'owner' ? 'selected' : '' }}>Quiero ser Socio (Gestionar mi cocina)</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label small fw-bold text-secondary">Contraseña</label>
                            <div class="input-group">
                                <input type="password" name="password" id="password" class="form-control rounded-start-3 border-end-0 @error('password') is-invalid @enderror" required>
                                <button class="btn btn-outline-secondary rounded-end-3 border-start-0" type="button" onclick="togglePasswordVisibility('password', 'password-icon')">
                                    <i class="fas fa-eye text-muted" id="password-icon"></i>
                                </button>
                                @error('password')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label small fw-bold text-secondary">Confirmar Contraseña</label>
                            <div class="input-group">
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control rounded-start-3 border-end-0" required>
                                <button class="btn btn-outline-secondary rounded-end-3 border-start-0" type="button" onclick="togglePasswordVisibility('password_confirmation', 'confirm-icon')">
                                    <i class="fas fa-eye text-muted" id="confirm-icon"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="captcha" class="form-label small fw-bold text-secondary">Código de Verificación Humana</label>
                            <div class="d-flex align-items-center gap-3 mb-2">
                                <div class="bg-light px-4 py-2 border rounded-3 fw-bold text-center letter-spacing select-none" style="font-family: 'Courier New', Courier, monospace; font-size: 1.25rem;">
                                    {{ session('captcha_text') }}
                                </div>
                                <span class="text-muted small"><i class="fas fa-info-circle"></i> Escribe el código.</span>
                            </div>
                            <input type="text" name="captcha" id="captcha" class="form-control rounded-3 @error('captcha') is-invalid @enderror" placeholder="Ingresa el código" required>
                            @error('captcha')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- MODIFICACIÓN: BOTONES DE CANCELAR Y REGISTRAR EN BLOQUE --}}
                        <div class="d-flex gap-2 mt-4">
                            <a href="{{ route('home') }}" class="btn btn-outline-secondary w-50 rounded-pill py-2 shadow-sm fw-bold">
                                Cancelar
                            </a>
                            <button type="submit" class="btn btn-success w-50 rounded-pill py-2 shadow-sm fw-bold">
                                Registrarme
                            </button>
                        </div>

                    </form>

                    <div class="text-center mt-4 pt-3 border-top">
                        <p class="text-muted small mb-0">¿Ya tienes una cuenta? <a href="{{ route('login') }}" class="text-success fw-bold text-decoration-none">Inicia Sesión</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div> {{-- FIN DEL CONTENEDOR DE FONDO --}}

<style>
    .rounded-4 { border-radius: 1rem !important; }
    .select-none { user-select: none; }
    .letter-spacing { letter-spacing: 3px; }
    .input-group .form-control:focus {
        border-color: #ced4da !important;
        box-shadow: none !important;
    }
</style>

<script>
function togglePasswordVisibility(inputId, iconId) {
    const passwordInput = document.getElementById(inputId);
    const icon = document.getElementById(iconId);
    
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    } else {
        passwordInput.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }
}
</script>
@endsection