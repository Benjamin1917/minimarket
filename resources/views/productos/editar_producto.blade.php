@extends ('layouts/master')

@section ('contenido-principal')

<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-sm rounded-lg" style="max-width: 600px; width: 100%;">
        <div class="card-header bg-light text-center">
            <h5 class="mb-0">Editar Producto</h5>
        </div>
        <div class="card-body p-4">
            <form method="POST" action="{{route('productos.editar_productos', $v_producto->id_producto)}}">
                @csrf
                @method('put')
                <div class="row">
                    <div class="mb-3">
                        <label for="editProductId" class="form-label">ID
                            Producto</label>
                        <input type="text" class="form-control" id="editProductId" name="editProductId"
                            placeholder="ID del Producto" value="{{$v_producto->id_producto}}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="editProductName" class="form-label">Nombre del
                            Producto</label>
                        <input type="text" class="form-control" id="editProductName" name="editProductName"
                            placeholder="Nombre del Producto" value="{{$v_producto->nombre_producto}}">
                        @error('editProductName')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="editMarca" class="form-label">Marca</label>
                    <select class="form-select @error('editMarca') is-invalid @enderror" id="editMarca"
                        name="editMarca">
                        <option value="" disabled selected>Selecciona una marca</option>
                        @foreach ($marcas as $marca)
                        <option value="{{ $marca->id_marca }}" {{ old('editMarca', $v_producto->
                            id_marca) == $marca->id_marca ? 'selected' : '' }}>
                            {{ $marca->nombre_marca }}
                        </option>
                        @endforeach
                    </select>
                    @error('editMarca')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <div class="mb-3">
                        <label for="editCategoria" class="form-label">Categoría</label>
                        <select class="form-select @error('editCategoria') is-invalid @enderror" id="editCategoria"
                            name="editCategoria">
                            <option value="" disabled selected>Selecciona una categoría</option>
                            @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id_categoria }}" {{ old('editCategoria', $v_producto->
                                id_categoria) == $categoria->id_categoria ? 'selected' : '' }}>
                                {{ $categoria->categoria }}
                            </option>
                            @endforeach
                        </select>
                        @error('editCategoria')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <div class="col-md-6">
                        <label for="editPrice" class="form-label">Precio</label>
                        <input type="number" class="form-control" id="editPrice" name="editPrice" placeholder="Precio"
                            value="{{$v_producto->precio_producto}}">
                        @error('editPrice')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="editStock" class="form-label">Stock</label>
                        <input type="number" class="form-control" id="editStock" name="editStock"
                            placeholder="Cantidad en Stock" value="{{$v_producto->cantidad_stock}}" readonly>
                        @error('editStock')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
                <div class="mt-3 d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary w-50 me-2 px-4 py-2">Guardar</button>
                    <a href="javascript:history.back()" class="btn btn-secondary w-50 px-4 py-2">Volver</a>
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
</style>

@endsection