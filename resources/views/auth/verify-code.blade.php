@extends('layouts.app')

@section('titulopagina', 'Verificar Cuenta - EcoSazón')

@section('content')
<div class="auth-bg d-flex align-items-center" style="background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.7)), url('{{ asset('imagenes/ima.avif') }}') center/cover no-repeat; min-height: 100vh; padding: 40px 0;">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card border-0 shadow-lg" style="border-radius: 25px; overflow: hidden;">
                    
                    {{-- Header amarillo con el logo --}}
                    <div class="card-header border-0 text-center py-3" style="background-color: #FFC107;">
                        <img src="{{ asset('imagenes/logo1.png') }}" alt="EcoSazón" class="auth-logo" style="height: 70px;">
                    </div>

                    <div class="card-body p-4 bg-white">
                        <div class="text-center mb-4">
                            <div class="mb-3 text-success">
                                <i class="fas fa-envelope-open-text fa-3x"></i>
                            </div>
                            <h2 class="fw-bold text-success">Verifica tu Cuenta</h2>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4 small" role="alert">
                                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @else
                            <div class="alert alert-success rounded-3 mb-4 small">
                                <i class="fas fa-info-circle me-2"></i> Se ha enviado un correo de confirmación. Por favor, escribe el código de verificación enviado para activar tu cuenta.
                            </div>
                        @endif

                        <form action="{{ route('verify.email.post') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="code" class="form-label fw-bold text-secondary d-block text-center mb-3">Introduce tu código de 6 dígitos</label>
                                <input type="text" name="code" id="code" class="form-control form-control-lg text-center fw-bold rounded-3" placeholder="000000" maxlength="6" required style="font-size: 2.2rem; letter-spacing: 6px;">
                                @error('code')
                                    <span class="text-danger small mt-2 d-block text-center"><i class="fas fa-exclamation-circle me-1"></i> {{ $message }}</span>
                                @enderror
                            </div>

                            {{-- BOTONES DE ACCIÓN DIVIDIDOS --}}
                            <div class="d-flex gap-2">
                                <a href="{{ route('verify.email.cancel') }}" class="btn btn-outline-secondary w-50 rounded-pill py-2 shadow-sm fw-bold">
                                    Cancelar
                                </a>
                                <button type="submit" class="btn btn-success w-50 rounded-pill py-2 shadow-sm fw-bold">
                                    Activar Cuenta
                                </button>
                            </div>
                        </form>

                        <div class="mt-4 pt-3 border-top text-center">
                            <p class="text-muted small mb-2">¿No recibiste el código en tu bandeja?</p>
                            <form action="{{ route('verify.email.resend') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-link btn-sm text-success fw-bold p-0 text-decoration-none">
                                    <i class="fas fa-sync-alt me-1"></i> Reenviar código de confirmación
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection