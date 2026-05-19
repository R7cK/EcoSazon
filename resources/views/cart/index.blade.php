@extends('layouts.app')

@section('titulopagina', 'Mi Carrito de Compras - EcoSazón')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            
            <div class="border-bottom pb-3 mb-4">
                <h2 class="fw-bold text-dark mb-1"><i class="fas fa-shopping-cart me-2" style="color: var(--naranja);"></i>Mi Carrito</h2>
                <p class="text-muted small mb-0">Revisa los platillos seleccionados antes de proceder con tu orden.</p>
            </div>

            {{-- Alertas de Notificación --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-4 mb-4 shadow-sm" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('cart') && count(session('cart')) > 0)
                {{-- CASO 1: EL CARRITO TIENE PLATILLOS --}}
                <div class="row g-4">
                    <div class="col-md-8">
                        <div class="card border-0 shadow-sm rounded-4 p-3">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="text-muted small uppercase border-0">
                                        <tr>
                                            <th>Platillo</th>
                                            <th>Precio</th>
                                            <th>Cantidad</th>
                                            <th>Subtotal</th>
                                            <th class="text-end">Quitar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(session('cart') as $id => $details)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="rounded-3 bg-light me-3 overflow-hidden shadow-sm border" style="width: 55px; height: 55px; min-width: 55px;">
                                                            @php
                                                                $imgUrl = asset('Imagenes/default-cocina.png');
                                                                if (isset($details['imagen']) && $details['imagen']) {
                                                                    $imgUrl = Str::startsWith($details['imagen'], ['http://', 'https://', 'Imagenes/']) ? asset($details['imagen']) : asset('storage/' . $details['imagen']);
                                                                }
                                                            @endphp
                                                            <img src="{{ $imgUrl }}" alt="{{ $details['nombre'] }}" class="w-100 h-100" style="object-fit: cover;">
                                                        </div>
                                                        <div>
                                                            <span class="fw-bold d-block text-dark mb-0">{{ $details['nombre'] }}</span>
                                                            <small class="text-muted"><i class="fas fa-store me-1 text-secondary"></i>{{ $details['cocina'] }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="fw-bold text-secondary">${{ number_format($details['precio'], 2) }}</td>
                                                <td>
                                                    <span class="badge bg-light text-dark border p-2 px-3 rounded-pill fw-bold">
                                                        {{ $details['cantidad'] }}
                                                    </span>
                                                </td>
                                                <td class="fw-bold text-success">${{ number_format($details['precio'] * $details['cantidad'], 2) }}</td>
                                                <td class="text-end">
                                                    <form action="{{ route('cart.remove', $id) }}" method="POST" class="m-0">
                                                        @csrf
                                                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-circle p-2 border-0">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm rounded-4 p-4 bg-light">
                            <h5 class="fw-bold text-dark mb-4">Resumen del Pedido</h5>
                            
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-secondary">Platillos distintos:</span>
                                <span class="fw-bold text-dark">{{ count(session('cart')) }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-4 pb-3 border-bottom">
                                <span class="text-secondary">Envío / Entrega:</span>
                                <span class="text-success fw-bold">Gratis</span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <span class="fs-5 fw-bold text-dark">Total a pagar:</span>
                                <span class="fs-4 fw-bold text-success">${{ number_format($total, 2) }}</span>
                            </div>

                            <div class="d-grid gap-2">
                                <a href="{{ route('cart.checkout') }}" class="btn btn-success rounded-pill py-2.5 fw-bold shadow-sm d-block text-center">
                                    Proceder al Pago <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                                <a href="{{ route('cocinas.index') }}" class="btn btn-outline-secondary rounded-pill py-2 btn-sm border-0">
                                    Seguir Agregando
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                {{-- CASO 2: EL CARRITO ESTÁ COMPLETAMENTE VACÍO --}}
                <div class="card border-0 shadow-sm rounded-4 p-5 text-center my-4 bg-white">
                    <div class="mb-4">
                        <span class="d-inline-flex p-4 rounded-circle bg-light border border-2 text-muted" style="font-size: 3rem;">
                            <i class="fas fa-shopping-basket"></i>
                        </span>
                    </div>
                    <h4 class="fw-bold text-dark mb-2">Tu carrito está vacío</h4>
                    <p class="text-muted mx-auto mb-4" style="max-width: 450px;">
                        Parece que aún no has añadido deliciosos platillos de nuestras cocinas económicas a tu pedido. ¡Echa un vistazo a lo que hay disponible cerca de ti!
                    </p>
                    <div>
                        <a href="{{ route('cocinas.index') }}" class="btn btn-success rounded-pill px-5 py-2.5 fw-bold shadow-sm">
                            <i class="fas fa-utensils me-2"></i>Ver Cocinas Económicas
                        </a>
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>
@endsection