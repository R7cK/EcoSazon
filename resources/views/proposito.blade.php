@extends('layouts.app')

@section('titulopagina', 'Nuestro Propósito - EcoSazón')
@section('titulo', 'Más que comida, un impacto local')
@section('subtitulo', 'Digitalizamos el ecosistema de las cocinas económicas en Mérida.')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-0 shadow-sm p-4 mb-5" style="border-radius: 20px; background: #f9f9f9;">
                <h2 class="text-center fw-bold mb-4" style="color: var(--verde);">¿Por qué existimos?</h2>
                <p class="lead text-center">
                    Nuestro objetivo es conectar hogares y oficinas con el sabor local, priorizando la personalización del menú, 
                    el apoyo al comercio de barrio y la movilidad urbana sostenible.
                </p>
            </div>

            <div class="row g-4 text-center">
                <div class="col-md-4">
                    <div class="p-3">
                        <div class="text-warning mb-3"><i class="fas fa-eye-slash fa-3x"></i></div>
                        <h5>Visibilidad Digital</h5>
                        <p class="small text-muted">Damos presencia en línea a cocinas que no tienen redes sociales.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3">
                        <div class="text-success mb-3"><i class="fas fa-bicycle fa-3x"></i></div>
                        <h5>Logística Verde</h5>
                        <p class="small text-muted">Entregas en vehículos eléctricos para cuidar el ambiente de Mérida.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3">
                        <div class="text-primary mb-3"><i class="fas fa-hand-holding-heart fa-3x"></i></div>
                        <h5>Comercio Justo</h5>
                        <p class="small text-muted">Comisiones bajas del 12% al 15% para apoyar a tu vecino.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection