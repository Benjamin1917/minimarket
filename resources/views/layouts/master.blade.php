<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Principal - Tu Despensa</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/css/bootstrap-select.min.css">

    <!-- Google Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        .navbar-custom {
            background-color: #343a40;
        }

        .navbar-brand .icon-cart {
            font-size: 24px;
            color: #ffffff;
        }

        .navbar-nav .nav-link {
            color: #ffffff !important;
        }

        .dropdown-menu {
            background-color: #343a40;
            border: none;
        }

        .dropdown-item {
            color: #ffffff;
        }

        .dropdown-item:hover {
            background-color: #495057;
        }

        .text-light-custom {
            color: #f8f9fa !important;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center nav-link @if(Route::current()->getName()=='home.index') active @endif"
                href="{{ route('home.index') }}">
                <span class="material-icons icon-cart me-2">shopping_cart</span>
                <span class="text-light-custom">Tu Despensa</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <!-- Ventas Dropdown (Visible para todos los roles) -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="registroDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Ventas
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="registroDropdown">
                            <li><a class="nav-link @if(Route::current()->getName()=='ventas.create') active @endif"
                                    href="{{ route('ventas.create') }}">Realizar venta</a></li>
                            <li><a class="nav-link @if(Route::current()->getName()=='ventas.index') active @endif"
                                    href="{{ route('ventas.index') }}">Listado de ventas</a></li>
                        </ul>
                    </li>

                    <!-- Gestión Dropdown (Visible solo para administradores) -->
                    @if(Gate::allows('usuarios-gestion'))
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="gestionDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Gestión
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="gestionDropdown">
                            <li><a class="nav-link @if(Route::current()->getName()=='productos.index') active @endif"
                                    href="{{ route('productos.gestionar_productos') }}">Gestionar Producto</a></li>
                            <li><a class="nav-link @if(Route::current()->getName()=='categorias.index') active @endif"
                                    href="{{ route('categorias.index') }}">Gestionar Categoria</a></li>
                            <li><a class="nav-link @if(Route::current()->getName()=='marcas.index') active @endif"
                                    href="{{ route('marcas.index') }}">Gestionar Marcas</a></li>
                            <li><a class="nav-link @if(Route::current()->getName()=='usuarios.index') active @endif"
                                    href="{{ route('usuarios.index') }}">Gestionar Usuario</a></li>
                            <li><a class="nav-link @if(Route::current()->getName()=='proveedores.index') active @endif"
                                    href="{{ route('proveedores.index') }}">Gestionar Proveedor</a></li>
                        </ul>
                    </li>
                    @endif

                    <!-- Ajuste Dropdown (Visible solo para administradores) -->
                    @if(Gate::allows('usuarios-gestion'))
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="registroDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Ajustes
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="registroDropdown">
                            <li><a class="nav-link @if(Route::current()->getName()=='ajuste_stocks.create') active @endif"
                                    href="{{ route('ajuste_stocks.create') }}">Realizar ajuste de stock</a></li>
                            <li><a class="nav-link @if(Route::current()->getName()=='ajuste_stocks.index') active @endif"
                                    href="{{ route('ajuste_stocks.index') }}">Listado de ajustes</a></li>
                        </ul>
                    </li>
                    @endif
                </ul>

                <div class="d-flex align-items-center me-3 text-light-custom">
                    <span class="material-icons icon-white me-2">person</span>
                    @auth
                        <span class="me-3">{{ Auth::user()->nombre }} ({{ Auth::user()->nombreRol() }})</span>
                    @else
                        <span class="me-3">Invitado</span>
                    @endauth
                </div>
                <form class="d-flex" action="{{ route('usuario.logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-outline-light" type="submit">Salir</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Contenido -->
    <div class="p-2">
        @yield('contenido-principal')
    </div>
    <!-- Contenido -->

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/js/bootstrap-select.min.js"></script>

    <script>
        $(document).ready(function () {
            $('.selectpicker').selectpicker();
        });
    </script>
</body>

</html>
