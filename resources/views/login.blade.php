@extends('layouts.app')

@section('titulopagina', 'Iniciar Sesión - EcoSazón')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card border-0 shadow-lg p-4" style="border-radius: 25px;">
                <div class="text-center mb-4">
                    <h2 class="fw-bold" style="color: var(--verde);">EcoSazón</h2>
                    <p class="text-muted small">Ingresa tus credenciales</p>
                </div>

                <form action="#" method="POST">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Usuario o Correo</label>
                        <input type="text" class="form-control rounded-pill px-3" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Contraseña</label>
                        <input type="password" class="form-control rounded-pill px-3" required>
                    </div>

                    <div class="mb-4 p-3 bg-light rounded-4 border text-center">
                        <div class="d-flex justify-content-center align-items-center gap-2">
                            <span class="badge bg-secondary p-2 shadow-sm" style="font-size: 1.1rem; font-family: serif; letter-spacing: 3px;">{{ $captcha }}</span>
                            <input type="text" class="form-control form-control-sm rounded-pill" placeholder="Captcha" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-green w-100 rounded-pill py-2 shadow mb-3">Entrar</button>
                    
                    <div class="text-center">
                        <p class="small text-muted mb-0">¿Nuevo en Mérida? <a href="{{ route('register') }}" class="text-success fw-bold text-decoration-none">Crea una cuenta</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection