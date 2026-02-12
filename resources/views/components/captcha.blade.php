@props(['code'])
<div class="mb-4 p-3 bg-light rounded-4 border text-center">
    <label class="form-label d-block small fw-bold text-secondary">Verificación de Seguridad</label>
    <div class="d-flex justify-content-center align-items-center gap-3">
        <div class="bg-dark text-white px-3 py-1 rounded shadow-sm" 
             style="font-family: 'Courier New'; letter-spacing: 5px; font-style: italic; user-select: none; background: linear-gradient(45deg, #222, #444);">
            {{ $code }}
        </div>
        <input type="text" name="captcha" class="form-control form-control-sm rounded-pill text-center" style="width: 120px;" placeholder="Código" required>
    </div>
</div>