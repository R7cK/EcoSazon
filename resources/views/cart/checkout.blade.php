@extends('layouts.app')

@section('titulopagina', 'Proceder al Pago - EcoSazón')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-11">
            
            <div class="border-bottom pb-3 mb-4">
                <h2 class="fw-bold text-dark mb-1"><i class="fas fa-credit-card me-2" style="color: var(--naranja);"></i>Finalizar Pedido</h2>
                <p class="text-muted small mb-0">Simula tu transacción bancaria de forma segura.</p>
                
                {{-- Cronómetro de cuenta regresiva de 5 minutos --}}
                <div class="alert alert-warning rounded-4 mb-4 shadow-sm d-flex align-items-center justify-content-between p-3 mt-3 animate__animated animate__fadeIn">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-clock fs-4 me-3 text-dark"></i>
                        <div>
                            <strong class="text-dark d-block">Tiempo límite de pago activo</strong>
                            <span class="text-muted small">Por seguridad, completa tu transacción antes de que el contador llegue a cero.</span>
                        </div>
                    </div>
                    <div class="bg-white border rounded-pill px-4 py-2 shadow-sm text-center">
                        <span id="countdown-timer" class="fs-4 fw-bold text-danger">05:00</span>
                    </div>
                </div>
            </div>

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show rounded-4 mb-4 shadow-sm" role="alert">
                    <i class="fas fa-times-circle me-2"></i><strong>Error en la transacción:</strong>
                    <ul class="mb-0 mt-1 small">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('cart.pagar') }}" method="POST">
                @csrf
                <div class="row g-4">
                    
                    <div class="col-md-5 order-md-2">
                        <div class="card border-0 shadow-sm rounded-4 p-4 bg-light">
                            <h5 class="fw-bold mb-3 text-dark">Tu Compra</h5>
                            <div class="mb-3" style="max-height: 240px; overflow-y: auto;">
                                @foreach($cart as $item)
                                    <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom border-white">
                                        <div>
                                            <span class="fw-bold small d-block text-dark">{{ $item['nombre'] }}</span>
                                            <small class="text-muted">Cantidad: {{ $item['cantidad'] }}</small>
                                        </div>
                                        <span class="fw-bold text-secondary small">${{ number_format($item['precio'] * $item['cantidad'], 2) }}</span>
                                    </div>
                                @endforeach
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-3 pt-2">
                                <span class="fs-5 fw-bold text-dark">Total a pagar:</span>
                                <span class="fs-4 fw-bold text-success">${{ number_format($total, 2) }} MXN</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-7 order-md-1">
                        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                            @guest
                            <div class="mb-4 bg-light rounded-4 p-3 border">
                                <label class="form-label fw-bold small text-dark"><i class="fas fa-envelope text-primary me-2"></i> Correo para Recibo</label>
                                <input type="email" name="email_invitado" class="form-control rounded-pill px-3" placeholder="tucorreo@ejemplo.com" required>
                            </div>
                            @endguest
                            <h5 class="fw-bold mb-4 text-dark">Método de Pago</h5>

                            {{-- Alternador de método --}}
                            <div class="row mb-4">
                                <div class="col-6">
                                    <input type="radio" class="btn-check" name="metodo_tarjeta" id="metodo_guardada" value="guardada" {{ old('metodo_tarjeta', $tarjetasGuardadas->count() > 0 ? 'guardada' : 'nueva') === 'guardada' ? 'checked' : '' }} {{ $tarjetasGuardadas->count() === 0 ? 'disabled' : '' }} onchange="switchMetodoPago('guardada')">
                                    <label class="btn btn-outline-secondary w-100 rounded-pill py-2 text-center" for="metodo_guardada">
                                        <i class="fas fa-vault me-1"></i> Tarjetas Guardadas ({{ $tarjetasGuardadas->count() }})
                                    </label>
                                </div>
                                <div class="col-6">
                                    <input type="radio" class="btn-check" name="metodo_tarjeta" id="metodo_nueva" value="nueva" {{ old('metodo_tarjeta', $tarjetasGuardadas->count() === 0 ? 'nueva' : '') === 'nueva' ? 'checked' : '' }} onchange="switchMetodoPago('nueva')">
                                    <label class="btn btn-outline-secondary w-100 rounded-pill py-2 text-center" for="metodo_nueva">
                                        <i class="fas fa-plus me-1"></i> Nueva Tarjeta
                                    </label>
                                </div>
                            </div>

                            {{-- SECCIÓN A: SELECCIONAR TARJETA GUARDADA --}}
                            <div id="seccion_tarjeta_guardada" class="{{ old('metodo_tarjeta', $tarjetasGuardadas->count() > 0 ? 'guardada' : 'nueva') === 'guardada' ? '' : 'd-none' }} mb-3">
                                <label class="form-label fw-bold small text-secondary">Selecciona una de tus tarjetas:</label>
                                <select name="tarjeta_id" id="select_tarjeta_guardada" class="form-select rounded-pill px-3">
                                    @foreach($tarjetasGuardadas as $tj)
                                        <option value="{{ $tj->id }}">
                                            💳 **** **** **** {{ substr($tj->numero_tarjeta, -4) }} | {{ $tj->nombre_titular }} (Saldo Sim: ${{ number_format($tj->balance_simulado, 2) }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- SECCIÓN B: COMPLETAR FORMULARIO DE NUEVA TARJETA --}}
                            <div id="seccion_tarjeta_nueva" class="{{ old('metodo_tarjeta', $tarjetasGuardadas->count() > 0 ? 'guardada' : 'nueva') === 'nueva' ? '' : 'd-none' }}">
                                <div class="mb-3">
                                    <label class="form-label fw-bold small">Nombre del Titular</label>
                                    <input type="text" name="nombre_titular" id="input_nombre" class="form-control rounded-pill px-3" placeholder="Ej. Juan Pérez" value="{{ old('nombre_titular') }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold small">Número de Tarjeta</label>
                                    <input type="text" name="numero_tarjeta" id="input_numero" class="form-control rounded-pill px-3" placeholder="16 dígitos continuos" maxlength="16" value="{{ old('numero_tarjeta') }}">
                                </div>
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="form-label fw-bold small">Mes de Vencimiento</label>
                                        <input type="text" name="mes_expiracion" id="input_mes" class="form-control rounded-pill px-3" placeholder="MM" maxlength="2" value="{{ old('mes_expiracion') }}">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label fw-bold small">Año de Vencimiento</label>
                                        <input type="text" name="ano_expiracion" id="input_ano" class="form-control rounded-pill px-3" placeholder="AAAA" maxlength="4" value="{{ old('ano_expiracion') }}">
                                    </div>
                                </div>
                                
                                {{-- SECCIÓN DINÁMICA: Mostrar opción de guardar solo a usuarios registrados --}}
                                @auth
                                    <div class="form-check form-switch p-3 bg-light rounded-4 border mb-4 mt-2">
                                        <input class="form-check-input ms-0 me-2" type="checkbox" name="guardar_tarjeta" id="guardar_tarjeta" value="1" checked>
                                        <label class="form-check-label fw-bold small text-secondary" for="guardar_tarjeta">Guardar esta tarjeta de forma segura en mi cuenta (No guardará el CVV)</label>
                                    </div>
                                @else
                                    <div class="alert alert-info py-2 px-3 small mt-2 mb-4 rounded-3 border-0 bg-light text-muted">
                                        <i class="fas fa-info-circle me-1 text-primary"></i> <a href="{{ route('login') }}" class="fw-bold text-primary text-decoration-none">Inicia sesión</a> para guardar tus tarjetas y agilizar tus futuras compras.
                                    </div>
                                @endauth
                            </div>

                            {{-- EL CVV SIEMPRE SE SOLICITA POR SEGURIDAD --}}
                            <div class="mb-4 pt-3 border-top">
                                <div class="row align-items-center">
                                    <div class="col-sm-6">
                                        <label for="cvv" class="form-label fw-bold small text-danger"><i class="fas fa-shield-alt me-1"></i> Código de Seguridad (CVV)</label>
                                        <input type="password" name="cvv" id="cvv" class="form-control rounded-pill px-3" placeholder="3 o 4 dígitos detrás de la tarjeta" maxlength="4" required>
                                    </div>
                                    <div class="col-sm-6 mt-2 mt-sm-0">
                                        <small class="text-muted d-block lh-sm p-2 bg-light rounded-3 border">
                                            <i class="fas fa-info-circle me-1 text-primary"></i> <strong>Aviso de Privacidad:</strong> El CVV es requerido únicamente para autorizar este cobro y jamás se guardará en nuestros servidores.
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-success rounded-pill w-100 py-2.5 fw-bold shadow-sm">
                                    <i class="fas fa-lock me-2"></i>Autorizar Pago Simulado
                                </button>
                            </div>

                        </div>
                    </div>

                </div>
            </form>

        </div>
    </div>
</div>

<script>
// Manejador para alternar la visibilidad y requerimiento de los campos de pago
function switchMetodoPago(tipo) {
    const seccionGuardada = document.getElementById('seccion_tarjeta_guardada');
    const seccionNueva = document.getElementById('seccion_tarjeta_nueva');
    
    // Obtenemos los campos
    const selectTarjeta = document.getElementById('select_tarjeta_guardada');
    const inputNombre = document.getElementById('input_nombre');
    const inputNumero = document.getElementById('input_numero');
    const inputMes = document.getElementById('input_mes');
    const inputAno = document.getElementById('input_ano');

    if (tipo === 'guardada') {
        seccionGuardada.classList.remove('d-none');
        seccionNueva.classList.add('d-none');
        
        // Habilitamos la selección guardada
        if (selectTarjeta) selectTarjeta.disabled = false;
        
        // Deshabilitamos los campos de nueva tarjeta
        inputNombre.required = false; inputNombre.disabled = true;
        inputNumero.required = false; inputNumero.disabled = true;
        inputMes.required = false; inputMes.disabled = true;
        inputAno.required = false; inputAno.disabled = true;
    } else {
        seccionGuardada.classList.add('d-none');
        seccionNueva.classList.remove('d-none');
        
        // Deshabilitamos la selección guardada
        if (selectTarjeta) selectTarjeta.disabled = true;
        
        // Volvemos a habilitar los campos de nueva tarjeta
        inputNombre.required = true; inputNombre.disabled = false;
        inputNumero.required = true; inputNumero.disabled = false;
        inputMes.required = true; inputMes.disabled = false;
        inputAno.required = true; inputAno.disabled = false;
    }
}

// Controlador del Temporizador en Cuenta Regresiva (5 Minutos)
document.addEventListener('DOMContentLoaded', function () {
    const radioGuardada = document.getElementById('metodo_guardada');
    if (radioGuardada && radioGuardada.checked) {
        switchMetodoPago('guardada');
    } else {
        switchMetodoPago('nueva');
    }

    let totalTime = 300; 
    const timerElement = document.getElementById('countdown-timer');

    const countdown = setInterval(function () {
        let minutes = Math.floor(totalTime / 60);
        let seconds = totalTime % 60;

        minutes = minutes < 10 ? '0' + minutes : minutes;
        seconds = seconds < 10 ? '0' + seconds : seconds;

        timerElement.textContent = minutes + ':' + seconds;

        if (totalTime <= 0) {
            clearInterval(countdown);
            alert('El tiempo de 5 minutos para realizar tu pago simulado ha expirado. Serás redirigido a tu carrito.');
            window.location.href = "{{ route('cart.index') }}";
        }
        
        totalTime--;
    }, 1000);
});
</script>
@endsection