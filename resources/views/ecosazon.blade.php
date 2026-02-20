@extends('layouts.app')

@section('titulopagina', 'Menú del Día - EcoSazón Mérida')

@section('titulo', 'Sabores de Mérida hoy')
@section('subtitulo', 'Digitalizamos las cocinas de barrio para llevar el sazón regional a tu mesa de forma sostenible.')

@section('Autor', 'Equipo EcoSazón')
@section('actividad', 'Propuesta de E-Commerce')

@section('content')
<style>
    .card-cocina {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        transition: transform 0.3s;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .card-cocina:hover { transform: translateY(-5px); }
    .badge-calif { background: var(--amarillo); color: #000; }
    .btn-order { background: var(--verde); color: white; border-radius: 20px; }
    .price-tag { color: var(--verde); font-weight: bold; font-size: 1.3rem; }
    .section-title { color: #E67E22; border-bottom: 2px solid #F1C40F; display: inline-block; }
    .roof-icon { margin-bottom: -10px; text-align: center; }
</style>

<div class="container my-5">
    <div class="text-center mb-5">
        <h2 class="section-title pb-2 fw-bold">Menús Disponibles en tu Zona</h2>
        <p class="text-muted fs-5">Mostrando opciones en Mérida, Yucatán con entrega en Logística Verde 🚲</p>
    </div>

    <div class="row g-4">
        @foreach($cocinas as $cocina)
        <div class="col-md-4">
            <div class="card h-100 card-cocina position-relative">
                
                {{-- Fondo/Platillo --}}
                <div class="position-relative">
                    <img src="{{ asset($cocina['imagen']) }}" class="card-img-top" style="height: 220px; object-fit: cover;" alt="{{ $cocina['nombre'] }}">
                    
                    {{-- Espacio para imagen de la fachada --}}
                    <div class="position-absolute shadow-sm border border-3 border-white bg-light" 
                         style="bottom: -35px; left: 20px; width: 80px; height: 80px; border-radius: 50%; overflow: hidden; z-index: 2;">
                        <img src="https://via.placeholder.com/80?text=Fachada" class="w-100 h-100" style="object-fit: cover;" alt="Fachada de la cocina">
                    </div>
                </div>

                <div class="card-body pt-5">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="badge badge-calif ms-auto fs-6"><i class="fas fa-star text-dark"></i> {{ $cocina['calificacion'] }}</span>
                    </div>

                    {{-- Techo sobre el nombre --}}
                    <div class="roof-icon">
                        <svg width="45" height="18" viewBox="0 0 40 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 13 L20 2 L38 13" stroke="#27AE60" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>

                    <h4 class="card-title fw-bold text-center mb-3">{{ $cocina['nombre'] }}</h4>
                    
                    <p class="text-primary mb-2 fs-5"><i class="fas fa-utensils me-1"></i> {{ $cocina['menu_dia'] }}</p>
                    <p class="card-text text-muted">{{ $cocina['descripcion'] }}</p>
                    
                    <div class="mt-4 p-3 bg-light rounded">
                        <label class="form-label fw-bold">Personaliza tu ración</label>
                        <select class="form-select" onchange="updatePrice(this, {{ $cocina['precio_completo'] }})">
                            <option value="1">Ración Completa - ${{ number_format($cocina['precio_completo'], 2) }}</option>
                            <option value="0.6">Media Ración - ${{ number_format($cocina['precio_completo'] * 0.6, 2) }}</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer bg-white border-0 d-flex justify-content-between align-items-center pb-4 px-4">
                    <span class="price-tag">$<span class="val">{{ number_format($cocina['precio_completo'], 2) }}</span></span>
                    <button class="btn btn-order px-4 shadow-sm fs-5" onclick="alert('Pedido agregado al carrito')">Pedir Ahora</button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script>
    function updatePrice(select, basePrice) {
        const factor = parseFloat(select.value);
        const priceDisplay = select.closest('.card-body').nextElementSibling.querySelector('.val');
        const newPrice = (basePrice * factor).toFixed(2);
        priceDisplay.innerText = newPrice;
    }
</script>
@endsection