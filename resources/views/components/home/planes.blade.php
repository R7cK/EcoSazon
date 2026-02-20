<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold display-5">Elige el plan ideal para ti</h2>
            <p class="text-muted fs-4">Ahorra en envíos y apoya al comercio local con EcoSazón Plus.</p>
        </div>

        <div class="row justify-content-center g-4 align-items-stretch">
            
            {{-- TARJETA PLAN CASUAL (AHORA CON COLOR, BORDE Y ALINEACIÓN) --}}
            <div class="col-md-5">
                <div class="card h-100 shadow-sm text-center p-4" style="border-radius: 25px; background-color: #Eafaf1; border: 3px solid var(--verde) !important;">
                    <div class="card-body d-flex flex-column">
                        {{-- Espaciador invisible para alinear el título con la etiqueta "Recomendado" de la otra tarjeta --}}
                        <div class="mb-2 px-3 py-2" style="visibility: hidden;">Placeholder</div>
                        
                        <h3 class="fw-bold mb-3">Usuario Casual</h3>
                        <div class="display-4 fw-bold mb-3" style="color: var(--verde-oscuro);">$0 <small class="fs-5 text-muted">/mes</small></div>
                        <p class="text-muted mb-4 fs-5">Ideal para pedidos ocasionales desde casa u oficina.</p>
                        
                        {{-- El flex-grow-1 hace que esta lista ocupe el espacio sobrante --}}
                        <ul class="list-unstyled text-start mb-5 ps-4 fs-5 flex-grow-1">
                            <li class="mb-3"><i class="fas fa-check text-success me-2"></i> Registro gratuito </li>
                            <li class="mb-3"><i class="fas fa-check text-success me-2"></i> Pago por menú + envío </li>
                            <li class="mb-3"><i class="fas fa-check text-success me-2"></i> Tarifa de envío: $15 - $30 MXN </li>
                            <li class="mb-3 text-muted"><i class="fas fa-times me-2"></i> Sin envíos gratis</li>
                        </ul>

                        {{-- mt-auto empuja el botón al fondo --}}
                        <a href="{{ route('register') }}" class="btn btn-outline-success btn-lg w-100 rounded-pill fw-bold mt-auto bg-white">Registrarse Gratis</a>
                    </div>
                </div>
            </div>

            {{-- TARJETA PLAN PLUS --}}
            <div class="col-md-5">
                <div class="card h-100 shadow text-center p-4" style="border-radius: 25px; background: #fef9e7; border: 3px solid var(--amarillo) !important;">
                    <div class="card-body d-flex flex-column">
                        <div class="badge bg-warning text-dark mb-2 px-3 py-2 rounded-pill text-uppercase fw-bold">Recomendado</div>
                        
                        <h3 class="fw-bold mb-3">EcoSazón Plus</h3>
                        <div class="display-4 fw-bold mb-3" style="color: #E67E22;">$99 <small class="fs-5 text-muted">MXN/mes</small> </div>
                        <p class="text-muted mb-4 fs-5">Para quienes disfrutan del sazón tradicional todos los días.</p>
                        
                        {{-- El flex-grow-1 hace que esta lista ocupe el espacio sobrante --}}
                        <ul class="list-unstyled text-start mb-5 ps-4 fs-5 flex-grow-1">
                            <li class="mb-3"><i class="fas fa-check text-warning me-2"></i> Envíos gratis en pedidos cercanos </li>
                            <li class="mb-3"><i class="fas fa-check text-warning me-2"></i> Prioridad en cenas especiales </li>
                            <li class="mb-3"><i class="fas fa-check text-warning me-2"></i> Descuentos exclusivos en "Media Ración"</li>
                            <li class="mb-3"><i class="fas fa-check text-warning me-2"></i> Acceso a preventas de menús regionales</li>
                        </ul>

                        {{-- mt-auto empuja el botón al fondo --}}
                        <button class="btn btn-orange btn-lg w-100 rounded-pill shadow fw-bold mt-auto" onclick="alert('Funcionalidad de pago próximamente')">Suscribirse Ahora</button>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>