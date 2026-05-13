@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-0 py-3">
                    <h4 class="fw-bold mb-0 text-success"><i class="fas fa-user-edit me-2"></i>Editar Perfil</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.usuarios.update', $usuario->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nombre</label>
                            <input type="text" name="name" class="form-control rounded-3" value="{{ $usuario->name }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Email</label>
                            <input type="email" name="email" class="form-control rounded-3" value="{{ $usuario->email }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Rol</label>
                            <select name="role" class="form-select rounded-3">
                                <option value="user" {{ $usuario->role == 'user' ? 'selected' : '' }}>Cliente</option>
                                <option value="owner" {{ $usuario->role == 'owner' ? 'selected' : '' }}>Socio</option>
                                <option value="admin" {{ $usuario->role == 'admin' ? 'selected' : '' }}>Administrador</option>
                            </select>
                        </div>

                        <hr class="my-4">
                        <p class="text-muted small">Deja la contraseña en blanco si no deseas cambiarla.</p>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Nueva Contraseña</label>
                                <input type="password" name="password" class="form-control rounded-3">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Confirmar</label>
                                <input type="password" name="password_confirmation" class="form-control rounded-3">
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('admin.usuarios.index') }}" class="btn btn-light px-4 rounded-pill">Volver</a>
                            <button type="submit" class="btn btn-success px-4 rounded-pill shadow-sm">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection