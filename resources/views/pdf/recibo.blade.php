<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Recibo EcoSazón</title>
    <style>
        body { font-family: sans-serif; color: #333; font-size: 14px; }
        .header { text-align: center; border-bottom: 2px solid #27AE60; padding-bottom: 10px; margin-bottom: 20px; }
        .details table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .details th, .details td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        .details th { background-color: #f2f2f2; }
        .totals { text-align: right; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <h1 style="color: #27AE60; margin:0;">EcoSazón</h1>
        <p>Recibo de Compra #{{ str_pad($pedido->id, 5, '0', STR_PAD_LEFT) }}</p>
        <p>Fecha de emisión: {{ $pedido->created_at->format('d/m/Y H:i') }}</p>
    </div>

    <p><strong>Comprador:</strong> {{ $pedido->email_contacto }}</p>

    <div class="details">
        <table>
            <tr>
                <th>Platillo (Cocina)</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
            @foreach($pedido->detalles as $detalle)
            <tr>
                <td>{{ $detalle->plato_nombre }} <br><small>{{ $detalle->cocina_nombre }}</small></td>
                <td style="text-align: center;">{{ $detalle->cantidad }}</td>
                <td>${{ number_format($detalle->precio_unitario, 2) }}</td>
                <td>${{ number_format($detalle->subtotal, 2) }}</td>
            </tr>
            @endforeach
        </table>
    </div>

    <div class="totals">
        <p><strong>Subtotal:</strong> ${{ number_format($pedido->subtotal, 2) }}</p>
        <p><strong>IVA (16%):</strong> ${{ number_format($pedido->iva, 2) }}</p>
        <h3 style="color: #27AE60;">Total Pagado: ${{ number_format($pedido->total, 2) }}</h3>
    </div>
</body>
</html>