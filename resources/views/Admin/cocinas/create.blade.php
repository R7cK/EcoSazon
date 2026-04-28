@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-0 py-3">
                    <h4 class="fw-bold mb-0 text-success">Registrar Nueva Cocina</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.cocinas.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nombre</label>
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

                        <div class="mb-3">
                            <label class="form-label fw-bold">Asignar Dueño</label>
                            <select name="user_id" class="form-select rounded-3">
                                <option value="">Seleccionar un Partner</option>
                                @foreach($owners as $owner)
                                    <option value="{{ $owner->id }}">{{ $owner->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Estatus de la Cocina</label>
                            <select name="estatus" class="form-select rounded-3">
                                <option value="activa" {{ (isset($cocina) && $cocina->estatus == 'activa') ? 'selected' : '' }}>Activa</option>
                                <option value="inactiva" {{ (isset($cocina) && $cocina->estatus == 'inactiva') ? 'selected' : '' }}>Inactiva</option>
                            </select>
                        </div>

                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-success px-5 rounded-pill shadow-sm">Guardar Cocina</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection