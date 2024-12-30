@extends ('layouts/master')

@section ('contenido-principal')
<div class="container">
    <h2>Listado de Ventas</h2>

    {{-- Mensaje de éxito --}}
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    {{-- Filtro de Búsqueda por Fecha --}}
    <div class="card-body p-4">
        <form method="GET" action="{{ route('ventas.buscar_por_fecha') }}" class="mb-4">
            <div class="row g-3 align-items-center justify-content-center">
                <div class="col-md-8">
                    <input type="date" name="fecha_venta" class="form-control" placeholder="Buscar por fecha de venta"
                        value="{{ request('fecha_venta') }}">
                </div>
                <div class="col-md-auto">
                    <button class="btn btn-primary" type="submit">Buscar</button>
                </div>
            </div>
        </form>
    </div>

    {{-- Tabla de Ventas --}}
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID Venta</th>
                <th>RUT Usuario</th>
                <th>Total Venta</th>
                <th>Fecha Venta</th>
                <th>Medio de Pago</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ventas as $venta)
            <tr>
                <td>{{ $venta->id_venta }}</td>
                <td>{{ $venta->rut_usuario }}</td>
                <td>${{ number_format($venta->total_venta, 0, ',', '.') }}</td>
                <td>{{ $venta->fecha_venta }}</td>
                <td>{{ $venta->medio_pago }}</td>
                <td>
                    <a href="{{ route('ventas.detalle', $venta->id_venta) }}" class="btn btn-primary btn-sm">Ver Detalles</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
