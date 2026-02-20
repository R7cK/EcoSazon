<section class="py-5 bg-white">
    <div class="container-fluid px-lg-5"> <div class="text-center mb-5">
            <h2 class="fw-bold display-5 text-dark">Cocinas que inspiran</h2>
            <p class="lead text-muted fs-4">Descubre el sazón que está conquistando Mérida hoy.</p>
        </div>

        <div id="carouselCocinas" class="carousel slide shadow-lg rounded-4 overflow-hidden mx-auto" data-bs-ride="carousel" style="max-width: 1400px; height: 600px;">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselCocinas" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselCocinas" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselCocinas" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            
           <div class="carousel-inner h-100">
    {{-- Slide 1 --}}
    <div class="carousel-item active h-100">
        <img src="{{ asset('Imagenes/lety1.png') }}" class="d-block w-100 h-100 object-fit-cover" alt="Platillo Doña Lety">
        
        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-75 rounded-4 p-5 shadow-lg" 
             style="right: 5%; left: 5%; bottom: 5%; margin: 0 auto;">
            
            <div class="row align-items-center">
                <div class="col-lg-7 text-start pe-lg-5">
                    <h3 class="fw-bold text-warning display-5 mb-3">La Cocina de Doña Lety</h3>
                    <p class="fs-4 text-white mb-4" style="line-height: 1.5;">Especialidad en cochinita pibil y antojitos yucatecos hechos a mano con la receta tradicional.</p>
                    <a href="{{ route('cocinas.index') }}" class="btn btn-success rounded-pill px-5 py-3 fs-5 fw-bold shadow">
                        Conocer más
                    </a>
                </div>
                
                <div class="col-lg-5 mt-4 mt-lg-0">
                    <img src="{{ asset('Imagenes/lety2.png') }}" 
                         class="w-100 rounded-4 border border-3 border-warning shadow-lg" 
                         style="height: 250px; object-fit: cover;" 
                         alt="Fachada Doña Lety">
                </div>
            </div>
        </div>
    </div>

               {{-- Slide 2 --}}
<div class="carousel-item h-100">
    <img src="{{ asset('Imagenes/marisco2.png') }}" class="d-block w-100 h-100 object-fit-cover" alt="Platillo Sazón del Puerto">
    
    <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-75 rounded-4 p-5 shadow-lg" 
         style="right: 5%; left: 5%; bottom: 5%; margin: 0 auto;">
        
        <div class="row align-items-center">
            <div class="col-lg-7 text-start pe-lg-5">
                <h3 class="fw-bold text-warning display-5 mb-3">Sazón del Puerto</h3>
                <p class="fs-4 text-white mb-4" style="line-height: 1.5;">Mariscos frescos del día, ceviches y empanadas fritas al momento con la receta secreta.</p>
                <a href="{{ route('cocinas.index') }}" class="btn btn-success rounded-pill px-5 py-3 fs-5 fw-bold shadow">
                    Conocer más
                </a>
            </div>
            
            <div class="col-lg-5 mt-4 mt-lg-0">
                <img src="{{ asset('Imagenes/marisco1.png') }}" 
                     class="w-100 rounded-4 border border-3 border-warning shadow-lg" 
                     style="height: 250px; object-fit: cover;" 
                     alt="Fachada Sazón del Puerto">
            </div>
        </div>
    </div>
</div>
                {{-- Slide 3 --}}
                <div class="carousel-item h-100">
    <img src="{{ asset('Imagenes/Veggie1.png') }}" class="d-block w-100 h-100 object-fit-cover" alt="Fondo Platillo Veggie Maya">
    
    <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-75 rounded-4 p-5 shadow-lg" 
         style="right: 5%; left: 5%; bottom: 5%; margin: 0 auto;">
        
        <div class="row align-items-center">
            
            <div class="col-lg-7 text-start pe-lg-5">
                <h3 class="fw-bold text-warning display-5 mb-3">Veggie Maya</h3>
                <p class="fs-4 text-white mb-4" style="line-height: 1.5;">Opciones cien por ciento basadas en plantas y deliciosas sin perder el auténtico toque regional.</p>
                
                <a href="/tu-ruta-aqui" class="btn btn-success rounded-pill px-5 py-3 fs-5 fw-bold shadow">
                    Conocer más
                </a>
            </div>
            
            <div class="col-lg-5 mt-4 mt-lg-0">
                <img src="{{ asset('Imagenes/Veggie2.png') }}" 
                     class="w-100 rounded-4 border border-3 border-warning shadow-lg" 
                     style="height: 250px; object-fit: cover;" 
                     alt="Fachada Veggie Maya">
            </div>
            
        </div>
    </div>
</div>
            </div>
            
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselCocinas" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bg-dark rounded-circle p-4 shadow" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselCocinas" data-bs-slide="next">
                <span class="carousel-control-next-icon bg-dark rounded-circle p-4 shadow" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>
    </div>
</section>