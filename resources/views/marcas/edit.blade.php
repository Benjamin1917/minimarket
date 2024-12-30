@extends ('layouts/master')

@section ('contenido-principal')

<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-sm rounded-lg" style="max-width: 600px; width: 100%;">
        <div class="card-header bg-light text-center">
            <h5 class="mb-0">Editar Marca</h5>
        </div>
        <div class="card-body p-4">
            <form method="POST" action="{{ route('marcas.update', $v_marca->id_marca) }}">
                @csrf
                @method('put')
                <div class="mb-3">
                    <label for="editMarcaId" class="form-label">ID Marca</label>
                    <input type="text" class="form-control" id="editMarcaId" name="editMarcaId"
                           placeholder="ID de la Marca" value="{{ $v_marca->id_marca }}" disabled>
                </div>
                <div class="mb-3">
                    <label for="nombremarca" class="form-label">Nombre de la Marca</label>
                    <input type="text" class="form-control" id="nombremarca" name="nombreMarca"
                           placeholder="Nombre de la marca" value="{{ $v_marca->marca }}">
                    @error('nombreMarca')
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
