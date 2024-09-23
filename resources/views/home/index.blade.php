<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Principal - Tu Despensa</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
        .container {
            margin-top: 30px;
        }
        .form-control, .form-select {
            border-radius: 0.375rem;
        }
        .btn-custom {
            background-color: #007bff;
            color: #ffffff;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
        .btn-success-custom {
            background-color: #28a745;
            color: #ffffff;
        }
        .btn-success-custom:hover {
            background-color: #218838;
        }
        .card {
            border: none;
            border-radius: 0.375rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #007bff;
            color: #ffffff;
            border-bottom: 1px solid #0056b3;
        }
        .card-body {
            padding: 2rem;
        }
        .text-light-custom {
            color: #f8f9fa !important;
        }
        .hidden {
            display: none;
        }
        .product-list {
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            padding: 1rem;
            background-color: #f8f9fa;
            max-height: 300px;
            overflow-y: auto;
        }
        .product-list h5 {
            margin-bottom: 1rem;
        }
        .product-table {
            width: 100%;
            border-collapse: collapse;
        }
        .product-table th, .product-table td {
            padding: 0.75rem;
            border-bottom: 1px solid #dee2e6;
            text-align: left;
        }
        .product-table th {
            background-color: #e9ecef;
        }
        .product-table td {
            font-size: 0.9rem;
        }
        .product-item:last-child {
            border-bottom: none;
        }
        .label-header {
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        .form-select-sm {
            font-size: 0.875rem;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <span class="material-icons icon-cart me-2">shopping_cart</span>
                <span class="text-light-custom">Tu Despensa</span>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Ventas</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="gestionDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Gestión
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="gestionDropdown">
                            <li><a class="dropdown-item" href="#">Gestionar Productos</a></li>
                            <li><a class="dropdown-item" href="#">Gestionar Categorías</a></li>
                            <li><a class="dropdown-item" href="#">Gestionar Usuarios</a></li>
                            
                        </ul>
                    </li>
                </ul>
                <div class="d-flex align-items-center me-3 text-light-custom">
                    <span class="material-icons icon-white me-2">person</span>
                    <span class="me-3">Administrador</span>
                </div>
                <form class="d-flex">
                    <button class="btn btn-outline-light" type="button">Salir</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Barra de búsqueda y opciones -->
    <div class="container">
        <div class="row">
            <!-- Búsqueda -->
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <form class="d-flex mb-3">
                            <input class="form-control me-2" type="search" placeholder="Buscar por nombre" aria-label="Buscar por nombre">
                            <input class="form-control me-2" type="search" placeholder="Buscar por código" aria-label="Buscar por código">
                            <button class="btn btn-custom" type="submit">Buscar</button>
                        </form>
                        <!-- Resultados de búsqueda -->
                        <div class="product-list">
                            <h5>Items:</h5>
                            <table class="product-table">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Precio Bruto</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>[065]</td>
                                        <td>Tomate Granel</td>
                                        <td><input type="text" class="form-control form-control-sm" placeholder="Ingrese cantidad"></td>
                                        <td><input type="text" class="form-control form-control-sm" placeholder="Ingrese precio bruto"></td>
                                    </tr>
                                    <!-- Puedes añadir más productos aquí -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Opciones -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Opciones
                    </div>
                    <div class="card-body">
                        <!-- Tipo de documento -->
                        <div class="mb-3">
                            <label for="documentType" class="form-label">Tipo de documento:</label>
                            <select class="form-select" id="documentType">
                                <option selected disabled>Seleccione...</option>
                                <option value="comprobante">Comprobante de venta</option>
                                <option value="boleta">Boleta electrónica</option>
                            </select>
                        </div>
                        <!-- Medio de pago y monto -->
                        <div class="d-flex flex-column mb-3">
                            <div class="mb-3">
                                <label for="paymentMethod" class="form-label">Medio de pago:</label>
                                <select class="form-select form-select-sm" id="paymentMethod">
                                    <option selected disabled>Seleccione...</option>
                                    <option value="efectivo">Efectivo</option>
                                    <option value="debito">Débito</option>
                                    <option value="transferencia">Transferencia</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="amount" class="form-label">Monto:</label>
                                <input type="text" class="form-control" id="amount" placeholder="Ingrese el monto">
                            </div>
                            <!-- Campo para mostrar la resta -->
                            <div id="changeField" class="hidden mb-3">
                                <label for="change" class="form-label">Resta:</label>
                                <input type="text" class="form-control" id="change" placeholder="Resta del monto">
                            </div>
                        </div>
                        <!-- Botón Ingresar Venta -->
                        <button class="btn btn-success-custom" type="button">Ingresar venta</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript, ingnorar por ahora -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const paymentMethodSelect = document.getElementById('paymentMethod');
            const changeField = document.getElementById('changeField');
            const amountInput = document.getElementById('amount');
            const changeInput = document.getElementById('change');

            paymentMethodSelect.addEventListener('change', function () {
                if (paymentMethodSelect.value === 'efectivo') {
                    changeField.classList.remove('hidden');
                } else {
                    changeField.classList.add('hidden');
                    changeInput.value = '';
                }
            });

            amountInput.addEventListener('input', function () {
                if (paymentMethodSelect.value === 'efectivo') {
                    // Lógica para calcular la resta (si es necesario)
                }
            });
        });
    </script>
</body>
</html>
