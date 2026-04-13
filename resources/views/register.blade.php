@extends('layouts.app')

@section('titulopagina', 'Registro - EcoSazón')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-lg p-4" style="border-radius: 25px;">
                <div class="text-center mb-4">
                    <h2 class="fw-bold" style="color: var(--naranja);">Crea tu cuenta</h2>
                    <p class="text-muted small">Únete a la Logística Verde de Mérida</p>
                </div>

                <form action="{{ route('register.post') }}" method="POST">
                    @csrf
                    
                    {{-- Selección de Rol (Punto clave para la nueva funcionalidad) --}}
                    <div class="mb-4 text-center">
                        <label class="form-label fw-bold small d-block mb-3">¿Cómo usarás EcoSazón?</label>
                        <div class="d-flex justify-content-center gap-4">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="role" id="roleUser" value="user" {{ old('role', 'user') == 'user' ? 'checked' : '' }}>
                                <label class="form-check-label small fw-bold" for="roleUser">
                                    <i class="fas fa-utensils me-1 text-success"></i> Comensal
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="role" id="roleOwner" value="owner" {{ old('role') == 'owner' ? 'checked' : '' }}>
                                <label class="form-check-label small fw-bold" for="roleOwner">
                                    <i class="fas fa-store me-1 text-warning"></i> Dueño de Cocina
                                </label>
                            </div>
                        </div>
                        @error('role')
                            <small class="text-danger d-block mt-2">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="name" class="form-label fw-bold small">Nombre Completo</label>
                            <input type="text" id="name" name="name" class="form-control rounded-pill px-3" 
                                   value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <small class="text-danger ps-2">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold small">Correo Electrónico</label>
                        <input type="email" id="email" name="email" class="form-control rounded-pill px-3" 
                               value="{{ old('email') }}" required autocomplete="email" 
                               placeholder="ejemplo@correo.com">
                        @error('email')
                            <small class="text-danger ps-2">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label fw-bold small">Contraseña</label>
                            <input type="password" id="password" name="password" class="form-control rounded-pill px-3" 
                                   required minlength="8" autocomplete="new-password" 
                                   placeholder="Mínimo 8 caracteres">
                            @error('password')
                                <small class="text-danger ps-2">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="password_confirmation" class="form-label fw-bold small">Confirmar Contraseña</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" 
                                   class="form-control rounded-pill px-3" required autocomplete="new-password">
                        </div>
                    </div>

                    {{-- Sección de Captcha --}}
                    <div class="mb-4 p-3 bg-light rounded-4 border text-center">
                        <label for="captcha" class="form-label d-block small fw-bold text-secondary">Código de Verificación</label>
                        <div class="d-flex justify-content-center align-items-center gap-3">
                            <div class="bg-dark text-white px-3 py-1 rounded shadow-sm" 
                                 style="font-family: 'Courier New'; letter-spacing: 5px; font-style: italic; user-select: none; background: linear-gradient(45deg, #222, #444);">
                                {{ $captcha }}
                            </div>
                            <input type="text" id="captcha" name="captcha" 
                                   class="form-control form-control-sm rounded-pill text-center" 
                                   style="width: 110px;" placeholder="Código" required>
                        </div>
                        @error('captcha')
                            <small class="text-danger d-block mt-2">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-orange w-100 rounded-pill py-2 shadow mb-4">Registrarse</button>

                    <div class="text-center">
                        <p class="text-muted small mb-3">O regístrate con:</p>
                        <div class="d-flex justify-content-center gap-3">
                            <a href="#" class="btn btn-outline-secondary rounded-circle" title="Google"><i class="fab fa-google"></i></a>
                            <a href="#" class="btn btn-outline-secondary rounded-circle" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="btn btn-outline-secondary rounded-circle" title="Twitter/X"><i class="fab fa-x-twitter"></i></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection