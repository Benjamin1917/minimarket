@extends ('layouts/master')

@section ('contenido-principal')

<style>
    body {
        background-color: #f7f9fc;
    }
    .card {
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .card-header {
        background-color: #007bff;
        color: white;
        border-radius: 15px 15px 0 0;
    }
    .btn-secondary {
        transition: background-color 0.3s ease;
    }
    .btn-secondary:hover {
        background-color: #6c757d;
    }
    .summary {
        font-size: 1.2em;
        font-weight: bold;
        margin-top: 15px;
    }
</style>

<div class="container d-flex justify-content-center mt-5">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header text-center">
                <h3>Resumen diario</h3>
            </div>
            <div class="card-body p-4">
                {{-- Producto más vendido --}}
                <h5 class="text-center mb-4">Producto Más Vendido</h5>
                @if($productoMasVendido)
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">ID Producto</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Cantidad Vendida</th>
                                <th scope="col">Total Generado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $productoMasVendido->id_producto }}</td>
                                <td>{{ $productoMasVendido->producto->nombre_producto }}</td>
                                <td>{{ $productoMasVendido->cantidad_vendida }}</td>
                                <td>${{ number_format($productoMasVendido->total, 2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                @else
                    <p class="text-center text-muted">No se registraron ventas hoy.</p>
                @endif

                {{-- Productos con stock crítico --}}
                <h5 class="text-center mt-5">Productos con Stock Crítico</h5>
                @if(count($productosCriticos) > 0)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ID Producto</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($productosCriticos as $producto)
                                <tr>
                                    <td>{{ $producto->id_producto }}</td>
                                    <td>{{ $producto->nombre_producto }}</td>
                                    <td>{{ $producto->cantidad_stock }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-center text-muted">No hay productos con stock crítico.</p>
                @endif

                {{-- Resumen Total Ganado --}}
                <div class="summary text-center mt-5">
                    <p>Total:</p>
                    <p class="text-success display-6">${{ number_format($totalGanado, 2) }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
