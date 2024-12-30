@extends('layouts.master')

@section('contenido-principal')

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
        border: 5px solid #ced4da;
        height: 50px;
        width: 50px;
        
    }

    .form-control.selectpicker:focus {
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }
</style>




<div class="container d-flex justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header text-center">
                <h3>Ajuste de Stock</h3>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('ajuste_stocks.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="idProducto" class="form-label">Seleccione Producto</label>
                        <select class="form-control selectpicker" id="idProducto" name="id_producto" data-live-search="true">
                            <option value="" disabled selected>Seleccione un producto</option>
                            @foreach ($productos as $producto)
                                <option value="{{ $producto->id_producto }}" data-marca="{{ $producto->marca->nombre_marca ?? 'Sin Marca' }}">
                                    {{ $producto->nombre_producto }} (Stock: {{ $producto->cantidad_stock }})
                                </option>
                            @endforeach
                        </select>
                        @error('id_producto')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="marcaProducto" class="form-label">Marca del Producto</label>
                        <div id="marcaProducto" class="border p-2" style="height: 40px; background-color: #f1f1f1;">
                            Marca
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="rutUsuario" class="form-label">RUT del Usuario</label>
                        <input type="text" class="form-control" id="rutUsuario" name="rut_usuario"
                               value="{{ auth()->check() ? auth()->user()->rut : '' }}" readonly>
                        @error('rut_usuario')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="cantidad" class="form-label">Cantidad</label>
                        <input type="number" class="form-control" id="cantidad" name="cantidad"
                               placeholder="Cantidad a descontar">
                        @error('cantidad')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tipoAjuste" class="form-label">Tipo de Ajuste</label>
                        <select class="form-control" id="tipoAjuste" name="tipo_ajuste">
                            <option value="" disabled selected>Seleccione un tipo de ajuste</option>
                            <option value="vencimiento">Vencimiento</option>
                            <option value="robo">Robo</option>
                            <option value="otro">Otro</option>
                        </select>
                        @error('tipo_ajuste')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="motivo" class="form-label">Motivo</label>
                        <textarea class="form-control" id="motivo" name="motivo" rows="3" placeholder="Explique el motivo del ajuste"></textarea>
                        @error('motivo')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" value="{{ date('Y-m-d') }}" >
                        @error('fecha')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">Registrar Ajuste</button>
                        <a href="{{ route('ajuste_stocks.index') }}" class="btn btn-secondary">Volver</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<script>
    document.addEventListener('DOMContentLoaded', function () {
        const selectProducto = document.getElementById('idProducto');
        const marcaProducto = document.getElementById('marcaProducto');

        selectProducto.addEventListener('change', function () {
            const selectedOption = selectProducto.options[selectProducto.selectedIndex];
            const marca = selectedOption.getAttribute('data-marca');
            marcaProducto.textContent = marca || 'Seleccione un producto';
        });

        // Inicializar Bootstrap Select
        $('.selectpicker').selectpicker();
    });
</script>

@endsection