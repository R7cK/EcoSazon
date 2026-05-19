@extends('layouts.app')
@section('titulopagina', 'Mis Compras - EcoSazón')

@section('content')
<div class="container my-5">
    <h2 class="fw-bold mb-4 text-success"><i class="fas fa-shopping-bag me-2"></i>Historial de Compras</h2>
    
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="py-3 ps-4">Nº Pedido</th>
                            <th class="py-3">Fecha</th>
                            <th class="py-3">Total Pagado</th>
                            <th class="py-3 text-center">Recibo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pedidos as $pedido)
                        <tr>
                            <td class="ps-4 fw-bold">#{{ str_pad($pedido->id, 5, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $pedido->created_at->format('d/m/Y') }}</td>
                            <td class="fw-bold text-success">${{ number_format($pedido->total, 2) }}</td>
                            <td class="text-center">
                                <a href="{{ route('cart.recibo.pdf', $pedido->id) }}" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                    <i class="fas fa-file-pdf me-1"></i> Descargar
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">
                                <i class="fas fa-box-open fs-1 mb-3 d-block text-light"></i>
                                Aún no tienes compras registradas en tu historial.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection