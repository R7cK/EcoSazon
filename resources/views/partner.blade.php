@extends('layouts.app')

@section('titulopagina', 'Únete como Partner - EcoSazón')

@section('titulo', 'Haz crecer tu cocina con nosotros')
@section('subtitulo', 'Digitaliza tu sazón y llega a más hogares en Mérida con comisiones justas.')

@section('Autor', 'Equipo EcoSazón')
@section('actividad', 'Propuesta de E-Commerce')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg p-4" style="border-radius: 25px;">
                <h3 class="fw-bold text-center mb-4" style="color: var(--naranja);">Registra tu Cocina</h3>
                
                <form action="{{ route('owner.cocina.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="nombre" class="form-label fw-bold">Nombre de la Cocina <span class="text-danger">*</span></label>
                        <input type="text" class="form-control rounded-pill px-3" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                        @error('nombre') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="zona" class="form-label fw-bold">Zona (Ej. Centro, Norte) <span class="text-danger">*</span></label>
                            <input type="text" class="form-control rounded-pill px-3" id="zona" name="zona" value="{{ old('zona') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="categoria" class="form-label fw-bold">Categoría <span class="text-danger">*</span></label>
                            <select class="form-select rounded-pill px-3" id="categoria" name="categoria" required>
                                <option value="" disabled {{ old('categoria') ? '' : 'selected' }}>Selecciona una categoría...</option>
                                <option value="Comida Yucateca">Comida Yucateca</option>
                                <option value="Comida Casera">Comida Casera</option>
                                <option value="Comida Tradicional">Comida Tradicional</option>
                                <option value="Antojitos Regionales">Antojitos Regionales</option>
                                <option value="Mariscos">Mariscos</option>
                                <option value="Saludable">Saludable</option>
                                <option value="Vegana">Vegana</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label fw-bold">Descripción Corta <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3" style="border-radius: 15px;" required placeholder="Describe los platillos o especialidad de tu cocina...">{{ old('descripcion') }}</textarea>
                        @error('descripcion') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="telefono" class="form-label fw-bold">Teléfono</label>
                            <input type="text" class="form-control rounded-pill px-3" id="telefono" name="telefono" value="{{ old('telefono') }}" placeholder="Ej. 9991234567">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="horario" class="form-label fw-bold">Horario</label>
                            <input type="text" class="form-control rounded-pill px-3" id="horario" name="horario" value="{{ old('horario') }}" placeholder="Ej. 08:00 - 16:00">
                        </div>
                    </div>

                                    <div class="mb-3 mt-4">
                    <div class="form-check form-switch d-inline-block p-3 bg-light rounded-4 border mb-3">
                        <input class="form-check-input ms-0 me-2" type="checkbox" name="usar_misma_imagen" id="usar_misma_imagen" value="1" onchange="toggleFachadaRegistro(this)">
                        <label class="form-check-label fw-bold small text-secondary" for="usar_misma_imagen">Usar la misma foto para Imagen Principal y Fachada</label>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="imagen_principal" class="form-label fw-bold small">Imagen Principal <span class="text-danger">*</span></label>
                        <input class="form-control rounded-pill px-3" type="file" id="imagen_principal" name="imagen_principal" accept="image/*" required>
                        @error('imagen_principal') <small class="text-danger d-block mt-1">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-md-6 mb-4" id="contenedor_fachada">
                        <label for="imagen_fachada" class="form-label fw-bold small">Imagen de la Fachada <span class="text-danger">*</span></label>
                        <input class="form-control rounded-pill px-3" type="file" id="imagen_fachada" name="imagen_fachada" accept="image/*" required>
                        @error('imagen_fachada') <small class="text-danger d-block mt-1">{{ $message }}</small> @enderror
                    </div>
                </div>

                <script>
                function toggleFachadaRegistro(checkbox) {
                    const inputFachada = document.getElementById('imagen_fachada');
                    const contenedor = document.getElementById('contenedor_fachada');
                    
                    if (checkbox.checked) {
                        inputFachada.required = false;
                        inputFachada.value = ""; // Limpiar selección si había alguna
                        contenedor.style.opacity = '0.5';
                        inputFachada.disabled = true;
                    } else {
                        inputFachada.required = true;
                        contenedor.style.opacity = '1';
                        inputFachada.disabled = false;
                    }
                }
                </script>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-success rounded-pill px-5 py-2 shadow">Guardar y Continuar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection