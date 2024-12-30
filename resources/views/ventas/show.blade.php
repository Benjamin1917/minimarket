@extends ('layouts/master')

@section ('contenido-principal')
<div class="container">
    <h2>Detalles de la Venta</h2>

    <div class="card mt-4">
        <div class="card-header">
            Información de la Venta
        </div>
        <div class="card-body">
            <p><strong>ID Venta:</strong> {{ $venta->id_venta }}</p>
            <p><strong>RUT Usuario:</strong> {{ $venta->rut_usuario }}</p>
            <p><strong>Medio de Pago:</strong> {{ $venta->medio_pago }}</p>
            <p><strong>Fecha de la Venta:</strong> {{ $venta->fecha_venta }}</p>
            <p><strong>Total Venta:</strong> ${{ number_format($venta->total_venta, 0, ',', '.') }}</p>
        </div>
    </div>

    <h3 class="mt-4">Productos Vendidos</h3>

    @if ($detallesVenta->isEmpty())
        <div class="alert alert-warning mt-3">
            No hay productos en esta venta, posiblemente fueron eliminados.
        </div>
    @else
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>ID Producto</th>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($detallesVenta as $detalle)
                <tr>
                    <td>{{ $detalle->id_producto }}</td>
                    <td>{{ $detalle->producto->nombre_producto }}</td>
                    <td>{{ $detalle->cantidad }}</td>
                    <td>${{ number_format($detalle->precio_unitario, 0, ',', '.') }}</td>
                    <td>${{ number_format($detalle->total, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4" class="text-end">Total:</th>
                    <th>${{ number_format($venta->total_venta, 0, ',', '.') }}</th>
                </tr>
            </tfoot>
        </table>
    @endif

    <a href="{{ route('ventas.index') }}" class="btn btn-secondary mt-4">Volver</a>
</div>
@endsection
