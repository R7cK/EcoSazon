<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Elige el plan ideal para ti</h2>
            <p class="text-muted">Ahorra en envíos y apoya al comercio local con EcoSazón Plus.</p>
        </div>

        <div class="row justify-content-center g-4">
            <div class="col-md-5">
                <div class="card h-100 border-0 shadow-sm text-center p-4" style="border-radius: 25px;">
                    <div class="card-body">
                        <h3 class="fw-bold mb-3">Usuario Casual</h3>
                        <div class="display-4 fw-bold mb-3" style="color: var(--verde);">$0 <small class="fs-6 text-muted">/mes</small></div>
                        <p class="text-muted mb-4">Ideal para pedidos ocasionales desde casa u oficina.</p>
                        
                        <ul class="list-unstyled text-start mb-5 ps-4">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Registro gratuito </li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Pago por menú + envío </li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Tarifa de envío: $15 - $30 MXN </li>
                            <li class="mb-2 text-muted"><i class="fas fa-times me-2"></i> Sin envíos gratis</li>
                        </ul>

                        <a href="{{ route('register') }}" class="btn btn-outline-success w-100 rounded-pill">Registrarse Gratis</a>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card h-100 border-0 shadow text-center p-4" style="border-radius: 25px; background: #fef9e7; border: 2px solid var(--amarillo) !important;">
                    <div class="card-body">
                        <div class="badge bg-warning text-dark mb-2 px-3 rounded-pill text-uppercase fw-bold">Recomendado</div>
                        <h3 class="fw-bold mb-3">EcoSazón Plus</h3>
                        <div class="display-4 fw-bold mb-3" style="color: #E67E22;">$99 <small class="fs-6 text-muted">MXN/mes</small> </div>
                        <p class="text-muted mb-4">Para quienes disfrutan del sazón tradicional todos los días.</p>
                        
                        <ul class="list-unstyled text-start mb-5 ps-4">
                            <li class="mb-2"><i class="fas fa-check text-warning me-2"></i> Envíos gratis en pedidos cercanos </li>
                            <li class="mb-2"><i class="fas fa-check text-warning me-2"></i> Prioridad en cenas especiales </li>
                            <li class="mb-2"><i class="fas fa-check text-warning me-2"></i> Descuentos exclusivos en "Media Ración"</li>
                            <li class="mb-2"><i class="fas fa-check text-warning me-2"></i> Acceso a preventas de menús regionales</li>
                        </ul>

                        <button class="btn btn-orange w-100 rounded-pill shadow" onclick="alert('Funcionalidad de pago próximamente')">Suscribirse Ahora</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>