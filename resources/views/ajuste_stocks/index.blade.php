@extends ('layouts.master')

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

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-secondary {
        transition: background-color 0.3s ease;
    }

    .btn-secondary:hover {
        background-color: #6c757d;
    }

    table {
        margin-top: 20px;
    }

    th, td {
        text-align: center;
        vertical-align: middle;
    }

    .table thead {
        background-color: #007bff;
        color: white;
    }
</style>

<div class="container d-flex justify-content-center mt-5">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header text-center">
                <h3>Listado de Ajustes de Stock</h3>
            </div>

            <!-- Filtro de Búsqueda -->
            <div class="card-body p-4">
                <form method="GET" action="{{ route('ajustes.buscar_por_nombre_producto') }}">
                    <div class="row g-3 align-items-center justify-content-center">
                        <div class="col-md-8">
                            <input type="text" name="nombre_producto" class="form-control" placeholder="Buscar producto"
                                value="{{ request('nombre_producto') }}">
                        </div>
                        <div class="col-md-auto">
                            <button class="btn btn-primary" type="submit">Buscar</button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Tabla de Ajustes de Stock -->
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID Ajuste</th>
                            <th>Producto</th>
                            <th>RUT Usuario</th>
                            <th>Cantidad</th>
                            <th>Tipo de Ajuste</th>
                            <th>Motivo</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ajustes as $ajuste)
                            <tr>
                                <td>{{ $ajuste->id_ajuste }}</td>
                                <td>{{ $ajuste->producto->nombre_producto }}</td>
                                <td>{{ $ajuste->rut_usuario }}</td>
                                <td>{{ $ajuste->cantidad }}</td>
                                <td>{{ ucfirst($ajuste->tipo_ajuste) }}</td>
                                <td>{{ $ajuste->motivo }}</td>
                                <td>{{ $ajuste->fecha }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('ajuste_stocks.create') }}" class="btn btn-primary">Registrar Nuevo Ajuste</a>
                    <a href="{{ route('home.index') }}" class="btn btn-secondary">Volver</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
