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
    .price-tag { color: var(--verde); font-weight: bold; font-size: 1.2rem; }
    .section-title { color: #E67E22; border-bottom: 2px solid #F1C40F; display: inline-block; }
</style>

<div class="container my-5">
    <div class="text-center mb-5">
        <h2 class="section-title pb-2">Menús Disponibles en tu Zona</h2>
        <p class="colorblanco">Mostrando opciones en Mérida, Yucatán con entrega en Logística Verde 🚲</p>
    </div>

    <div class="row g-4">
        @foreach($cocinas as $cocina)
        <div class="col-md-4">
            <div class="card h-100 card-cocina">
                <img src="{{ asset($cocina['imagen']) }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="{{ $cocina['nombre'] }}">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="badge badge-calif"><i class="fas fa-star"></i> {{ $cocina['calificacion'] }}</span>
                        <span class="colorblanco small"><i class="fas fa-bicycle"></i> $15 - $30 MXN</span>
                    </div>
                    <h5 class="card-title fw-bold">{{ $cocina['nombre'] }}</h5>
                    <p class="text-primary mb-1"><i class="fas fa-utensils me-1"></i> {{ $cocina['menu_dia'] }}</p>
                    <p class="card-text small colorblanco">{{ $cocina['descripcion'] }}</p>
                    
                    <div class="mt-3 p-2 bg-light rounded">
                        <label class="form-label small fw-bold">Personaliza tu ración</label>
                        <select class="form-select form-select-sm" onchange="updatePrice(this, {{ $cocina['precio_completo'] }})">
                            <option value="1">Ración Completa - ${{ number_format($cocina['precio_completo'], 2) }}</option>
                            <option value="0.6">Media Ración - ${{ number_format($cocina['precio_completo'] * 0.6, 2) }}</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer bg-white border-0 d-flex justify-content-between align-items-center pb-3">
                    <span class="price-tag">$<span class="val">{{ number_format($cocina['precio_completo'], 2) }}</span></span>
                    <button class="btn btn-order btn-sm px-4 shadow-sm" onclick="alert('Pedido agregado al carrito')">Pedir Ahora</button>
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