@extends('layouts/master')

@section('contenido-principal')
<style>
    body {
        background-color: #eef2f7;

    }

    .container {
        max-width: 900px;
        margin: 0 auto;
        padding: 2rem 1rem;
    }

    .form-container {
        background: #ffffff;
        border-radius: 10px;
        padding: 2rem;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h2 {
        color: #2c3e50;
        font-weight: 700;
        margin-bottom: 1.5rem;
    }

    .form-label {
        font-size: 1rem;
        font-weight: 500;
        color: #34495e;
    }

    .form-control {
        border: 1px solid #dfe6e9;
        border-radius: 8px;
        padding: 0.75rem;
        font-size: 1rem;
        color: #2c3e50;
        background-color: #f9fbfc;
        transition: all 0.2s ease;
    }

    .form-control:focus {
        border-color: #3498db;
        background-color: #ffffff;
        box-shadow: 0 0 5px rgba(52, 152, 219, 0.3);
    }

    .btn {
        padding: 0.5rem 1.0rem;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 600;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .btn-primary {
        background-color: #3498db;
        color: #fff;
        border: none;
    }

    .btn-primary:hover {
        background-color: #2980b9;
    }

    .btn-success {
        background-color: #2ecc71;
        color: #fff;
        border: none;
    }

    .btn-success:hover {
        background-color: #27ae60;
    }

    .btn-outline-primary {
        background-color: transparent;
        color: #3498db;
        border: 2px solid #3498db;
    }

    .btn-outline-primary:hover {
        background-color: #3498db;
        color: #fff;
    }

    .btn-danger {
        background-color: #e74c3c;
        color: #fff;
        border: none;
    }

    .btn-danger:hover {
        background-color: #c0392b;
    }

    .product-row {
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #dfe6e9;
    }

    .shadow-sm {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .bootstrap-select .dropdown-menu {
        background-color: white !important;
    }

    .bootstrap-select .dropdown-item {
        color: black;
    }

    .bootstrap-select .dropdown-item:hover {
        background-color: #e9ecef;
        color: black;
    }

    .form-control.selectpicker {
        background-color: white !important;
        color: black !important;
        border: 1px solid #ced4da;
    }

    .form-control.selectpicker:focus {
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }
</style>

<div class="container">
    <div class="form-container">
        <h2 class="text-center">Registrar Nueva Venta</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('ventas.store') }}" method="POST">
            @csrf

            {{-- Productos --}}
            <div id="productos-container">
                <div class="row mb-3 product-row">
                    <div class="col-md-6">
                        <label for="productos[0][id_producto]" class="form-label">Producto</label>
                        <select class="form-control selectpicker" name="productos[0][id_producto]"
                            data-live-search="true" >
                            <option value="" disabled selected>Seleccione un producto</option>
                            @foreach ($productos as $producto)
                            <option value="{{ $producto->id_producto }}"
                                data-subtext="Stock: {{ $producto->cantidad_stock }}">
                                {{ $producto->nombre_producto }} - ${{ $producto->precio_producto }}
                            </option>
                            @endforeach
                        </select>

                    </div>
                    <div class="col-md-4">
                        <label for="productos[0][cantidad]" class="form-label">Cantidad</label>
                        <input type="number" class="form-control" name="productos[0][cantidad]" >
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="button" class="btn btn-danger btn-sm remove-product"> <span
                                class="material-symbols-outlined material-icons">delete</span></button>
                    </div>
                </div>
            </div>


            <button type="button" id="add-product" class="btn btn-outline-primary mt-3">+ Agregar Producto</button>

            {{-- Medio de Pago --}}
            <div class="mt-4">
                <label for="medio_pago" class="form-label">Medio de Pago</label>
                <select class="form-control" id="medio_pago" name="medio_pago" >
                    <option value="" disabled selected>Seleccione un medio de pago</option>
                    <option value="Efectivo">Efectivo</option>
                    <option value="Tarjeta">Tarjeta</option>
                    <option value="Transferencia">Transferencia</option>
                </select>
            </div>

            {{-- Datos del Usuario --}}
            <div class="mt-4">
                <label for="rut_usuario" class="form-label">RUT del Usuario</label>
                <input type="text" class="form-control" id="rut_usuario" name="rut_usuario" 
                    placeholder="Ej. 12345678-9" value="{{ auth()->user()->rut }}" readonly>
            </div>

            {{-- Botones --}}
            <div class="mt-5 text-center">
                <button type="submit" class="btn btn-success">Registrar Venta</button>
                <a href="{{ route('ventas.index') }}" class="btn btn-primary">Volver</a>
            </div>
        </form>
    </div>
</div>

<script>
    let productIndex = 1;
    document.getElementById('add-product').addEventListener('click', function () {
        const container = document.getElementById('productos-container');
        const row = document.createElement('div');
        row.classList.add('row', 'mb-3', 'product-row');
        row.innerHTML = `
            <div class="col-md-6">
                <label for="productos[${productIndex}][id_producto]" class="form-label"></label>
                <select class="form-control selectpicker" name="productos[${productIndex}][id_producto]" 
                    data-live-search="true" required>
                    <option value="" disabled selected>Seleccione un producto</option>
                    @foreach ($productos as $producto)
                        <option value="{{ $producto->id_producto }}" 
                            data-subtext="Stock: {{ $producto->cantidad_stock }}">
                            {{ $producto->nombre_producto }} - ${{ $producto->precio_producto }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="productos[${productIndex}][cantidad]" class="form-label"></label>
                <input type="number" class="form-control" name="productos[${productIndex}][cantidad]" min="1" required>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="button" class="btn btn-danger btn-sm remove-product"> 
                    <span class="material-symbols-outlined material-icons">delete</span>
                </button>
            </div>
        `;
        container.appendChild(row);
        productIndex++;

        // Inicializa nuevamente los selectpicker en el DOM dinámico
        $('.selectpicker').selectpicker();

        row.querySelector('.remove-product').addEventListener('click', function () {
            row.remove();
        });
    });
</script>

@endsection