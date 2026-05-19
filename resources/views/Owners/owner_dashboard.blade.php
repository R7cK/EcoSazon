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

    {{-- ALERTAS DE ÉXITO Y ERROR --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4 mb-4 shadow-sm" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show rounded-4 mb-4 shadow-sm" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i><strong>No se pudo guardar la información:</strong>
            <ul class="mb-0 mt-2 small">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

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
                    <button class="btn btn-success btn-sm rounded-pill px-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#nuevoPlatoModal">
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
                                            <div class="rounded-3 bg-light me-3 overflow-hidden shadow-sm border" style="width: 45px; height: 45px;">
                                                {{-- CORRECCIÓN DE LA MINIATURA: Renderizado dinámico del path absoluto sin anteponer storage/ --}}
                                                @php
                                                    $platoImgUrl = asset('Imagenes/default-cocina.png');
                                                    if ($plato->imagen) {
                                                        if (\Illuminate\Support\Str::startsWith($plato->imagen, ['http://', 'https://', 'Imagenes/'])) {
                                                            $platoImgUrl = asset($plato->imagen);
                                                        } else {
                                                            $platoImgUrl = asset('storage/' . $plato->imagen);
                                                        }
                                                    }
                                                @endphp
                                                <img src="{{ $platoImgUrl }}" alt="{{ $plato->nombre }}" class="w-100 h-100" style="object-fit: cover;">
                                            </div>
                                            <span class="fw-bold">{{ $plato->nombre }}</span>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-light text-dark rounded-pill border">{{ $plato->categoria ?? 'General' }}</span></td>
                                    <td class="fw-bold text-success">${{ number_format($plato->precio, 2) }}</td>
                                    <td class="text-end pe-4">
                                        <div class="d-flex justify-content-end align-items-center gap-2">
                                            
                                            {{-- Botón de Editar --}}
                                            <button type="button" class="btn btn-sm btn-outline-secondary rounded-circle" data-bs-toggle="modal" data-bs-target="#editarPlatoModal{{ $plato->id }}">
                                                <i class="fas fa-edit"></i>
                                            </button>

                                            {{-- Botón de Eliminar --}}
                                            <form action="{{ route('owner.platos.destroy', $plato->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este platillo?');" class="m-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>

                                        {{-- Modal para Editar Plato --}}
                                        <div class="modal fade" id="editarPlatoModal{{ $plato->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog text-start modal-lg">
                                                <form action="{{ route('owner.platos.update', $plato->id) }}" method="POST" enctype="multipart/form-data" class="modal-content rounded-4 border-0 shadow">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header border-0 p-4 pb-0">
                                                        <h5 class="modal-title fw-bold">Editar Platillo</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body p-4">
                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label fw-bold small">Nombre del Plato</label>
                                                                <input type="text" name="nombre" class="form-control rounded-pill px-3" value="{{ $plato->nombre }}" required>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label fw-bold small">Precio ($)</label>
                                                                <input type="number" name="precio" step="0.01" class="form-control rounded-pill px-3" value="{{ $plato->precio }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold small">Categoría</label>
                                                            <select name="categoria" class="form-select rounded-pill px-3">
                                                                <option value="Desayuno" {{ $plato->categoria == 'Desayuno' ? 'selected' : '' }}>Desayuno</option>
                                                                <option value="Comida" {{ $plato->categoria == 'Comida' ? 'selected' : '' }}>Comida</option>
                                                                <option value="Bebida" {{ $plato->categoria == 'Bebida' ? 'selected' : '' }}>Bebida</option>
                                                                <option value="Postre" {{ $plato->categoria == 'Postre' ? 'selected' : '' }}>Postre</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold small">Descripción del Platillo</label>
                                                            <textarea name="descripcion" class="form-control p-3" rows="3" style="border-radius: 15px;">{{ $plato->descripcion }}</textarea>
                                                        </div>
                                                        
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold small d-block text-center mb-2">Imagen Actual del Platillo</label>
                                                            
                                                            {{-- CUADRO DE PREVISUALIZACIÓN DE IMAGEN ASIGNADA --}}
                                                            <div class="mb-3 position-relative shadow-sm border rounded-4 overflow-hidden mx-auto" style="width: 100%; max-width: 250px; height: 160px; background-color: #f8f9fa;">
                                                                <img id="preview-plato-edit-{{ $plato->id }}" src="{{ $platoImgUrl }}" alt="Foto del plato" class="w-100 h-100" style="object-fit: cover;">
                                                            </div>

                                                            <input type="file" name="imagen" class="form-control rounded-pill px-3" accept="image/*" onchange="previewEditPlato(this, 'preview-plato-edit-{{ $plato->id }}')">
                                                            <small class="text-muted d-block text-center mt-2">Sube una nueva imagen solo si deseas reemplazar la mostrada en pantalla.</small>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer border-0 p-4 pt-0">
                                                        <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm w-100">Guardar Cambios</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
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

           {{-- Ajustes Rápidos --}}
            <div class="card border-0 shadow-sm rounded-4 mt-4 bg-dark text-white p-4">
                <h6 class="fw-bold mb-3">Ajustes Rápidos</h6>
                <div class="d-grid gap-2">
                    <button type="button" class="btn btn-outline-light btn-sm rounded-pill text-start" data-bs-toggle="modal" data-bs-target="#ajustesCocinaModal">
                        <i class="fas fa-clock me-2"></i> Cambiar Horario
                    </button>
                    <button type="button" class="btn btn-outline-light btn-sm rounded-pill text-start" data-bs-toggle="modal" data-bs-target="#ajustesCocinaModal">
                        <i class="fas fa-map-marker-alt me-2"></i> Editar Ubicación
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- SECCIÓN DE ÓRDENES / PEDIDOS POR ENTREGAR --}}
    <div class="row mt-4">
        <div class="col-12 mb-4">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-white border-0 p-4 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0"><i class="fas fa-shopping-bag me-2 text-primary"></i>Órdenes por Entregar</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light text-muted small uppercase">
                                <tr>
                                    <th class="ps-4">No. Pedido</th>
                                    <th>Fecha</th>
                                    <th>Plato Solicitado</th>
                                    <th>Cantidad</th>
                                    <th>Cliente / Contacto</th>
                                    <th>Subtotal</th>
                                    <th>Estatus</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pedidosPendientes as $detalle)
                                <tr>
                                    <td class="ps-4 fw-bold text-secondary">
                                        #{{ str_pad($detalle->pedido_id, 5, '0', STR_PAD_LEFT) }}
                                    </td>
                                    <td>
                                        <span class="d-block small fw-bold">{{ $detalle->created_at->format('d/m/Y') }}</span>
                                        <span class="text-muted small">{{ $detalle->created_at->format('h:i A') }}</span>
                                    </td>
                                    <td class="fw-bold">{{ $detalle->plato_nombre }}</td>
                                    <td>
                                        <span class="badge bg-primary rounded-pill px-3 py-2">{{ $detalle->cantidad }}x</span>
                                    </td>
                                    <td>
                                        <span class="d-block small fw-bold">
                                            {{ $detalle->pedido->user ? $detalle->pedido->user->name : 'Invitado' }}
                                        </span>
                                        <small class="text-muted">{{ $detalle->pedido->email_contacto }}</small>
                                    </td>
                                    <td class="fw-bold text-success">
                                        ${{ number_format($detalle->subtotal, 2) }}
                                    </td>
                                    
                                    {{-- COLUMNA DE INSIGNIA VISUAL --}}
                                    <td>
                                        @php $estado = $detalle->estatus ?? 'pendiente'; @endphp
                                        <span class="badge 
                                            {{ $estado == 'pendiente' ? 'bg-warning text-dark' : '' }}
                                            {{ $estado == 'en entrega' ? 'bg-info text-dark' : '' }}
                                            {{ $estado == 'entregado' ? 'bg-success' : '' }}
                                            {{ $estado == 'cancelado' ? 'bg-danger' : '' }}">
                                            {{ strtoupper($estado) }}
                                        </span>
                                    </td>

                                    {{-- COLUMNA PARA CAMBIAR ESTATUS RÁPIDAMENTE --}}
                                    <td>
                                        <form action="{{ route('owner.pedido.estatus', $detalle->id) }}" method="POST" class="m-0">
                                            @csrf
                                            @method('PATCH')
                                            <select name="estatus" class="form-select form-select-sm rounded-pill" 
                                                    onchange="this.form.submit()" 
                                                    {{ in_array($estado, ['entregado', 'cancelado']) ? 'disabled' : '' }}>
                                                <option value="pendiente" {{ $estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                                <option value="en entrega" {{ $estado == 'en entrega' ? 'selected' : '' }}>En Entrega</option>
                                                <option value="entregado" {{ $estado == 'entregado' ? 'selected' : '' }}>Entregado</option>
                                                <option value="cancelado" {{ $estado == 'cancelado' ? 'selected' : '' }}>Cancelar Orden</option>
                                            </select>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5 text-muted">
                                        <i class="fas fa-box-open fs-3 mb-2 opacity-50 d-block"></i>
                                        Aún no hay órdenes pendientes para tu cocina.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal para Añadir Nuevo Plato --}}
<div class="modal fade" id="nuevoPlatoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content rounded-4 border-0 shadow">
            
            <form action="{{ route('owner.platos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header border-0 p-4 pb-0">
                    <h5 class="modal-title fw-bold">Añadir Nuevo Plato</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body p-4">
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold small">Nombre del Plato</label>
                            <input type="text" class="form-control rounded-pill px-3" name="nombre" required placeholder="Ej. Enchiladas Verdes">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold small">Precio ($)</label>
                            <input type="number" step="0.01" class="form-control rounded-pill px-3" name="precio" required placeholder="Ej. 65.00">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold small">Categoría</label>
                        <select class="form-select rounded-pill px-3" name="categoria">
                            <option value="Desayuno">Desayuno</option>
                            <option value="Comida">Comida</option>
                            <option value="Bebida">Bebida</option>
                            <option value="Postre">Postre</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="descripcion_plato" class="form-label fw-bold small">Descripción del Platillo</label>
                        <textarea name="descripcion" id="descripcion_plato" class="form-control p-3" rows="4" 
                                style="border-radius: 15px;" placeholder="Ej. Delicioso platillo tradicional acompañado de cebolla morada y tortillas hechas a mano...">{{ old('descripcion') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="imagen_plato" class="form-label fw-bold small">Foto del Platillo</label>
                        
                        <div id="contenedor-preview-plato" class="mb-3 position-relative shadow-sm border rounded-4 overflow-hidden d-none mx-auto" style="width: 100%; max-width: 250px; height: 160px; background-color: #f8f9fa;">
                            <img id="preview-plato-nuevo" src="" alt="Vista previa del plato" class="w-100 h-100" style="object-fit: cover;">
                        </div>

                        <input type="file" name="imagen" id="imagen_plato" class="form-control rounded-pill px-3" accept="image/*" onchange="previewNuevoPlato(this)">
                        <small class="text-muted d-block text-center mt-2">Formato recomendado: JPG, PNG, WEBP. (Máx 2MB).</small>
                    </div>
                    
                </div> 

                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="submit" class="btn btn-success w-100 rounded-pill py-2 shadow-sm">
                        <i class="fas fa-plus-circle me-2"></i>Guardar Plato
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal para Ajustes Rápidos de la Cocina --}}
<div class="modal fade" id="ajustesCocinaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded-4 border-0 shadow">
            <form action="{{ route('owner.cocina.updateAjustes') }}" method="POST">
                @csrf
                <div class="modal-header border-0 p-4 pb-0 text-dark">
                    <h5 class="modal-title fw-bold">Ajustes de la Cocina</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 text-dark">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Horario de Atención</label>
                        <input type="text" class="form-control" name="horario" value="{{ $cocina->horario }}" placeholder="Ej. Lunes a Viernes de 8:00 AM a 4:00 PM">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Ubicación (Zona)</label>
                        <input type="text" class="form-control" name="zona" value="{{ $cocina->zona }}" required placeholder="Ej. Centro, Altabrisa...">
                    </div>
                </div>
                <input type="hidden" name="nombre" value="{{ $cocina->nombre }}">
                <input type="hidden" name="categoria" value="{{ $cocina->categoria }}">
                <input type="hidden" name="descripcion" value="{{ $cocina->descripcion }}">

                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="submit" class="btn btn-success w-100 rounded-pill py-2">Guardar Ajustes</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- SCRIPTS JAVASCRIPT REORGANIZADOS --}}
<script>
// Handler para la vista previa al CREAR un plato
function previewNuevoPlato(input) {
    const preview = document.getElementById('preview-plato-nuevo');
    const contenedor = document.getElementById('contenedor-preview-plato');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            contenedor.classList.remove('d-none');
        }
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.src = "";
        contenedor.classList.add('d-none'); 
    }
}

// Handler para cambiar la vista previa en tiempo real al EDITAR un plato
function previewEditPlato(input, imgElementId) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById(imgElementId).src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

<style>
    .bg-light-success { background-color: #e8f5e9; }
    .bg-light-warning { background-color: #fff8e1; }
    .bg-light-primary { background-color: #e3f2fd; }
    .btn-outline-secondary:hover { color: white; }
</style>
@endsection