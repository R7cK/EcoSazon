@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div>
            {{-- Ícono agregado al título --}}
            <h1 class="fw-bold text-success"><i class="fas fa-store-alt me-2"></i>Gestión de Cocinas</h1>
            <p class="text-muted">Administra todas las cocinas registradas en la plataforma.</p>
        </div>
        <div class="d-flex gap-2">
            {{-- Botón de Regresar --}}
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary rounded-pill px-4 shadow-sm">
                <i class="fas fa-arrow-left me-2"></i>Regresar
            </a>
            <a href="{{ route('admin.cocinas.create') }}" class="btn btn-success rounded-pill px-4 shadow-sm">
                <i class="fas fa-plus me-2"></i>Nueva Cocina
            </a>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        {{-- NUEVO: Barra de Búsqueda --}}
        <div class="card-header bg-white border-0 pt-4 pb-0 px-4 d-flex justify-content-end">
            <div class="input-group input-group-sm" style="max-width: 350px;">
                <span class="input-group-text bg-light border-end-0 text-muted rounded-start-pill ps-3">
                    <i class="fas fa-search"></i>
                </span>
                <input type="text" id="buscador-gestion-cocinas" class="form-control border-start-0 bg-light shadow-none rounded-end-pill py-2" placeholder="Buscar por nombre, dueño, zona o categoría...">
            </div>
        </div>

        <div class="table-responsive p-3">
            {{-- Añadimos ID a la tabla para el script --}}
            <table class="table table-hover align-middle" id="tabla-gestion-cocinas">
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
                                    <span class="d-block small fw-bold"><i class="fas fa-key text-warning me-1"></i> {{ $cocina->user->name }}</span>
                                    <span class="text-muted extra-small ms-3">{{ $cocina->user->email }}</span>
                                @else
                                    <span class="text-danger small"><i class="fas fa-exclamation-triangle me-1"></i> Sin dueño</span>
                                @endif
                            </td>
                        <td><span class="badge bg-light text-dark border">{{ $cocina->zona }}</span></td>
                        <td>{{ $cocina->categoria ?? 'N/A' }}</td>
                        <td>
                            @if($cocina->estatus === 'activa')
                                <span class="badge bg-success">Activa</span>
                            @else
                                <span class="badge bg-secondary">Inactiva</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                
                                {{-- Botón para alternar Estatus (Activar/Desactivar) --}}
                                <form action="{{ route('admin.cocinas.toggleStatus', $cocina->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm {{ $cocina->estatus === 'activa' ? 'btn-outline-warning' : 'btn-outline-success' }} rounded-circle" title="{{ $cocina->estatus === 'activa' ? 'Desactivar' : 'Activar' }}">
                                        <i class="fas {{ $cocina->estatus === 'activa' ? 'fa-ban' : 'fa-check' }}"></i>
                                    </button>
                                </form>

                                {{-- Botón de Editar --}}
                                <a href="{{ route('admin.cocinas.edit', $cocina->id) }}" class="btn btn-sm btn-outline-primary rounded-circle" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                {{-- Botón de Eliminar --}}
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
                    <tr class="fila-vacia-db">
                        <td colspan="6" class="text-center py-4 text-muted">No hay cocinas registradas actualmente.</td>
                    </tr>
                    @endforelse
                    
                    {{-- Fila oculta para cuando la búsqueda no da resultados --}}
                    <tr id="sin-resultados-gestion" style="display: none;">
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="fas fa-search-minus fs-3 mb-3 d-block text-secondary"></i>
                            No se encontraron cocinas que coincidan con tu búsqueda.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Enlaces de paginación --}}
    <div class="mt-4 d-flex justify-content-center">
        {{ $cocinas->links() }}
    </div>
</div>

{{-- SCRIPT PARA EL BUSCADOR --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const buscador = document.getElementById('buscador-gestion-cocinas');
    // Seleccionamos todas las filas excepto la del mensaje sin resultados y la de DB vacía
    const filas = document.querySelectorAll('#tabla-gestion-cocinas tbody tr:not(#sin-resultados-gestion):not(.fila-vacia-db)');
    const mensajeVacio = document.getElementById('sin-resultados-gestion');

    if(buscador) {
        buscador.addEventListener('input', function() {
            // Normalizamos texto: quitamos acentos y pasamos a minúsculas
            const texto = this.value.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "");
            let coincidencias = 0;

            filas.forEach(fila => {
                // Leemos todo el contenido de texto de la fila actual
                const contenidoFila = fila.textContent.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "");
                
                if(contenidoFila.includes(texto)) {
                    fila.style.display = '';
                    coincidencias++;
                } else {
                    fila.style.display = 'none';
                }
            });

            // Si hay datos en la tabla pero ninguno coincide, mostramos el mensaje
            if(coincidencias === 0 && filas.length > 0) {
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
    .rounded-4 { border-radius: 1rem !important; }
</style>
@endsection