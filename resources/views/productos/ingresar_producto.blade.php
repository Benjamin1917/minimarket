@extends ('layouts/master')

@section ('contenido-principal')

<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-sm rounded-lg" style="max-width: 600px; width: 100%;">
        <div class="card-header bg-light text-center">
            <h5 class="mb-0">Ingresar Nuevo Producto</h5>
        </div>
        <div class="card-body p-4">

            {{-- Mensaje de éxito --}}
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('productos.agregar_productos') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="productId" class="form-label">ID Producto</label>
                    <input type="text" class="form-control" id="productId" name="idProducto"
                        placeholder="ID del Producto">
                    @error('idProducto')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="productName" class="form-label">Nombre del Producto</label>
                    <input type="text" class="form-control" id="productName" name="nombreProducto"
                        placeholder="Nombre del Producto">
                    @error('nombreProducto')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="marca" class="form-label">Marca</label>
                    <select class="form-control selectpicker @error('categoria') is-invalid @enderror" id="marca"
                        name="marca" data-live-search="true">
                        <option value="" disabled selected>Selecciona una marca</option>
                        @foreach ($marcas as $marca)
                        <option value="{{ $marca->id_marca }}" {{ old('marca')==$marca->id_marca ?
                            'selected' : '' }}>
                            {{ $marca->nombre_marca }}
                        </option>
                        @endforeach
                    </select>
                    @error('marca')
                    <div id="marcaFeedback" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="categoria" class="form-label">Categoría</label>
                    <select class="form-control selectpicker @error('categoria') is-invalid @enderror" id="categoria"
                        name="categoria" data-live-search="true">
                        <option value="" disabled selected>Selecciona una categoría</option>
                        @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id_categoria }}" {{ old('categoria')==$categoria->id_categoria ?
                            'selected' : '' }}>
                            {{ $categoria->categoria }}
                        </option>
                        @endforeach
                    </select>
                    @error('categoria')
                    <div id="categoriaFeedback" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Precio</label>
                    <input type="number" class="form-control" id="price" name="precio" placeholder="Precio">
                    @error('precio')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" class="form-control" id="stock" name="stock" placeholder="Cantidad en Stock" value="0" readonly>
                    @error('stock')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-3 d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary w-50 me-2 px-4 py-2">Guardar</button>
                    <a href="{{ route('ingreso_productos.formulario') }}" class="btn btn-primary w-50 me-2 px-4 py-2">Registro de Ingreso</a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .card {
        border: none;
    }

    .card-header {
        background-color: #f8f9fa;
        border-bottom: none;
        padding: 1rem 1.5rem;
    }

    .shadow-sm {
        box-shadow: 0 .5rem 1rem rgba(0, 0, 0, 0.1);
    }

    .form-control,
    .form-select {
        border-radius: 0.25rem;
    }

    .btn {
        border-radius: 0.25rem;
    }

    .form-label {
        font-weight: bold;
    }

    .invalid-feedback {
        font-size: 0.875rem;
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

@endsection
