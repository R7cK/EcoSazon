@extends('layouts.app')
 
@section('titulopagina', 'Empresa E-Commerce')
 
@push('css')
    <style>
        .fondo {
            background: #302886;
        }
 
        .img-responsive {
            width: 100%;
            height: 100%;
        }
    </style>
@endpush
 
@section('titulo')
    EcoSazón
@endsection
 
@section('subtitulo')
 Sabor Local a Domicilio
@endsection
 
@section( "link1", 'Active')
@section( "titulo1")
<h1>About Me</h1>
@endsection
@section("descripcion_about")
{{ $descripcion_about }}
@endsection
@section("Autor")
{{ $nombre }}
@endsection
@section("actividad",$actividad)
@section("texto_ejemplo")
  {{ $texto_ejemplo }}
@endsection
 
@section("contenido_listado")
  <h2>Listado de Usuarios Registrados</h2>
 
@endsection
@section('content')
<div class="container my-5 text-center">
    <x-search-location />

    <div class="mt-5">
        <h3 class="fw-bold">Nuestros pilares en Mérida</h3>
        <div class="row mt-4">
            <div class="col-md-4">
                <i class="fas fa-leaf text-success fa-2x mb-2"></i>
                <h5>Logística Verde</h5>
                <p class="small text-muted">Entregas en bicicleta reduciendo la huella de carbono.</p>
            </div>
            </div>
    </div>
</div>
@endsection
