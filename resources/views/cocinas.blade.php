@extends('layouts.app')

@section('titulopagina', 'Nuestras Cocinas - EcoSazón')
@section('titulo', 'Explora las Cocinas de Mérida')
@section('subtitulo', 'Desde el sabor tradicional hasta opciones dietéticas especializadas.')

@section('content')
<div class="container my-5">

    <style>
   .filtros-llamativos {
        background: linear-gradient(145deg, #ffffff, #f8f9fa);
        border-radius: 20px;
        border-left: 8px solid #E67E22; 
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        padding: 25px;
        transition: all 0.3s ease;
    }

    .filtros-llamativos:hover {
        box-shadow: 0 20px 40px rgba(230, 126, 34, 0.15);
    }

    /* ESTA ES LA MAGIA DEL PROFE: Responsivo y Pegajoso */
    @media (min-width: 992px) { /* Solo aplica de pantallas grandes en adelante */
        .filtros-llamativos {
        position: sticky !important;
        /* 1. Aumentamos el margen para que no lo tape el navbar */
        /* Prueba con 120px o 140px si tu navbar es muy grande */
        top: 140px !important; 

        /* 2. Ajustamos la altura máxima para que siempre quepa en la pantalla */
        /* 100vh es el total de la pantalla, le restamos el espacio de arriba y un margen abajo */
        max-height: calc(100vh - 150px) !important;
        
        /* 3. Permitimos scroll interno por si la lista de filtros es muy larga */
        overflow-y: auto !important;
        
        /* Evita que se estire innecesariamente */
        height: fit-content !important;
        z-index: 1020;
    }

    /* Estilo para que la barrita de scroll interna no se vea fea */
    .filtros-llamativos::-webkit-scrollbar {
        width: 5px;
    }
    .filtros-llamativos::-webkit-scrollbar-thumb {
        background: #E67E22;
        border-radius: 10px;
    }
    }

    .filtro-label {
        color: #4a4a4a;
        font-weight: 800;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 1px;
        margin-bottom: 8px;
        display: block;
    }
        .input-premium {
        border: 2px solid #eee !important;
        border-radius: 12px !important;
        padding: 10px 15px !important;
        background-color: #fff !important;
        transition: all 0.3s !important;
    }


 .input-premium:focus {
        border-color: #E67E22 !important;
        
        transform: translateY(-2px);
    }


    .search-group-premium {
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        border-radius: 12px;
        overflow: hidden;
    }
  .icono-naranja {
        color: #E67E22;
        background: rgba(230, 126, 34, 0.1);
        padding: 8px;
        border-radius: 50%;
    }
</style>

  <div class="row">
    
    <div class="col-12 col-lg-3 mb-4">
        <div class="filtros-llamativos">
            <div class="d-flex align-items-center mb-4">
                <i class="fas fa-search-location fa-2x icono-naranja me-3"></i>
                <div>
                    <h5 class="fw-black mb-0" style="color: #2c3e50;">ENCUENTRA</h5>
                    <p class="text-muted small mb-0">Tu sabor ideal</p>
                </div>
            </div>
            
            <div class="mb-4">
                <span class="filtro-label">¿Qué se te antoja?</span>
                <div class="input-group search-group-premium mb-2">
                    <select class="form-select border-0 bg-light" id="tipo-busqueda" style="max-width: 100px; font-size: 0.85rem;">
                        <option value="todos">Todo</option>
                        <option value="nombre">Nom</option>
                        <option value="categoria">Cat</option>
                    </select>
                    <input type="text" id="input-busqueda" class="form-control border-0" placeholder="Ej: Cochinita...">
                </div>
            </div>

            <div class="mb-4">
                <span class="filtro-label">Presupuesto Máx</span>
                <div class="px-2">
                    <input type="range" class="form-range" min="40" max="150" step="10" id="rango-precio" value="300">
                    <div class="d-flex justify-content-between">
                        <span class="fw-bold text-muted small">$50</span>
                        <span class="badge bg-success fs-6">$<span id="valor-precio">150</span></span>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <span class="filtro-label">Zona</span>
                <select class="form-select input-premium w-100" id="select-zona">
                    <option value="todas">📍 Todas las zonas</option>
                    @foreach($zonas as $zona)
                        <option value="{{ $zona }}">{{ $zona }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-2">
                <span class="filtro-label">Popularidad</span>
                <select class="form-select input-premium w-100" id="select-calificacion">
                    <option value="0">⭐ Todas</option>
                    <option value="4.5">4.5+ Excelente</option>
                    <option value="4.0">4.0+ Muy Buena</option>
                </select>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-9">
        
        <div id="mensaje-no-resultados" class="text-center my-5" style="display: none;">
            <h4 class="text-danger fw-bold"><i class="fas fa-exclamation-circle"></i> No existen cocinas con esos filtros.</h4>
            <p class="text-muted fs-5">Prueba aumentando el precio o quitando el filtro de zona.</p>
        </div>

        @foreach($categorias as $titulo => $lista)
        <div class="mb-5 categoria-seccion">
            <h3 class="fw-bold mb-4" style="color: #E67E22; border-left: 5px solid #f1c40f; padding-left: 15px;">
                {{ $titulo }}
            </h3>
            <div class="row g-4">
                @foreach($lista as $cocina)
                <div class="col-12 col-lg-6 tarjeta-filtro"
                     data-precio="{{ round($cocina->platos_avg_precio ?? 0) }}"
                     data-zona="{{ $cocina->zona }}"
                     data-calif="{{ $cocina->calificacion }}">
                    
                    <div class="card h-100 border-0 shadow-sm overflow-hidden">
                        <img src="{{ asset($cocina->imagen_principal) }}" class="card-img-top" alt="{{ $cocina->nombre }}" style="height: 180px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h6 class="mb-0 item-nombre fw-bold text-dark">{{ $cocina->nombre }}</h6>
                                @if($cocina->abierto_24h)
                                    <span class="badge bg-success ms-1 px-1 py-1" style="font-size:0.65rem;"><i class="fas fa-clock me-1"></i>24 Hrs</span>
                                @endif
                            </div>
                            <p class="mb-2 text-muted" style="font-size: 0.8rem;">
                                <span class="badge bg-secondary me-1 item-categoria">{{ $cocina->categoria }}</span>
                                <i class="fas fa-map-marker-alt ms-1 text-danger"></i> {{ $cocina->zona }}
                            </p>
                            <p class="card-text text-secondary mt-1 mb-2" style="font-size: 0.85rem;">
                                {{ \Illuminate\Support\Str::limit($cocina->descripcion, 60) }} <br>
                                <span class="text-success small fw-bold mt-1 d-block">
                                    Precio prom. ${{ round($cocina->platos_avg_precio ?? 0) }}
                                </span>
                            </p>
                            <div class="mb-3 text-warning mt-auto" style="font-size: 0.85rem;">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= floor($cocina->calificacion))
                                        <i class="fas fa-star"></i>
                                    @elseif($i - 0.5 == $cocina->calificacion)
                                        <i class="fas fa-star-half-alt"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                                <span class="text-dark ms-1 fw-bold">({{ $cocina->calificacion }})</span>
                            </div>
                            <div>
                                <a href="{{ route('cocina.perfil', $cocina->slug) }}" class="btn text-white w-100 fw-bold btn-sm" style="background-color: #E67E22;">
                                    <i class="fas fa-utensils me-1"></i> Menú
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const inputBusqueda = document.getElementById('input-busqueda');
        const tipoBusqueda = document.getElementById('tipo-busqueda');
        const rangoPrecio = document.getElementById('rango-precio');
        const valorPrecio = document.getElementById('valor-precio');
        const selectZona = document.getElementById('select-zona');
        const selectCalif = document.getElementById('select-calificacion');
        const mensajeNoResultados = document.getElementById('mensaje-no-resultados');
        const tarjetas = document.querySelectorAll('.tarjeta-filtro');
        const secciones = document.querySelectorAll('.categoria-seccion');
        
        rangoPrecio.addEventListener('input', function() {
            valorPrecio.textContent = this.value;
            aplicarFiltros();
        });

        function aplicarFiltros() {
            const texto = inputBusqueda.value.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "");
            const tipo = tipoBusqueda.value;
            const maxPrecio = parseFloat(rangoPrecio.value);
            const zona = selectZona.value;
            const califMin = parseFloat(selectCalif.value);
            
            let coincidencias = 0;

            tarjetas.forEach(tarjeta => {
                const txtNombre = tarjeta.querySelector('.item-nombre').textContent.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "");
                const txtCat = tarjeta.querySelector('.item-categoria').textContent.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "");
                
                const valPrecio = parseFloat(tarjeta.getAttribute('data-precio'));
                const valZona = tarjeta.getAttribute('data-zona');
                const valCalif = parseFloat(tarjeta.getAttribute('data-calif'));

                let pasaTexto = false;
                if (tipo === 'todos') pasaTexto = txtNombre.includes(texto) || txtCat.includes(texto);
                else if (tipo === 'nombre') pasaTexto = txtNombre.includes(texto);
                else if (tipo === 'categoria') pasaTexto = txtCat.includes(texto);

                let pasaPrecio = valPrecio <= maxPrecio;
                let pasaZona = (zona === 'todas' || valZona === zona);
                let pasaCalif = valCalif >= califMin;

                if (pasaTexto && pasaPrecio && pasaZona && pasaCalif) {
                    tarjeta.style.display = 'block';
                    coincidencias++;
                } else {
                    tarjeta.style.display = 'none';
                }
            });

            // Ocultar título de categoría entera si todas sus tarjetas desaparecen
            secciones.forEach(seccion => {
                const visibles = Array.from(seccion.querySelectorAll('.tarjeta-filtro')).filter(t => t.style.display !== 'none').length;
                seccion.style.display = (visibles === 0) ? 'none' : 'block';
            });

            mensajeNoResultados.style.display = (coincidencias === 0) ? 'block' : 'none';
        }

        inputBusqueda.addEventListener('input', aplicarFiltros);
        tipoBusqueda.addEventListener('change', aplicarFiltros);
        selectZona.addEventListener('change', aplicarFiltros);
        selectCalif.addEventListener('change', aplicarFiltros);

        const parametrosURL = new URLSearchParams(window.location.search);
        const urlBusqueda = parametrosURL.get('q');
        const urlZona = parametrosURL.get('z');
        
        let requiereFiltroInicial = false;

        // Si vino texto en la URL, lo ponemos en el input
        if (urlBusqueda) {
            inputBusqueda.value = urlBusqueda;
            requiereFiltroInicial = true;
        }
        
        // Si vino una zona en la URL, buscamos qué opción coincide y la seleccionamos
        if (urlZona) {
            for (let i = 0; i < selectZona.options.length; i++) {
                if (selectZona.options[i].value.toLowerCase().includes(urlZona.toLowerCase())) {
                    selectZona.selectedIndex = i;
                    requiereFiltroInicial = true;
                    break;
                }
            }
        }
        
        // Si detectamos parámetros, ejecutamos el filtro que ya tenías programado
        if (requiereFiltroInicial) {
            aplicarFiltros();
        }
    });

    
</script>
@endsection