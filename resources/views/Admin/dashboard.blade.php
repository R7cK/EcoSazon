@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="fw-bold" style="color: #198754;">Panel de Administración</h1>
            <p class="text-muted">Bienvenido al centro de control de EcoSazón.</p>
        </div>
    </div>

    {{-- Tarjetas de Estadísticas --}}
    <div class="row g-3 mb-5">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3" style="border-left: 5px solid #FFC107 !important;">
                <div class="d-flex align-items-center">
                    <div class="bg-light-warning rounded-circle p-3 me-3">
                        <i class="fas fa-users fa-2x text-warning"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 text-muted">Usuarios</h6>
                        <h3 class="fw-bold mb-0">{{ $totalUsuarios }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3" style="border-left: 5px solid #198754 !important;">
                <div class="d-flex align-items-center">
                    <div class="bg-light-success rounded-circle p-3 me-3">
                        <i class="fas fa-store fa-2x text-success"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 text-muted">Cocinas</h6>
                        <h3 class="fw-bold mb-0">{{ $totalCocinas }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3" style="border-left: 5px solid #0dcaf0 !important;">
                <div class="d-flex align-items-center">
                    <div class="bg-light-info rounded-circle p-3 me-3">
                        <i class="fas fa-comment-alt fa-2x text-info"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 text-muted">Comentarios</h6>
                        <h3 class="fw-bold mb-0">{{ $totalComentarios }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        {{-- Gestión de Cocinas --}}
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">Cocinas Registradas</h5>
                    <a href="#" class="btn btn-sm btn-outline-success rounded-pill">Ver todas</a>
                </div>
                <div class="table-responsive p-3">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Nombre</th>
                                <th>Dueño</th>
                                <th>Zona</th>
                                <th>Estatus</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cocinas as $cocina)
                            <tr>
                                <td class="fw-bold">{{ $cocina->nombre }}</td>
                                <td>{{ $cocina->user->name ?? 'Sin dueño' }}</td>
                                <td><span class="badge bg-light text-dark">{{ $cocina->zona }}</span></td>
                                <td><span class="badge bg-success">Activa</span></td>
                                
                                <td>
                                    <button class="btn btn-sm btn-light text-primary"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-light text-danger"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-white border-0 py-3 d-flex justify-content-center">
                    {{ $cocinas->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>

        {{-- Usuarios Recientes --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-bold">Nuevos Usuarios</h5>
                </div>
                <div class="card-body">
                    @foreach($usuariosRecientes as $u)
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar-sm bg-light rounded-circle p-2 me-3 text-center" style="width: 40px;">
                            <i class="fas fa-user text-muted"></i>
                        </div>
                        <div>
                            <p class="mb-0 fw-bold small">{{ $u->name }}</p>
                            <p class="mb-0 text-muted extra-small">{{ $u->email }}</p>
                        </div>
                        <span class="ms-auto badge {{ $u->role == 'owner' ? 'bg-warning text-dark' : 'bg-light text-dark' }} small">
                            {{ $u->role }}
                        </span>
                    </div>
                    @endforeach
                    
                </div>
            </div>
        </div>
    </div>
</div>


<style>
    .extra-small { font-size: 0.75rem; }
    .bg-light-success { background-color: #e8f5e9; }
    .bg-light-warning { background-color: #fff8e1; }
    .bg-light-info { background-color: #e0f7fa; }
    .rounded-4 { border-radius: 1rem !important; }
</style>
@endsection