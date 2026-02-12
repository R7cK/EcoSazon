<section class="py-5 bg-white">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="fw-bold text-dark">Cocinas que inspiran</h2>
            <p class="text-muted">Descubre el sazón que está conquistando Mérida hoy.</p>
        </div>

        <div id="carouselCocinas" class="carousel slide shadow rounded-4 overflow-hidden" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselCocinas" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselCocinas" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselCocinas" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            
            <div class="carousel-inner">
                {{-- Slide 1 --}}
                <div class="carousel-item active" style="height: 450px;">
                    {{-- Usamos una imagen de placeholder, puedes cambiar 'src' por tus imágenes reales --}}
                    <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=1000&auto=format&fit=crop" class="d-block w-100 h-100 object-fit-cover" alt="Cocina Doña Lety">
                    <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-75 rounded-3 p-4 mb-4">
                        <h3 class="fw-bold text-warning">La Cocina de Doña Lety</h3>
                        <p class="fs-5">Especialidad en cochinita pibil y antojitos yucatecos hechos a mano.</p>
                        <a href="{{ route('cocinas.index') }}" class="btn btn-success rounded-pill px-4 mt-2">Conocer más</a>
                    </div>
                </div>

                {{-- Slide 2 --}}
                <div class="carousel-item" style="height: 450px;">
                    <img src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?q=80&w=1000&auto=format&fit=crop" class="d-block w-100 h-100 object-fit-cover" alt="Sazón del Puerto">
                    <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-75 rounded-3 p-4 mb-4">
                        <h3 class="fw-bold text-warning">Sazón del Puerto</h3>
                        <p class="fs-5">Mariscos frescos y empanadas con la receta secreta de la abuela.</p>
                        <a href="{{ route('cocinas.index') }}" class="btn btn-success rounded-pill px-4 mt-2">Conocer más</a>
                    </div>
                </div>

                {{-- Slide 3 --}}
                <div class="carousel-item" style="height: 450px;">
                    <img src="https://images.unsplash.com/photo-1493770348161-369560ae357d?q=80&w=1000&auto=format&fit=crop" class="d-block w-100 h-100 object-fit-cover" alt="Veggie Maya">
                    <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-75 rounded-3 p-4 mb-4">
                        <h3 class="fw-bold text-warning">Veggie Maya</h3>
                        <p class="fs-5">Opciones saludables, veganas y deliciosas sin perder el toque regional.</p>
                        <a href="{{ route('cocinas.index') }}" class="btn btn-success rounded-pill px-4 mt-2">Conocer más</a>
                    </div>
                </div>
            </div>
            
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselCocinas" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselCocinas" data-bs-slide="next">
                <span class="carousel-control-next-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>
    </div>
</section>