@extends('layouts.app')
@section('titulopagina', 'Mis Compras - EcoSazón')

@section('content')
<div class="container my-5">
    <h2 class="fw-bold mb-4 text-success"><i class="fas fa-shopping-bag me-2"></i>Historial de Compras</h2>
    
    {{-- ALERTAS DE ÉXITO --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4 mb-4 shadow-sm" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            @forelse($pedidos as $pedido)
                <div class="card border border-2 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4 d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="fw-bold mb-0 text-secondary">Pedido #{{ str_pad($pedido->id, 5, '0', STR_PAD_LEFT) }}</h5>
                            <small class="text-muted">{{ $pedido->created_at->format('d/m/Y h:i A') }}</small>
                        </div>
                        <div class="text-end">
                            <span class="fw-bold fs-5 text-success d-block">${{ number_format($pedido->total, 2) }}</span>
                            <a href="{{ route('cart.recibo.pdf', $pedido->id) }}" class="btn btn-sm btn-outline-danger rounded-pill mt-1">
                                <i class="fas fa-file-pdf me-1"></i> Recibo
                            </a>
                        </div>
                    </div>
                    
                    <div class="card-body px-4 pt-3 pb-4">
                        <hr class="mt-0 mb-3 text-muted">
                        <h6 class="fw-bold small text-muted mb-3 text-uppercase">Detalle de Platillos</h6>
                        
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle mb-0">
                                <tbody>
                                    @foreach($pedido->detalles as $detalle)
                                        <tr class="border-bottom">
                                            <td class="ps-0">
                                                <span class="fw-bold d-block">{{ $detalle->plato_nombre }}</span>
                                                <small class="text-muted"><i class="fas fa-store me-1"></i>{{ $detalle->cocina_nombre }}</small>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-light text-dark border">{{ $detalle->cantidad }}x</span>
                                            </td>
                                            <td class="text-end fw-bold text-success">
                                                ${{ number_format($detalle->subtotal, 2) }}
                                            </td>
                                            <td class="text-end pe-0" style="width: 200px;">
                                                {{-- ESTATUS --}}
                                                @php $estado = strtolower($detalle->estatus ?? 'pendiente'); @endphp
                                                <span class="badge mb-2 d-inline-block w-100 py-2
                                                    {{ $estado == 'pendiente' ? 'bg-warning text-dark' : '' }}
                                                    {{ $estado == 'en entrega' ? 'bg-info text-dark' : '' }}
                                                    {{ $estado == 'entregado' ? 'bg-success' : '' }}
                                                    {{ $estado == 'cancelado' ? 'bg-danger' : '' }}">
                                                    {{ strtoupper($estado) }}
                                                </span>

                                                {{-- BOTÓN PARA CONFIRMAR RECEPCIÓN SI EL DUEÑO YA LO MANDÓ --}}
                                                @if($estado == 'en entrega')
                                                    <form action="{{ route('cliente.pedido.confirmar', $detalle->id) }}" method="POST" class="m-0">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-sm btn-success rounded-pill shadow-sm d-block w-100" onsubmit="return confirm('¿Confirmas que ya recibiste este platillo?');">
                                                            <i class="fas fa-check-circle me-1"></i> Recibí mi pedido
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-5 text-muted border border-2 border-dashed rounded-4">
                    <i class="fas fa-box-open fs-1 mb-3 d-block text-light"></i>
                    Aún no tienes compras registradas en tu historial.
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection