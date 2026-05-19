@extends('layouts.app')

@section('content')
<div class="container my-5 text-center">
    <div class="card shadow-lg border-0 rounded-4 p-5 mx-auto" style="max-width: 600px;">
        <i class="fas fa-check-circle text-success mb-3" style="font-size: 5rem;"></i>
        <h2 class="fw-bold text-dark">¡Pago Exitoso!</h2>
        <p class="text-muted fs-5">Tu orden #{{ str_pad($pedido->id, 5, '0', STR_PAD_LEFT) }} ha sido confirmada.</p>
        
        <div class="bg-light rounded-3 p-4 text-start my-4">
            <p class="mb-1"><strong>Enviado a:</strong> {{ $pedido->email_contacto }}</p>
            <p class="mb-1"><strong>Subtotal:</strong> ${{ number_format($pedido->subtotal, 2) }}</p>
            <p class="mb-1"><strong>IVA (16%):</strong> ${{ number_format($pedido->iva, 2) }}</p>
            <h4 class="fw-bold mt-2 text-success">Total pagado: ${{ number_format($pedido->total, 2) }}</h4>
        </div>

        <div class="d-flex gap-3 justify-content-center">
            <a href="{{ route('cart.recibo.pdf', $pedido->id) }}" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">
                <i class="fas fa-file-pdf me-2"></i> Descargar Recibo PDF
            </a>
            <a href="{{ route('home') }}" class="btn btn-outline-secondary rounded-pill px-4 fw-bold shadow-sm">
                Volver al Inicio
            </a>
        </div>
    </div>
</div>
@endsection