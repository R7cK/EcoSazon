@extends('layouts.app')

@section('titulopagina', 'Ajustes de mi Cocina - EcoSazón')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            
            <div class="mb-4">
                <a href="{{ route('owner.dashboard') }}" class="btn btn-outline-secondary rounded-pill px-3 btn-sm">
                    <i class="fas fa-arrow-left me-2"></i>Volver al Panel
                </a>
            </div>

            <div class="card border-0 shadow-lg p-4 rounded-4">
                <div class="border-bottom pb-3 mb-4">
                    <h3 class="fw-bold text-dark mb-1">Configuración del Establecimiento</h3>
                    <p class="text-muted small mb-0">Modifica los datos públicos, zona de cobertura y presentación de tu cocina económica.</p>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show rounded-4 mb-4" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('owner.cocina.updateAjustes') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-4">
                        <div class="col-md-7">
                            <div class="mb-3">
                                <label for="nombre" class="form-label fw-bold small">Nombre Comercial</label>
                                <input type="text" class="form-control rounded-pill px-3" id="nombre" name="nombre" 
                                       value="{{ old('nombre', $cocina->nombre) }}" required>
                                @error('nombre') <small class="text-danger ps-2">{{ $message }}</small> @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="zona" class="form-label fw-bold small">Zona / Barrio de Mérida</label>
                                    <input type="text" class="form-control rounded-pill px-3" id="zona" name="zona" 
                                           value="{{ old('zona', $cocina->zona) }}" required placeholder="Ej. Centro, Caucel">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="categoria" class="form-label fw-bold small">Categoría Gastronómica</label>
                                    <input type="text" class="form-control rounded-pill px-3" id="categoria" name="categoria" 
                                           value="{{ old('categoria', $cocina->categoria) }}" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="telefono" class="form-label fw-bold small">Teléfono de Contacto</label>
                                    <input type="text" class="form-control rounded-pill px-3" id="telefono" name="telefono" 
                                           value="{{ old('telefono', $cocina->telefono) }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="horario" class="form-label fw-bold small">Horario de Servicio</label>
                                    <input type="text" class="form-control rounded-pill px-3" id="horario" name="horario" 
                                           value="{{ old('horario', $cocina->horario) }}" placeholder="Ej. 08:00 - 16:00">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="descripcion" class="form-label fw-bold small">Descripción del Establecimiento</label>
                                <textarea name="descripcion" id="descripcion" class="form-control p-3" rows="6" 
                                          style="border-radius: 15px;" placeholder="Describe las especialidades de tu cocina..." required>{{ old('descripcion', $cocina->descripcion) }}</textarea>
                                @error('descripcion') <small class="text-danger d-block mt-1">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="col-md-5 border-start ps-lg-4">
                            
                            <div class="mb-4 text-center">
                                <div class="form-check form-switch d-inline-block p-2 px-3 bg-light rounded-4 border">
                                    <input class="form-check-input ms-0 me-2" type="checkbox" name="usar_misma_imagen" id="usar_misma_ajustes" value="1" onchange="toggleFachadaAjustes(this)">
                                    <label class="form-check-label fw-bold small text-secondary" for="usar_misma_ajustes">Usar la misma foto para ambas</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 mb-4 d-flex flex-column align-items-center">
                                    <label class="form-label fw-bold small mb-2 text-center d-block">Imagen Principal del Perfil</label>
                                    <div class="mb-2 position-relative shadow border rounded-4 overflow-hidden" style="width: 100%; max-width: 260px; height: 150px; background-color: #f8f9fa;">
                                        @php
                                            $imgP = 'Imagenes/default-cocina.png';
                                            if ($cocina->imagen_principal) {
                                                $imgP = Str::startsWith($cocina->imagen_principal, ['http://', 'https://', 'Imagenes/']) ? asset($cocina->imagen_principal) : asset('storage/' . $cocina->imagen_principal);
                                            }
                                        @endphp
                                        <img id="preview-principal" src="{{ $imgP }}" alt="Principal" class="w-100 h-100" style="object-fit: cover;">
                                    </div>
                                    <input type="file" name="imagen_principal" id="input_principal" class="form-control form-control-sm rounded-pill" accept="image/*" onchange="previewAjustesFile(this, 'preview-principal')">
                                </div>

                                <div class="col-12 mb-2 d-flex flex-column align-items-center" id="wrapper_fachada_ajustes">
                                    <label class="form-label fw-bold small mb-2 text-center d-block">Imagen Real de la Fachada</label>
                                    <div class="mb-2 position-relative shadow border rounded-4 overflow-hidden" style="width: 100%; max-width: 260px; height: 150px; background-color: #f8f9fa;">
                                        @php
                                            $imgF = 'Imagenes/default-cocina.png';
                                            if ($cocina->imagen_fachada) {
                                                $imgF = Str::startsWith($cocina->imagen_fachada, ['http://', 'https://', 'Imagenes/']) ? asset($cocina->imagen_fachada) : asset('storage/' . $cocina->imagen_fachada);
                                            }
                                        @endphp
                                        <img id="preview-fachada" src="{{ $imgF }}" alt="Fachada" class="w-100 h-100" style="object-fit: cover;">
                                    </div>
                                    <input type="file" name="imagen_fachada" id="input_fachada" class="form-control form-control-sm rounded-pill" accept="image/*" onchange="previewAjustesFile(this, 'preview-fachada')">
                                </div>
                            </div>
                            
                            <small class="text-muted d-block text-center mt-3">Formatos: JPG, PNG, WEBP. Máx. 2MB por archivo.</small>
                        </div>
                    </div>

                    <div class="text-end mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-success rounded-pill px-5 py-2 shadow-sm">
                            <i class="fas fa-save me-2"></i>Guardar Todos los Cambios
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
// Manejador del visualizador en tiempo real
function previewAjustesFile(input, imgID) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById(imgID).src = e.target.result;
            
            // Si la sincronización está activa y se cambia la principal, replicar el render en la fachada
            if (imgID === 'preview-principal' && document.getElementById('usar_misma_ajustes').checked) {
                document.getElementById('preview-fachada').src = e.target.result;
            }
        }
        reader.readAsDataURL(input.files[0]);
    }
}

// Controlador del switch de duplicación de imágenes
function toggleFachadaAjustes(checkbox) {
    const inputF = document.getElementById('input_fachada');
    const wrapper = document.getElementById('wrapper_fachada_ajustes');
    const imgPrincipalSrc = document.getElementById('preview-principal').src;
    
    if (checkbox.checked) {
        inputF.value = "";
        inputF.disabled = true;
        wrapper.style.opacity = '0.5';
        // Sincroniza la visualización de la fachada con la foto del cuadro principal en pantalla
        document.getElementById('preview-fachada').src = imgPrincipalSrc;
    } else {
        inputF.disabled = false;
        wrapper.style.opacity = '1';
        // Retornar a la imagen que está guardada originalmente en la base de datos
        document.getElementById('preview-fachada').src = "{{ $cocina->imagen_fachada ? (Str::startsWith($cocina->imagen_fachada, ['http://', 'https://', 'Imagenes/']) ? asset($cocina->imagen_fachada) : asset('storage/' . $cocina->imagen_fachada)) : asset('Imagenes/default-cocina.png') }}";
    }
}
</script>
@endsection