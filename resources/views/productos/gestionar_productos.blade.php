@extends('layouts/master')

@section('contenido-principal')
<style>
    .container {
        margin-top: 30px;
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .header-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .header-section h2 {
        color: #343a40;
        font-weight: bold;
    }

    .header-section .btn-primary {
        border-radius: 50px;
        padding: 10px 20px;
        font-weight: bold;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .product-table {
        margin-top: 20px;
    }

    .product-table table {
        width: 100%;
        border-collapse: collapse;
        background-color: #ffffff;
    }

    .product-table th,
    .product-table td {
        padding: 15px;
        text-align: left;
        border: 1px solid #dee2e6;
    }

    .product-table th {
        background-color: #495057;
        color: #ffffff;
    }

    .action-buttons button {
        margin-right: 5px;
    }

    .btn-edit {
        background-color: #ffc107;
        color: #ffffff;
    }

    .btn-delete {
        background-color: #dc3545;
        color: #ffffff;
    }

    .btn-edit:hover,
    .btn-delete:hover {
        opacity: 0.8;
    }
</style>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header-section">
            <h2>Gestión de Productos</h2>
            <div class="d-flex">
                <a href="{{ route('productos.ingresar_producto') }}" class="btn btn-primary me-2">Ingresar Producto</a>
                <a href="{{ route('ingreso_productos.formulario') }}" class="btn btn-primary me-2">Registar Ingreso</a>
                <a href="{{ route('ingreso_productos.listar') }}" class="btn btn-primary">Listado Ingresos</a>
            </div>
        </div>

        <!-- Formulario de Filtro -->
        <form method="GET" action="{{ route('productos.gestionar_productos') }}">
            <div class="d-flex">
                <!-- Filtro por Nombre de Producto -->
                <input type="text" name="nombre_producto" class="form-control me-3" placeholder="Buscar por nombre"
                    value="{{ request('nombre_producto') }}" onchange="this.form.submit()">

                <!-- Filtro por Categoría -->
                <select name="categoria_id" class="form-control me-3" onchange="this.form.submit()">
                    <option value="">Filtrar por Categoría</option>
                    @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id_categoria }}" {{ request('categoria_id')==$categoria->id_categoria
                        ? 'selected' : '' }}>
                        {{ $categoria->categoria }}
                    </option>
                    @endforeach
                </select>
                <!-- Filtro por Marca -->
                <select name="id_marca" class="form-control me-3" onchange="this.form.submit()">
                    <option value="">Filtrar por Marca</option>
                    @foreach ($marcas as $marca)
                    <option value="{{ $marca->id_marca }}" {{ request('id_marca')==$marca->id_marca ? 'selected' : ''
                        }}>
                        {{ $marca->nombre_marca }}
                    </option>
                    @endforeach
                </select>
            </div>
        </form>


        <!-- Tabla de Productos -->
        <div class="product-table">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($v_productos as $v_producto)
                    <tr>
                        <td>{{ $v_producto->id_producto }}</td>
                        <td>{{ $v_producto->nombre_producto }}</td>
                        <td>{{ $v_producto->precio_producto }}</td>
                        <td>
                            <!-- Modal para Eliminar Producto -->
                            <div class="modal fade" id="borrarModal{{$v_producto->id_producto}}" tabindex="-1"
                                aria-labelledby="borrarModalLabel{{$v_producto->id_producto}}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5"
                                                id="borrarModalLabel{{$v_producto->id_producto}}">Confirmación de
                                                borrado
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form method="POST"
                                            action="{{ route('productos.borrar_producto', $v_producto->id_producto) }}">
                                            @method('delete')
                                            @csrf
                                            <div class="modal-body">
                                                Se borraran todos los registros asociados de este producto, esto incluye a la venta y su total, ¿Está seguro que desea
                                                eliminar el producto <span class="text-primary fw-bold">{{
                                                    $v_producto->nombre_producto }}</span>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light"
                                                    data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-primary">Borrar Producto</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal para Ver Producto -->
                            <div class="modal fade" id="accesarModal{{$v_producto->id_producto}}" tabindex="-1"
                                aria-labelledby="accesarModal{{$v_producto->id_producto}}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="accesarModal{{$v_producto->id_producto}}">Ver
                                                Producto</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="accesarProductoId" class="form-label">ID
                                                            Producto</label>
                                                        <input type="text" class="form-control" id="accesarProductoId"
                                                            value="{{ $v_producto->id_producto }}" disabled>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="accesarProductoNombre" class="form-label">Nombre del
                                                            Producto</label>
                                                        <input type="text" class="form-control"
                                                            id="accesarProductoNombre"
                                                            value="{{ $v_producto->nombre_producto }}" disabled>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-6">
                                                        <label for="accesarMarca" class="form-label">Marca</label>
                                                        <input type="text" class="form-control" id="accesarMarca"
                                                            value="{{ $v_producto->marca->nombre_marca }}" disabled>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="accesarCategoria"
                                                            class="form-label">Categoría</label>
                                                        <input type="text" class="form-control" id="accesarCategoria"
                                                            value="{{ $v_producto->categoria->categoria }}" disabled>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-6">
                                                        <label for="accesarPrecio" class="form-label">Precio</label>
                                                        <input type="number" class="form-control" id="accesarPrecio"
                                                            value="{{ $v_producto->precio_producto }}" disabled>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="acessarStock" class="form-label">Stock</label>
                                                        <input type="number" class="form-control" id="acessarStock"
                                                            value="{{ $v_producto->cantidad_stock }}" disabled>
                                                    </div>
                                                </div>
                                                <div class="mt-4">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Volver</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex">
                                <div class="col-2 ms-2">
                                    <a href="{{ route('productos.editar_producto', $v_producto->id_producto) }}"
                                        class="btn btn-sm btn-warning d-flex justify-content-center align-items-center text-white">
                                        <span class="material-symbols-outlined material-icons">edit</span>
                                    </a>
                                </div>

                                <div class="col-2 ms-2">
                                    <a type="button"
                                        class="btn btn-sm btn-danger justify-content-center d-flex align-items-center"
                                        data-bs-toggle="modal"
                                        data-bs-target="#borrarModal{{$v_producto->id_producto}}">
                                        <span class="material-symbols-outlined material-icons">delete</span>
                                    </a>
                                </div>

                                <div class="col-2 ms-2">
                                    <a type="button"
                                        class="btn btn-sm btn-success d-flex justify-content-center align-items-center"
                                        data-bs-toggle="modal"
                                        data-bs-target="#accesarModal{{$v_producto->id_producto}}">
                                        <span class="material-symbols-outlined material-icons">visibility</span>
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
@endsection