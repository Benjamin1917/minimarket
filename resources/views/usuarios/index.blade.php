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
            <h2>Gestión de Usuarios</h2>
            <a href="{{ route('usuarios.create') }}" class="btn btn-primary">Ingresar Usuario</a>
        </div>

        <form method="GET" action="{{ route('usuarios.buscar_por_nombre') }}">
            <div class="input-group mb-3">
                <input type="text" name="nombre" class="form-control" placeholder="Buscar usuario por nombre"
                    value="{{ request('nombre') }}">
            </div>
        </form>

        <!-- Tabla de Usuarios -->
        <div class="product-table">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Rut</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($v_usuarios as $v_usuario)
                    <tr>
                        <td>{{ $v_usuario->rut}}</td>
                        <td>{{ $v_usuario->nombre}}</td>
                        <td>{{ $v_usuario->apellido}}</td>
                        <td>
                            <!-- Modal para Eliminar Usuario -->
                            <div class="modal fade" id="borrarModal{{$v_usuario->rut}}" tabindex="-1"
                                aria-labelledby="borrarModalLabel{{$v_usuario->rut}}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="borrarModalLabel{{$v_usuario->rut}}"></h1>
                                            Confirmación de borrado</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form method="POST"
                                            action="{{route('usuarios.borrar_usuario', $v_usuario->rut)}}">
                                            @method('delete')
                                            @csrf
                                            <div class="modal-body">
                                                Se borraran todos los registros asociados de este usuario, esto incluye a la venta y su total.
                                                ¿Está seguro que desea eliminar el usuario <span
                                                    class="text-primary fw-bold">{{$v_usuario->nombre}}</span>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light"
                                                    data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-primary">Borrar Usuario</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal para Accesar a Usuario -->
                            <div class="modal fade" id="accesarModal{{$v_usuario->rut}}" tabindex="-1"
                                aria-labelledby="accesarModal{{$v_usuario->rut}}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="accesarModal{{$v_usuario->rut}}">Ver Usuario
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="accesarRut" class="form-label">Rut</label>
                                                        <input type="text" class="form-control" id="accesarRut"
                                                            name="accesarRut" placeholder="Rut"
                                                            value="{{$v_usuario->rut}}" disabled>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="accesarNombre" class="form-label">Nombre</label>
                                                        <input type="text" class="form-control" id="accesarNombre"
                                                            name="accesarNombre" placeholder="Nombre"
                                                            value="{{$v_usuario->nombre}}" disabled>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-6">
                                                        <label for="accesarApellido" class="form-label">Apellido</label>
                                                        <input type="text" class="form-control" id="accesarApellido"
                                                            name="accesarApellido" placeholder="Apellido"
                                                            value="{{$v_usuario->Apellido}}" disabled>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="accesarRol" class="form-label">Rol</label>
                                                        <input type="text" class="form-control" id="accesarRol"
                                                            name="accesarRol" placeholder="Rol"
                                                            value="{{$v_usuario->rol->nombre_rol}}" disabled>
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
                                    <a href="{{ route('usuarios.edit', $v_usuario->rut) }}"
                                        class="btn btn-sm btn-warning d-flex justify-content-center align-items-center text-white">
                                        <span class="material-symbols-outlined material-icons">edit</span>
                                    </a>
                                </div>

                                <!-- Solo mostrar el botón de eliminar si el usuario no es el mismo que el logueado -->
                                @if(auth()->user()->rut != $v_usuario->rut)
                                <div class="col-2 ms-2">
                                    <a type="button"
                                        class="btn btn-sm btn-danger justify-content-center d-flex align-items-center"
                                        data-bs-toggle="modal" data-bs-target="#borrarModal{{$v_usuario->rut}}">
                                        <span class="material-symbols-outlined material-icons">delete</span>
                                    </a>
                                </div>
                                @else
                                <div class="col-2 ms-2">
                                    <span class="btn btn-sm btn-danger justify-content-center d-flex align-items-center"><span class="material-symbols-outlined material-icons">close</span></span>
                                </div>
                                @endif
                                <div class="col-2 ms-2">
                                    <a type="button"
                                        class="btn btn-sm btn-success d-flex justify-content-center align-items-center"
                                        data-bs-toggle="modal" data-bs-target="#accesarModal{{$v_usuario->rut}}">
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
    @endsection