<div class="search-container bg-white p-2 rounded-pill shadow-lg d-flex align-items-center mt-4 mx-auto" style="max-width: 700px;">
    <div class="flex-grow-1 border-end px-3 d-flex align-items-center">
        <i class="fas fa-map-marker-alt text-danger me-2"></i>
        <select class="form-select border-0 shadow-none bg-transparent py-2" style="cursor: pointer;">
            <option selected disabled>¿En qué zona estás?</option>
            <optgroup label="Mérida (Zonas principales)">
                <option>Centro Histórico</option>
                <option>Francisco de Montejo</option>
                <option>Altabrisa / Cholul</option>
                <option>García Ginerés</option>
                <option>Ciudad Caucel</option>
                <option>Las Américas</option>
            </optgroup>
            <optgroup label="Alrededores / Conurbada">
                <option>Kanasín</option>
                <option>Umán</option>
                <option>Conkal</option>
            </optgroup>
        </select>
    </div>

    <div class="flex-grow-1 px-3 d-flex align-items-center">
        <i class="fas fa-utensils text-success me-2"></i>
        <input type="text" class="form-control border-0 shadow-none py-2" placeholder="¿Qué quieres comer hoy? (Ej. Poc Chuc)">
    </div>

    <button class="btn btn-success rounded-pill px-4 py-2 fw-bold">
        <i class="fas fa-search me-1"></i> Buscar
    </button>
</div>

<style>
    .search-container { border: 1px solid #eee; }
    .search-container select:focus, .search-container input:focus { outline: none; }
    @media (max-width: 768px) {
        .search-container { flex-direction: column; border-radius: 20px !important; padding: 15px !important; }
        .search-container .border-end { border-end: none !important; border-bottom: 1px solid #eee; margin-bottom: 10px; width: 100%; }
        .search-container button { width: 100%; margin-top: 10px; }
    }
</style>