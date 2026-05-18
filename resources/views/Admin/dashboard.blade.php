@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="fw-bold" style="color: #198754;">Panel de Administración</h1>
            <p class="text-muted">Bienvenido al centro de control de EcoSazón.</p>
        </div>
    </div>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4 mb-4 shadow-sm" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Tarjetas de Estadísticas --}}
    <div class="row g-3 mb-5">
        <div class="col-md-3">
            {{-- Envolvemos la tarjeta en un enlace --}}
            <a href="{{ route('admin.usuarios.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm rounded-4 p-3 card-hover" style="border-left: 5px solid #FFC107 !important;">
                    <div class="d-flex align-items-center">
                        <div class="bg-light-warning rounded-circle p-3 me-3">
                            <i class="fas fa-users fa-2x text-warning"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Usuarios</h6>
                            <h3 class="fw-bold mb-0 text-dark">{{ $totalUsuarios }}</h3>
                        </div>
                    </div>
                </div>
            </a>
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
                
                {{-- Modificado: Encabezado con Buscador Integrado --}}
                <div class="card-header bg-white border-0 py-3 d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <h5 class="mb-0 fw-bold">Cocinas Registradas</h5>
                    
                    <div class="d-flex align-items-center gap-2 flex-grow-1 justify-content-md-end">
                        <div class="input-group input-group-sm" style="max-width: 250px;">
                            <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-search"></i></span>
                            <input type="text" id="buscador-cocinas" class="form-control border-start-0 bg-light shadow-none" placeholder="Buscar cocina o zona...">
                        </div>
                        <a href="{{ route('admin.cocinas.index') }}" class="btn btn-sm btn-outline-success rounded-pill px-3">Ver todas</a>
                    </div>
                </div>

                <div class="table-responsive p-3 pt-0">
                    {{-- Modificado: Agregamos el id="tabla-cocinas" para que el JS lo encuentre --}}
                    <table class="table table-hover align-middle" id="tabla-cocinas">
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
                                <td><span class="badge bg-light text-dark border">{{ $cocina->zona }}</span></td>
                                <td>
                                    <form action="{{ route('admin.cocinas.toggleStatus', $cocina->id) }}" method="POST" class="m-0" onsubmit="return confirm('¿Cambiar el estatus de esta cocina?');">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm border-0 bg-transparent p-0" title="Haz clic para cambiar el estatus">
                                            @if($cocina->estatus === 'activa' || $cocina->estatus === 'activo')
                                                <span class="badge bg-success"><i class="fas fa-check-circle me-1"></i>Activa</span>
                                            @else
                                                <span class="badge bg-secondary"><i class="fas fa-ban me-1"></i>Inactiva</span>
                                            @endif
                                        </button>
                                    </form>
                                </td>
                                
                                <td>
                                    {{-- Botón para editar --}}
                                    <a href="{{ route('admin.cocinas.edit', $cocina->id) }}" class="btn btn-sm btn-light text-primary" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    {{-- Formulario para eliminar con confirmación --}}
                                    <form action="{{ route('admin.cocinas.destroy', $cocina->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta cocina de forma permanente?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-light text-danger" title="Eliminar">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            
                            {{-- Fila de mensaje de "No encontrado" (oculta por defecto) --}}
                            <tr id="sin-resultados-cocinas" style="display: none;">
                                <td colspan="5" class="text-center py-4 text-muted">
                                    <i class="fas fa-search-minus fs-4 mb-2 d-block"></i>
                                    No se encontraron cocinas que coincidan con tu búsqueda.
                                </td>
                            </tr>
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
                <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">Nuevos Usuarios</h5>
                    <a href="{{ route('admin.usuarios.index') }}" class="btn btn-sm btn-outline-warning rounded-pill text-dark px-3">Gestionar</a>
                </div>
                <div class="card-body">
                    @foreach($usuariosRecientes as $u)
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar-sm bg-light rounded-circle p-2 me-3 text-center" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-user text-muted"></i>
                        </div>
                        <div>
                            <p class="mb-0 fw-bold small">{{ $u->name }}</p>
                            <p class="mb-0 text-muted extra-small">{{ $u->email }}</p>
                        </div>
                        <span class="ms-auto badge {{ $u->role == 'owner' ? 'bg-warning text-dark' : 'bg-light text-dark border' }} small">
                            {{ $u->role }}
                        </span>
                    </div>
                    @endforeach
                    
                </div>
            </div>
        </div>
    </div>
</div>

{{-- SCRIPT PARA EL BUSCADOR EN TIEMPO REAL --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const buscador = document.getElementById('buscador-cocinas');
    const filas = document.querySelectorAll('#tabla-cocinas tbody tr:not(#sin-resultados-cocinas)');
    const mensajeVacio = document.getElementById('sin-resultados-cocinas');

    if(buscador) {
        buscador.addEventListener('input', function() {
            // Normalizamos el texto (quitamos acentos y pasamos a minúsculas)
            const texto = this.value.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "");
            let coincidencias = 0;

            filas.forEach(fila => {
                // Obtenemos todo el texto de la fila (Nombre, Dueño, Zona)
                const contenidoFila = fila.textContent.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "");
                
                if(contenidoFila.includes(texto)) {
                    fila.style.display = '';
                    coincidencias++;
                } else {
                    fila.style.display = 'none';
                }
            });

            // Mostramos el mensaje de "No encontrado" si no hay coincidencias
            if(coincidencias === 0) {
                mensajeVacio.style.display = '';
            } else {
                mensajeVacio.style.display = 'none';
            }
        });
    }
});
</script>

<style>
    .extra-small { font-size: 0.75rem; }
    .bg-light-success { background-color: #e8f5e9; }
    .bg-light-warning { background-color: #fff8e1; }
    .bg-light-info { background-color: #e0f7fa; }
    .rounded-4 { border-radius: 1rem !important; }
    .card-hover { transition: transform 0.2s ease, box-shadow 0.2s ease; }
    .card-hover:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important; cursor: pointer; }
</style>
@endsection