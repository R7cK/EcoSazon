@extends('layouts.app')

@section('titulopagina', $cocina['nombre'] . ' - EcoSazón')

@section('content')
<div class="position-relative" style="height: 400px;">
    <img src="{{ asset($cocina['imagen_principal']) }}" class="w-100 h-100 object-fit-cover" alt="Platillo representativo de {{ $cocina['nombre'] }}">
    <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-50"></div>
    
    <div class="position-absolute bottom-0 start-0 w-100 p-4 p-md-5 text-white">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-md-8 mb-3 mb-md-0">
                    <span class="badge bg-success mb-2 px-3 py-2 fs-6 shadow">{{ $cocina['categoria'] }}</span>
                    <h1 class="display-4 fw-bold mb-2">{{ $cocina['nombre'] }}</h1>
                    <p class="fs-5 mb-0"><i class="fas fa-map-marker-alt text-danger me-2"></i>{{ $cocina['zona'] }}</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <div class="bg-white text-dark d-inline-block rounded-4 p-3 shadow-lg text-center" style="min-width: 150px;">
                        <div class="text-warning fs-3 mb-1">
                            <i class="fas fa-star"></i> <span class="fw-bold text-dark">{{ $cocina['calificacion'] }}</span>
                        </div>
                        <div class="small fw-bold text-secondary text-uppercase tracking-wide">Aprobación</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="row g-5">
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4 sticky-lg-top" style="top: 20px; z-index: 1;">
                <img src="{{ asset($cocina['imagen_fachada']) }}" class="card-img-top object-fit-cover" style="height: 250px;" alt="Fachada de {{ $cocina['nombre'] }}">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3" style="color: #E67E22;"><i class="fas fa-info-circle me-2"></i> Sobre nosotros</h5>
                    <p class="text-muted" style="line-height: 1.6;">{{ $cocina['descripcion'] }}</p>
                    
                    <hr class="my-4">
                    
                    <ul class="list-unstyled mb-0">
                        <li class="mb-3 d-flex align-items-start">
                            <i class="fas fa-clock text-success fs-5 me-3 mt-1"></i> 
                            <div>
                                <strong class="d-block text-dark">Horario de atención:</strong>
                                <span class="text-muted">{{ $cocina['horario'] }}</span>
                            </div>
                        </li>
                        <li class="mb-3 d-flex align-items-start">
                            <i class="fas fa-phone-alt text-success fs-5 me-3 mt-1"></i> 
                            <div>
                                <strong class="d-block text-dark">Teléfono para pedidos:</strong>
                                <span class="text-muted">{{ $cocina['telefono'] }}</span>
                            </div>
                        </li>
                        @if($cocina['abierto_24h'])
                        <li class="mt-4">
                            <span class="badge bg-success p-2 w-100 fs-6"><i class="fas fa-check-circle me-1"></i> Abierto 24 Horas</span>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="mb-4">
                <h2 class="fw-bold mb-3" style="color: #E67E22; border-left: 5px solid var(--amarillo); padding-left: 15px;">
                    Menú de {{ $cocina['nombre'] }}
                </h2>
                <p class="text-muted mb-4 fs-5">Descubre los platillos preparados al momento para ti.</p>
            </div>

            <div class="row g-3 mb-5 bg-light p-3 rounded-4 shadow-sm border-0 align-items-center">
                <div class="col-md-7">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 text-success"><i class="fas fa-search"></i></span>
                        <input type="text" id="input-busqueda-plato" class="form-control border-start-0 shadow-none" placeholder="Buscar un platillo (ej. torta, sopa)...">
                    </div>
                </div>
                <div class="col-md-5">
                    <label class="form-label fw-bold small text-muted mb-1 d-flex justify-content-between">
                        <span>Precio Máximo:</span> 
                        <span class="text-success ms-1">$<span id="valor-precio-plato">300</span></span>
                    </label>
                    <input type="range" class="form-range" min="0" max="300" step="5" id="rango-precio-plato" value="300">
                </div>
            </div>
            
            <div id="mensaje-no-platos" class="text-center my-4" style="display: none;">
                <p class="text-muted fs-5"><i class="fas fa-search-minus"></i> No hay platillos que coincidan con tu búsqueda o presupuesto.</p>
            </div>
            
            <div class="row g-4" id="contenedor-platos">
                @forelse($cocina->platos as $item)
                <div class="col-md-6 tarjeta-plato" data-precio="{{ $item->precio }}">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden" style="transition: transform 0.2s, box-shadow 0.2s;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 20px rgba(0,0,0,0.1)';" onmouseout="this.style.transform='none'; this.style.boxShadow='';">
                        @if($item->imagen)
                            <img src="{{ asset($item->imagen) }}" class="card-img-top object-fit-cover" style="height: 150px;" alt="{{ $item->nombre }}">
                        @endif
                        <div class="card-body p-4 d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h5 class="fw-bold mb-0 text-dark pe-3 nombre-plato" style="line-height: 1.3;">{{ $item->nombre }}</h5>
                                <span class="badge bg-success fs-6 rounded-pill px-3 py-2">${{ number_format($item->precio, 2) }}</span>
                            </div>
                            <p class="text-muted small mb-4 flex-grow-1 desc-plato" style="line-height: 1.5;">{{ $item->descripcion }}</p>
                            
                            <button class="btn btn-outline-success w-100 fw-bold rounded-pill mt-auto py-2">
                                <i class="fas fa-plus-circle me-2"></i> Agregar al pedido
                            </button>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center text-muted py-5">
                    <i class="fas fa-utensils fs-1 mb-3 text-light"></i>
                    <h5>Esta cocina aún no ha registrado platillos en su menú.</h5>
                </div>
                @endforelse
            </div>
            
            <div class="mt-5 pt-3 text-center border-top">
                <a href="{{ route('cocinas.index') }}" class="btn btn-light border text-dark fw-bold px-4 py-2 rounded-pill shadow-sm">
                    <i class="fas fa-arrow-left me-2"></i> Volver a todas las Cocinas
                </a>
            </div>
        </div>
    </div>
</div>
<div class="container my-5">
    <hr class="my-5">
    <h3 class="fw-bold mb-4" style="color: #E67E22;">Opiniones de la Comunidad</h3>

    @auth
        <form action="{{ route('cocina.comentario', $cocina->id) }}" method="POST" class="mb-5 bg-white p-4 rounded-4 shadow-sm">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-bold">Tu calificación</label>
                <select name="calificacion" class="form-select rounded-pill">
                    <option value="5">⭐⭐⭐⭐⭐ (Excelente)</option>
                    <option value="4">⭐⭐⭐⭐ (Muy bueno)</option>
                    <option value="3">⭐⭐⭐ (Bueno)</option>
                    <option value="2">⭐⭐ (Regular)</option>
                    <option value="1">⭐ (Malo)</option>
                </select>
            </div>
            <div class="mb-3">
                <textarea name="contenido" class="form-control rounded-4" rows="3" placeholder="Cuéntanos tu experiencia..."></textarea>
            </div>
            <button type="submit" class="btn btn-success rounded-pill px-4">Publicar Comentario</button>
        </form>
    @else
        <div class="alert alert-light border rounded-4 text-center">
            Para dejar un comentario, <a href="{{ route('login') }}" class="fw-bold text-success">inicia sesión aquí</a>.
        </div>
    @endauth

    <div class="list-group list-group-flush">
        @forelse($cocina->comentarios as $comentario)
            <div class="list-group-item border-0 px-0 mb-3">
                <div class="d-flex w-100 justify-content-between align-items-center">
                    <h6 class="mb-1 fw-bold">{{ $comentario->user->name }}</h6>
                    <small class="text-warning">
                        {{ str_repeat('⭐', $comentario->calificacion) }}
                    </small>
                </div>
                <p class="mb-1 text-muted">{{ $comentario->contenido }}</p>
                <small class="text-secondary">{{ $comentario->created_at->diffForHumans() }}</small>
            </div>
        @empty
            <p class="text-center text-muted">Aún no hay comentarios. ¡Sé el primero en opinar!</p>
        @endforelse
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const inputBusqueda = document.getElementById('input-busqueda-plato');
        const rangoPrecio = document.getElementById('rango-precio-plato');
        const valorPrecio = document.getElementById('valor-precio-plato');
        const mensajeNoResultados = document.getElementById('mensaje-no-platos');
        const tarjetas = document.querySelectorAll('.tarjeta-plato');

        // Actualiza el número de precio visualmente al mover la barra
        if(rangoPrecio) {
            rangoPrecio.addEventListener('input', function() {
                valorPrecio.textContent = this.value;
                aplicarFiltrosPlatos();
            });
        }

        if(inputBusqueda) {
            inputBusqueda.addEventListener('input', aplicarFiltrosPlatos);
        }

        function aplicarFiltrosPlatos() {
            const texto = inputBusqueda.value.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "");
            const maxPrecio = parseFloat(rangoPrecio.value);
            let coincidencias = 0;

            tarjetas.forEach(tarjeta => {
                const nombrePlato = tarjeta.querySelector('.nombre-plato').textContent.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "");
                const descPlato = tarjeta.querySelector('.desc-plato').textContent.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "");
                const precioPlato = parseFloat(tarjeta.getAttribute('data-precio'));

                const pasaTexto = nombrePlato.includes(texto) || descPlato.includes(texto);
                const pasaPrecio = precioPlato <= maxPrecio;

                if (pasaTexto && pasaPrecio) {
                    tarjeta.style.display = 'block';
                    coincidencias++;
                } else {
                    tarjeta.style.display = 'none';
                }
            });

            // Si hay tarjetas ocultas y coincidencias = 0, mostramos mensaje de error
            if (tarjetas.length > 0) {
                mensajeNoResultados.style.display = (coincidencias === 0) ? 'block' : 'none';
            }
        }
    });
</script>
@endsection