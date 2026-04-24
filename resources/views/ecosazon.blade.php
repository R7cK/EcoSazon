@extends('layouts.app')

@section('titulopagina', 'Menú del Día - EcoSazón')
@section('titulo', 'Menú del Día')
@section('subtitulo', 'Explora y filtra los platillos preparados al momento en nuestra red.')

@section('content')
<div class="container my-5">

    <div class="filter-wrapper mb-5" style="position: sticky; top: 130px; z-index: 1020;">
    <div class="card shadow border-0 bg-white" style="border-top: 4px solid #E67E22 !important;">
        
        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center py-3">
            <h5 class="fw-bold mb-0 text-dark">
                <i class="fas fa-search me-2" style="color: #E67E22;"></i> Búsqueda y Filtros
            </h5>
            
            <button class="btn btn-light btn-sm border fw-bold text-secondary rounded-pill px-4" 
                    type="button" 
                    data-bs-toggle="collapse" 
                    data-bs-target="#filtrosAvanzados" 
                    id="btn-toggle-filtros"
                    aria-expanded="false"
                    aria-controls="filtrosAvanzados">
                <i class="fas fa-filter me-1"></i> Mostrar Filtros
            </button>
        </div>

        <div class="collapse" id="filtrosAvanzados">
            <div class="card-body pt-0 border-top mt-2">
                <div class="row g-3 pt-3">
                    <div class="col-12">
                        <div class="input-group shadow-sm">
                            <select class="form-select bg-light" id="tipo-busqueda" style="max-width: 180px;">
                                <option value="todos">Buscar en Todo</option>
                                <option value="platillo">Por Platillo</option>
                                <option value="cocina">Por Cocina</option>
                            </select>
                            <input type="text" id="input-busqueda" class="form-control" placeholder="Ej. poc chuc, lima, etc...">
                        </div>
                    </div>

                    <div class="col-12 col-md-4 mt-3">
                        <label class="form-label fw-bold small text-muted d-flex justify-content-between">
                            <span>Precio Máximo:</span>
                            <span class="text-success fs-6">$<span id="valor-precio">200</span></span>
                        </label>
                        <input type="range" class="form-range" min="0" max="200" step="5" id="rango-precio" value="200">
                    </div>

                    <div class="col-12 col-md-4 mt-3">
                        <label class="form-label fw-bold small text-muted">Colonia / Zona</label>
                        <select class="form-select shadow-sm" id="select-zona">
                            <option value="todas">Todas las zonas</option>
                            @foreach($zonas as $zona)
                                <option value="{{ $zona }}">{{ $zona }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-4 mt-3">
                        <label class="form-label fw-bold small text-muted">Tipo de Comida</label>
                        <select class="form-select shadow-sm" id="select-categoria">
                            <option value="todas">Todos los tipos</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria }}">{{ $categoria }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-4 mt-3">
                        <label class="form-label fw-bold small text-muted">Calificación Mínima</label>
                        <select class="form-select shadow-sm" id="select-calificacion">
                            <option value="0">Cualquier calificación</option>
                            <option value="4.5">Excelente (4.5 o más)</option>
                            <option value="4.0">Muy Buena (4.0 o más)</option>
                            <option value="3.5">Buena (3.5 o más)</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <div id="mensaje-no-resultados" class="text-center my-5" style="display: none;">
        <h4 class="text-danger fw-bold"><i class="fas fa-search-minus"></i> No encontramos nada con esos filtros.</h4>
        <p class="text-muted fs-5">Intenta ampliar tu rango de precio o cambiar la zona.</p>
    </div>

    <div class="row g-4 contenedor-padre">
        @foreach($cocinas as $cocina)
        <div class="col-12 col-md-6 col-lg-4 tarjeta-filtro" 
             data-precio="{{ $cocina['precio_completo'] }}" 
             data-zona="{{ $cocina['zona'] }}" 
             data-calif="{{ $cocina['calificacion'] }}"
             data-categoria="{{ $cocina['categoria'] }}"> 
            
            <div class="card h-100 border-0 shadow-sm overflow-hidden bg-white">
                <img src="{{ asset($cocina['imagen']) }}" class="card-img-top" alt="{{ $cocina['menu_dia'] }}" style="height: 220px; object-fit: cover;">
                <div class="card-body d-flex flex-column">
                    <h4 class="mb-1 item-platillo fw-bold text-dark">{{ $cocina['menu_dia'] }}</h4>
                    <p class="mb-3 text-muted small item-cocina">
                        <i class="fas fa-store text-success me-1"></i> {{ $cocina['nombre'] }} | 
                        <i class="fas fa-map-marker-alt text-danger ms-1"></i> {{ $cocina['zona'] }}
                    </p>
                    <p class="card-text text-secondary mb-3" style="font-size: 0.95rem;">
                        {{ $cocina['descripcion'] }}
                    </p>
                    <div class="d-flex justify-content-between align-items-center mb-4 mt-auto">
                        <div class="text-warning small">
                            <i class="fas fa-star"></i> <span class="text-dark fw-bold">{{ $cocina['calificacion'] }}</span>
                        </div>
                        <h5 class="fw-bold text-success mb-0">${{ number_format($cocina['precio_completo'], 2) }} MXN</h5>
                    </div>
                    <div>
                        <a href="#" class="btn btn-outline-success w-100 fw-bold">
                            <i class="fas fa-shopping-cart me-2"></i> Ordenar ahora
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const inputBusqueda = document.getElementById('input-busqueda');
        const tipoBusqueda = document.getElementById('tipo-busqueda');
        const rangoPrecio = document.getElementById('rango-precio');
        const valorPrecio = document.getElementById('valor-precio');
        const selectZona = document.getElementById('select-zona');
        const selectCalif = document.getElementById('select-calificacion');
        const selectCategoria = document.getElementById('select-categoria');
        const mensajeNoResultados = document.getElementById('mensaje-no-resultados');
        const tarjetas = document.querySelectorAll('.tarjeta-filtro');

        // --- Código para el cambio en boton en filtros dependiendo de su estado ---
        const btnToggle = document.getElementById('btn-toggle-filtros');
        const colapsoFiltros = document.getElementById('filtrosAvanzados');

        // Panel de filtro abierto
        colapsoFiltros.addEventListener('show.bs.collapse', function () {
            btnToggle.innerHTML = '<i class="fas fa-times me-1"></i> Ocultar Filtros';
            btnToggle.classList.replace('btn-light', 'btn-outline-danger');
        });
        
        //Panel de filtro cerrado
        colapsoFiltros.addEventListener('hide.bs.collapse', function () {
            btnToggle.innerHTML = '<i class="fas fa-filter me-1"></i> Mostrar Filtros';
            btnToggle.classList.replace('btn-outline-danger', 'btn-light');
        });

        // Actualizar visualmente el número del precio al arrastrar
        rangoPrecio.addEventListener('input', function() {
            valorPrecio.textContent = this.value;
            aplicarFiltros();
        });

        function aplicarFiltros() {
            // Valores actuales de todos los filtros
            const texto = inputBusqueda.value.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "");
            const tipo = tipoBusqueda.value;
            const maxPrecio = parseFloat(rangoPrecio.value);
            const zona = selectZona.value;
            const califMin = parseFloat(selectCalif.value);
            const categoriaSeleccionada = selectCategoria.value;

            let coincidencias = 0;

            tarjetas.forEach(tarjeta => {
                // Atributos de la tarjeta
                const valPrecio = parseFloat(tarjeta.getAttribute('data-precio'));
                const valZona = tarjeta.getAttribute('data-zona');
                const valCalif = parseFloat(tarjeta.getAttribute('data-calif'));
                const txtPlatillo = tarjeta.querySelector('.item-platillo').textContent.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "");
                const txtCocina = tarjeta.querySelector('.item-cocina').textContent.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "");
                const valCategoria = tarjeta.getAttribute('data-categoria');

                // Validación 1: Texto
                let pasaTexto = false;
                if (tipo === 'todos') pasaTexto = txtPlatillo.includes(texto) || txtCocina.includes(texto);
                else if (tipo === 'platillo') pasaTexto = txtPlatillo.includes(texto);
                else if (tipo === 'cocina') pasaTexto = txtCocina.includes(texto);

                // Validación 2, 3 y 4: Precio, Zona y Calificación
                let pasaPrecio = valPrecio <= maxPrecio;
                let pasaZona = (zona === 'todas' || valZona === zona);
                let pasaCalif = valCalif >= califMin;
                let pasaCategoria = (categoriaSeleccionada === 'todas' || valCategoria === categoriaSeleccionada);

                // Si cumple TODOS los filtros simultáneamente, se muestra
                if (pasaTexto && pasaPrecio && pasaZona && pasaCalif && pasaCategoria) {
                    tarjeta.style.display = 'block';
                    coincidencias++;
                } else {
                    tarjeta.style.display = 'none';
                }
            });

            mensajeNoResultados.style.display = (coincidencias === 0) ? 'block' : 'none';
        }

        // Asignar los eventos
        inputBusqueda.addEventListener('input', aplicarFiltros);
        tipoBusqueda.addEventListener('change', aplicarFiltros);
        selectZona.addEventListener('change', aplicarFiltros);
        selectCalif.addEventListener('change', aplicarFiltros);
        selectCategoria.addEventListener('change', aplicarFiltros);

        // --- CÓDIGO NUEVO PARA RECIBIR LA BÚSQUEDA DEL INICIO EN LOS MENÚS ---
        const parametrosURL = new URLSearchParams(window.location.search);
        const urlBusqueda = parametrosURL.get('q');
        const urlZona = parametrosURL.get('z');
        
        let requiereFiltroInicial = false;

        // Si vino texto en la URL, lo ponemos en el input de búsqueda de platillos
        if (urlBusqueda) {
            inputBusqueda.value = urlBusqueda;
            requiereFiltroInicial = true;
        }
        
        // Si vino una zona en la URL, seleccionamos esa colonia en el menú desplegable
        if (urlZona) {
            for (let i = 0; i < selectZona.options.length; i++) {
                if (selectZona.options[i].value.toLowerCase().includes(urlZona.toLowerCase())) {
                    selectZona.selectedIndex = i;
                    requiereFiltroInicial = true;
                    break;
                }
            }
        }
        
        // Si detectamos parámetros, ejecutamos la función de filtros para mostrar resultados
        if (requiereFiltroInicial) {
            aplicarFiltros();
        }
    });
</script>
@endsection