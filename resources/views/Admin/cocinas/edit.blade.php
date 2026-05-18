@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-0 py-3">
                    <h4 class="fw-bold mb-0 text-success">Editar Cocina: {{ $cocina->nombre }}</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.cocinas.update', $cocina->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nombre de la Cocina</label>
                            <input type="text" name="nombre" class="form-control rounded-3" value="{{ $cocina->nombre }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Zona / Ubicación</label>
                            <input type="text" name="zona" class="form-control rounded-3" value="{{ $cocina->zona }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Dueño (Partner)</label>
                            <select name="user_id" class="form-select rounded-3">
                                <option value="">Sin dueño asignado</option>
                                @foreach($owners as $owner)
                                    <option value="{{ $owner->id }}" {{ $cocina->user_id == $owner->id ? 'selected' : '' }}>
                                        {{ $owner->name }} ({{ $owner->email }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-light px-4 rounded-pill">Cancelar</a>
                            <button type="submit" class="btn btn-success px-4 rounded-pill shadow-sm">Actualizar Cocina</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection