@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold text-success">Gestión de Cocinas</h1>
            <p class="text-muted">Administra todas las cocinas registradas en la plataforma.</p>
        </div>
        <a href="{{ route('admin.cocinas.create') }}" class="btn btn-success rounded-pill px-4 shadow-sm">
            <i class="fas fa-plus me-2"></i>Nueva Cocina
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4 mb-4" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4">
        <div class="table-responsive p-3">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nombre</th>
                        <th>Dueño</th>
                        <th>Zona</th>
                        <th>Categoría</th>
                        <th>Estatus</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($cocinas as $cocina)
                    <tr>
                        <td class="fw-bold">{{ $cocina->nombre }}</td>
                        <td>
                            @if($cocina->user)
                                <span class="d-block small fw-bold">{{ $cocina->user->name }}</span>
                                <span class="text-muted extra-small">{{ $cocina->user->email }}</span>
                            @else
                                <span class="text-danger small">Sin dueño</span>
                            @endif
                        </td>
                        <td><span class="badge bg-light text-dark border">{{ $cocina->zona }}</span></td>
                        <td>{{ $cocina->categoria ?? 'N/A' }}</td>
                        <td><span class="badge bg-success">Activa</span></td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('admin.cocinas.edit', $cocina->id) }}" class="btn btn-sm btn-outline-primary rounded-circle" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                <form action="{{ route('admin.cocinas.destroy', $cocina->id) }}" method="POST" onsubmit="return confirm('¿Eliminar definitivamente esta cocina?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">No hay cocinas registradas actualmente.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Enlaces de paginación --}}
    <div class="mt-4 d-flex justify-content-center">
        {{ $cocinas->links() }}
    </div>
</div>

<style>
    .extra-small { font-size: 0.75rem; }
    .rounded-4 { border-radius: 1rem !important; }
</style>
@endsection