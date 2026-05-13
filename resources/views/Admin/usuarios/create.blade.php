@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-0 py-3">
                    <h4 class="fw-bold mb-0 text-success"><i class="fas fa-user-plus me-2"></i>Nuevo Usuario</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.usuarios.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nombre Completo</label>
                            <input type="text" name="name" class="form-control rounded-3" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Correo Electrónico</label>
                            <input type="email" name="email" class="form-control rounded-3" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Rol en la Plataforma</label>
                            <select name="role" class="form-select rounded-3">
                                <option value="user">Cliente (User)</option>
                                <option value="owner">Socio (Owner)</option>
                                <option value="admin">Administrador (Admin)</option>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Contraseña</label>
                                <input type="password" name="password" class="form-control rounded-3" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Confirmar</label>
                                <input type="password" name="password_confirmation" class="form-control rounded-3" required>
                            </div>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-success py-2 rounded-pill shadow-sm">Crear Usuario</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection