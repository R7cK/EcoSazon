@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        {{-- Ampliamos el espacio para las dos columnas --}}
        <div class="col-md-10">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                    <h4 class="fw-bold mb-0 text-success"><i class="fas fa-plus-circle me-2"></i>Registrar Nueva Cocina</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.cocinas.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            {{-- Columna Izquierda --}}
                            <div class="col-md-6 border-end pe-md-4">
                                <h6 class="fw-bold text-muted mb-3">Información General</h6>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Nombre de la Cocina</label>
                                    <input type="text" name="nombre" class="form-control rounded-3" placeholder="Ej. El Sazón de Doña Mary" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Zona</label>
                                    <input type="text" name="zona" class="form-control rounded-3" placeholder="Ej. Norte / Altabrisa" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Categoría</label>
                                    <input type="text" name="categoria" class="form-control rounded-3" placeholder="Ej. Casera, Yucateca" required>
                                </div>
                            </div>

                            {{-- Columna Derecha --}}
                            <div class="col-md-6 ps-md-4">
                                <h6 class="fw-bold text-muted mb-3">Administración</h6>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Asignar Dueño (Socio)</label>
                                    <select name="user_id" class="form-select rounded-3">
                                        <option value="">Seleccionar un Partner</option>
                                        @foreach($owners as $owner)
                                            <option value="{{ $owner->id }}">{{ $owner->name }} ({{ $owner->email }})</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold">Estatus de la Cocina</label>
                                    <select name="estatus" class="form-select rounded-3">
                                        <option value="activa" {{ (isset($cocina) && $cocina->estatus == 'activa') ? 'selected' : '' }}>Activa</option>
                                        <option value="inactiva" {{ (isset($cocina) && $cocina->estatus == 'inactiva') ? 'selected' : '' }}>Inactiva</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 pt-3 text-end border-top">
                            <a href="{{ route('admin.cocinas.index') }}" class="btn btn-light px-4 rounded-pill me-2">Cancelar</a>
                            <button type="submit" class="btn btn-success px-5 rounded-pill shadow-sm">Guardar Cocina</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection