<div style="font-family: Arial, sans-serif; padding: 20px; max-width: 600px; margin: auto; border: 1px solid #ddd; border-radius: 10px;">
    <h2 style="color: #27AE60; text-align: center;">¡Gracias por tu compra en EcoSazón!</h2>
    <p>Hola,</p>
    <p>Hemos recibido tu pedido <strong>#{{ str_pad($pedido->id, 5, '0', STR_PAD_LEFT) }}</strong> exitosamente. Aquí tienes el desglose:</p>
    
    <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
        <tr style="background-color: #f8f9fa;">
            <th style="padding: 10px; border: 1px solid #ddd; text-align: left;">Platillo</th>
            <th style="padding: 10px; border: 1px solid #ddd; text-align: center;">Cant.</th>
            <th style="padding: 10px; border: 1px solid #ddd; text-align: right;">Total</th>
        </tr>
        @foreach($pedido->detalles as $detalle)
        <tr>
            <td style="padding: 10px; border: 1px solid #ddd;">{{ $detalle->plato_nombre }} <br><small style="color: #777;">({{ $detalle->cocina_nombre }})</small></td>
            <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">{{ $detalle->cantidad }}</td>
            <td style="padding: 10px; border: 1px solid #ddd; text-align: right;">${{ number_format($detalle->subtotal, 2) }}</td>
        </tr>
        @endforeach
    </table>

    <div style="margin-top: 20px; text-align: right;">
        <p><strong>Subtotal:</strong> ${{ number_format($pedido->subtotal, 2) }}</p>
        <p><strong>IVA (16%):</strong> ${{ number_format($pedido->iva, 2) }}</p>
        <h3 style="color: #27AE60;">Total Pagado: ${{ number_format($pedido->total, 2) }}</h3>
    </div>
    
    <p style="text-align: center; margin-top: 30px; font-size: 12px; color: #aaa;">Comprobante automático. Por favor, no respondas a este correo.</p>
</div>