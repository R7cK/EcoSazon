@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold text-success">Gestión de Usuarios</h1>
            <p class="text-muted">Administra los accesos y roles de la plataforma.</p>
        </div>
        <a href="{{ route('admin.usuarios.create') }}" class="btn btn-success rounded-pill px-4 shadow-sm">
            <i class="fas fa-plus me-2"></i>Nuevo Usuario
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success rounded-4 border-0 shadow-sm">{{ session('success') }}</div>
    @endif

    <div class="card border-0 shadow-sm rounded-4">
        <div class="table-responsive p-3">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Usuario</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Fecha de Registro</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $user)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm bg-light rounded-circle p-2 me-2 text-center" style="width: 35px;">
                                    <i class="fas fa-user text-muted small"></i>
                                </div>
                                <span class="fw-bold">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span class="badge {{ $user->role == 'admin' ? 'bg-danger' : ($user->role == 'owner' ? 'bg-warning text-dark' : 'bg-primary') }}">
                                {{ strtoupper($user->role) }}
                            </span>
                        </td>
                        <td>{{ $user->created_at->format('d/m/Y') }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('admin.usuarios.edit', $user->id) }}" class="btn btn-sm btn-outline-primary rounded-circle" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                <form action="{{ route('admin.usuarios.destroy', $user->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este usuario?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="mt-4 d-flex justify-content-center">
        {{ $usuarios->links() }}
    </div>
</div>
@endsection