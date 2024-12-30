@extends ('layouts/master')

@section ('contenido-principal')

<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-sm rounded-lg" style="max-width: 600px; width: 100%;">
        <div class="card-header bg-light text-center">
            <h5 class="mb-0">Editar Categoría</h5>
        </div>
        <div class="card-body p-4">
            <form method="POST" action="{{ route('categorias.update', $v_categoria->id_categoria) }}">
                @csrf
                @method('put')
                <div class="mb-3">
                    <label for="editCategoryId" class="form-label">ID Categoría</label>
                    <input type="text" class="form-control" id="editCategoryId" name="editCategoryId"
                           placeholder="ID de la Categoría" value="{{ $v_categoria->id_categoria }}" disabled>
                </div>
                <div class="mb-3">
                    <label for="nombreCategoria" class="form-label">Nombre de la Categoría</label>
                    <input type="text" class="form-control" id="nombreCategoria" name="nombreCategoria"
                           placeholder="Nombre de la Categoría" value="{{ $v_categoria->categoria }}">
                    @error('nombreCategoria')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
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
    .form-control {
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
