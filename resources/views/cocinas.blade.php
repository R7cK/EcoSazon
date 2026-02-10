@extends('layouts.app')

@section('titulopagina', 'Nuestras Cocinas - EcoSazón')
@section('titulo', 'Explora las Cocinas de Mérida')
@section('subtitulo', 'Desde el sabor tradicional hasta opciones dietéticas especializadas.')

@section('content')
<div class="container my-5">
    @foreach($categorias as $titulo => $lista)
    <div class="mb-5">
        <h3 class="fw-bold mb-4" style="color: #E67E22; border-left: 5px solid var(--amarillo); padding-left: 15px;">
            {{ $titulo }}
        </h3>
        <div class="row g-3">
            @foreach($lista as $cocina)
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <div class="bg-light rounded-circle p-3 me-3 text-success">
                            <i class="fas fa-store fa-2x"></i>
                        </div>
                        <div>
                            <h5 class="mb-1">{{ $cocina['nombre'] }}</h5>
                            <p class="mb-0 text-muted small">
                                <i class="fas fa-map-marker-alt"></i> {{ $cocina['zona'] }} | 
                                <strong>{{ $cocina['especialidad'] }}</strong>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endforeach
</div>
@endsection