@extends('layouts.app')

@section('titulopagina', 'Únete como Partner - EcoSazón')

@section('titulo', 'Haz crecer tu cocina con nosotros')
@section('subtitulo', 'Digitaliza tu sazón y llega a más hogares en Mérida con comisiones justas.')

@section('Autor', 'Equipo EcoSazón')
@section('actividad', 'Propuesta de E-Commerce')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-lg-6 mb-4">
            <h2 class="text-success fw-bold mb-4">¿Por qué ser Partner EcoSazón?</h2>
            
            <div class="d-flex mb-3">
                <div class="me-3 text-warning"><i class="fas fa-percentage fa-2x"></i></div>
                <div>
                    <h5>Comisiones del 12% al 15%</h5>
                    <p class="colorblanco">A diferencia de otras apps que cobran hasta el 30%, nosotros priorizamos el comercio de barrio.</p>
                </div>
            </div>

            <div class="d-flex mb-3">
                <div class="me-3 text-success"><i class="fas fa-leaf fa-2x"></i></div>
                <div>
                    <h5>Logística Verde</h5>
                    <p class="colorblanco">Tus entregas se realizan en bicicletas o vehículos eléctricos, optimizando rutas para Mérida.</p>
                </div>
            </div>

            <div class="d-flex mb-3">
                <div class="me-3 text-primary"><i class="fas fa-chart-line fa-2x"></i></div>
                <div>
                    <h5>Adiós a la Invisibilidad Digital</h5>
                    <p class="colorblanco">Te damos una vitrina en línea aunque no tengas redes sociales ni menús actualizados.</p>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card shadow border-0 p-4" style="border-radius: 20px;">
                <h4 class="text-center mb-4">Registro de Cocina</h4>
                <form action="#" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Nombre de la Cocina</label>
                        <input type="text" class="form-control" placeholder="Ej. El Sazón Yucateco" required>
                    </div>
                    
                    <div class="mb-3">
                       <label class="form-label">Clasificación de Cocina </label>
                        <select class="form-select">
                           <option value="barrio">Cocina de Barrio (Menú del día) </option>
                           <option value="especializada">Cocina Especializada (Dieta específica/Vegana) </option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ubicación en Mérida (Colonia)</label>
                        <input type="text" class="form-control" placeholder="Ej. Centro, Altabrisa, Francisco de Montejo" required>
                    </div>

                    <div class="mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="waste">
                            <label class="form-check-input-label small text-muted" for="waste">
                                Deseo participar en el programa de reducción de desperdicio (ventas en rebaja).
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success w-100 rounded-pill py-2">Solicitar Unión</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection