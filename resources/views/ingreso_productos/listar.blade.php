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

    th,
    td {
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
                <h3>Listado de Ingresos de Productos</h3>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('ingresos.buscar_por_nombre_producto') }}" class="mb-4">
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

                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID Ingreso</th>
                            <th>Proveedor</th>
                            <th>Producto</th>
                            <th>Rut Usuario</th>
                            <th>Fecha Ingreso</th>
                            <th>Cantidad Ingresada</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ingresos as $ingreso)
                            <tr>
                                <td>{{ $ingreso->id_ingreso }}</td>
                                <td>{{ $ingreso->proveedor->nom_proveedor }}</td>
                                <td>{{ $ingreso->producto->nombre_producto }}</td>
                                <td>{{ $ingreso->rut_usuario }}</td>
                                <td>{{ $ingreso->fecha_ingreso }}</td>
                                <td>{{ $ingreso->cantidad_ingresada }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('productos.gestionar_productos') }}" class="btn btn-secondary">Volver</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
