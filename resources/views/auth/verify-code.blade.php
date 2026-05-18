@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-0 shadow-sm rounded-4 p-4">
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

                    <button type="submit" class="btn btn-success w-100 rounded-pill py-2 shadow-sm fw-bold">
                        Confirmar y Activar Cuenta
                    </button>
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

<style>
    .rounded-4 { border-radius: 1rem !important; }
</style>
@endsection