@extends('layouts.app')

@section('titulopagina', 'Panel de Socio - ' . $cocina->nombre)

@section('content')
<div class="container my-5">
    {{-- Encabezado de Bienvenida --}}
    <div class="row mb-4 align-items-center">
        <div class="col-md-8">
            <h1 class="fw-bold" style="color: var(--verde-oscuro);">Panel de Gestión</h1>
            <p class="text-muted">Administra el menú y la información de <strong>{{ $cocina->nombre }}</strong></p>
        </div>
        <div class="col-md-4 text-md-end">
            <span class="badge {{ $cocina->estado == 'abierto' ? 'bg-success' : 'bg-danger' }} rounded-pill p-2 px-3">
                Estado: {{ ucfirst($cocina->estado ?? 'Activo') }}
            </span>
        </div>
    </div>

    {{-- Tarjetas de Estadísticas --}}
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-3 border-start border-success border-5">
                <div class="d-flex align-items-center">
                    <div class="icon-box bg-light-success p-3 rounded-circle me-3">
                        <i class="fas fa-utensils text-success fs-3"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-0 small">Platos en Menú</h6>
                        <h3 class="fw-bold mb-0">{{ $platos->count() }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-3 border-start border-warning border-5">
                <div class="d-flex align-items-center">
                    <div class="icon-box bg-light-warning p-3 rounded-circle me-3">
                        <i class="fas fa-star text-warning fs-3"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-0 small">Calificación Media</h6>
                        <h3 class="fw-bold mb-0">
                            {{ number_format($cocina->comentarios->avg('calificacion'), 1) }} / 5
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-3 border-start border-primary border-5">
                <div class="d-flex align-items-center">
                    <div class="icon-box bg-light-primary p-3 rounded-circle me-3">
                        <i class="fas fa-comment text-primary fs-3"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-0 small">Opiniones Totales</h6>
                        <h3 class="fw-bold mb-0">{{ $cocina->comentarios->count() }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        {{-- Gestión de Platos --}}
        <div class="col-lg-8 mb-4">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-white border-0 p-4 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0"><i class="fas fa-list me-2"></i>Mis Platos</h5>
                    <button class="btn btn-green btn-sm rounded-pill px-3 shadow-sm">
                        <i class="fas fa-plus me-1"></i> Nuevo Plato
                    </button>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light text-muted small uppercase">
                                <tr>
                                    <th class="ps-4">Plato</th>
                                    <th>Categoría</th>
                                    <th>Precio</th>
                                    <th class="text-end pe-4">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($platos as $plato)
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-3 bg-light me-3" style="width: 45px; height: 45px;"></div>
                                            <span class="fw-bold">{{ $plato->nombre }}</span>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-light text-dark rounded-pill border">{{ $plato->categoria ?? 'General' }}</span></td>
                                    <td class="fw-bold text-success">${{ number_format($plato->precio, 2) }}</td>
                                    <td class="text-end pe-4">
                                        <button class="btn btn-sm btn-outline-secondary rounded-circle me-1"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-sm btn-outline-danger rounded-circle"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5 text-muted">
                                        No has registrado platos todavía.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Comentarios Recientes --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-0 p-4">
                    <h5 class="fw-bold mb-0"><i class="fas fa-star me-2 text-warning"></i>Últimas Opiniones</h5>
                </div>
                <div class="card-body p-4 pt-0">
                    @forelse($comentarios as $comentario)
                        <div class="mb-4 border-bottom pb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <span class="fw-bold small">{{ $comentario->user->name }}</span>
                                <span class="text-warning small">{{ str_repeat('⭐', $comentario->calificacion) }}</span>
                            </div>
                            <p class="small text-muted mb-1">"{{ Str::limit($comentario->contenido, 80) }}"</p>
                            <small class="text-secondary" style="font-size: 0.75rem;">{{ $comentario->created_at->diffForHumans() }}</small>
                        </div>
                    @empty
                        <p class="text-center text-muted small py-4">Sin opiniones recientes.</p>
                    @endforelse
                    <div class="text-center">
                        <a href="#" class="text-success fw-bold small text-decoration-none">Ver todos los comentarios</a>
                    </div>
                </div>
            </div>

            {{-- Configuración de la Cocina --}}
            <div class="card border-0 shadow-sm rounded-4 mt-4 bg-dark text-white p-4">
                <h6 class="fw-bold mb-3">Ajustes Rápidos</h6>
                <div class="d-grid gap-2">
                    <button class="btn btn-outline-light btn-sm rounded-pill text-start"><i class="fas fa-clock me-2"></i> Cambiar Horario</button>
                    <button class="btn btn-outline-light btn-sm rounded-pill text-start"><i class="fas fa-map-marker-alt me-2"></i> Editar Ubicación</button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-light-success { background-color: #e8f5e9; }
    .bg-light-warning { background-color: #fff8e1; }
    .bg-light-primary { background-color: #e3f2fd; }
</style>
@endsection