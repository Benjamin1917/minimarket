@extends ('layouts/master')

@section ('contenido-principal')
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

    .category-table {
        margin-top: 20px;
    }

    .category-table table {
        width: 100%;
        border-collapse: collapse;
        background-color: #ffffff;
    }

    .category-table th,
    .category-table td {
        padding: 15px;
        text-align: left;
        border: 1px solid #dee2e6;
    }

    .category-table th {
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

<div class="container">
    <!-- Header -->
    <div class="header-section">
        <h2>Gestión de Marcas</h2>
        <a href="{{ route('marcas.create') }}" class="btn btn-primary">Ingresar Marca</a>
    </div>

    <form method="GET" action="{{ route('marcas.buscar_por_nombre') }}">
        <div class="input-group mb-3">
            <input type="text" name="nombre_marca" class="form-control" placeholder="Buscar marca"
                value="{{ request('nombre_marca') }}">
        </div>
    </form>

    <!-- Tabla de Marca -->
    <div class="category-table">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Marca</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($v_marcas as $v_marca)
                <tr>
                    <td>{{ $v_marca->id_marca }}</td>
                    <td>{{ $v_marca->nombre_marca }}</td>
                    <td>
                        <!-- Modal para Eliminar Marca -->
                        <div class="modal fade" id="borrarModal{{$v_marca->id_marca}}" tabindex="-1"
                            aria-labelledby="borrarModalLabel{{$v_marca->id_marca}}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="borrarModalLabel{{$v_marca->id_marca}}">
                                            Confirmación de borrado
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form method="POST" action="{{ route('marcas.borrar_marca', $v_marca->id_marca) }}">
                                        @method('delete')
                                        @csrf
                                        <div class="modal-body">
                                            Se borraran todos los registros asociados a esta marca, esto incluye a la venta y su total. ¿Está seguro que desea eliminar?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light"
                                                data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-primary">Borrar Marca</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex">
                            <div class="col-2 ms-2">
                                <a href="{{ route('marcas.edit', $v_marca->id_marca) }}"
                                    class="btn btn-sm btn-warning d-flex justify-content-center align-items-center text-white">
                                    <span class="material-symbols-outlined material-icons">edit</span>
                                </a>
                            </div>

                            <div class="col-2 ms-2">
                                <a type="button"
                                    class="btn btn-sm btn-danger justify-content-center d-flex align-items-center"
                                    data-bs-toggle="modal" data-bs-target="#borrarModal{{$v_marca->id_marca}}">
                                    <span class="material-symbols-outlined material-icons">delete</span>
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
@endsection