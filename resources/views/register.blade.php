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

                <form action="#" method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold small">Nombre(s)</label>
                            <input type="text" class="form-control rounded-pill px-3" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold small">Nombre de Usuario</label>
                            <input type="text" class="form-control rounded-pill px-3" placeholder="@usuario" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold small">Correo Electrónico</label>
                        <input type="email" class="form-control rounded-pill px-3" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold small">Contraseña</label>
                            <input type="password" class="form-control rounded-pill px-3" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold small">Confirmar Contraseña</label>
                            <input type="password" class="form-control rounded-pill px-3" required>
                        </div>
                    </div>

                    <div class="mb-4 p-3 bg-light rounded-4 border text-center">
                        <label class="form-label d-block small fw-bold text-secondary">Código de Verificación</label>
                        <div class="d-flex justify-content-center align-items-center gap-3">
                            <div class="bg-dark text-white px-3 py-1 rounded shadow-sm" 
                                 style="font-family: 'Courier New'; letter-spacing: 5px; font-style: italic; user-select: none; background: linear-gradient(45deg, #222, #444);">
                                {{ $captcha }}
                            </div>
                            <input type="text" class="form-control form-control-sm rounded-pill text-center" style="width: 100px;" placeholder="Escribe el código" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-orange w-100 rounded-pill py-2 shadow mb-4">Registrarse</button>

                    <div class="text-center">
                        <p class="text-muted small mb-3">O regístrate con:</p>
                        <div class="d-flex justify-content-center gap-3">
                            <a href="#" class="btn btn-outline-secondary rounded-circle"><i class="fab fa-google"></i></a>
                            <a href="#" class="btn btn-outline-secondary rounded-circle"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="btn btn-outline-secondary rounded-circle"><i class="fab fa-x-twitter"></i></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection