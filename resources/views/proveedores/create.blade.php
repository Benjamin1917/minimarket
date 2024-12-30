@extends('layouts/master')

@section('contenido-principal')

<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-sm rounded-lg" style="max-width: 600px; width: 100%;">
        <div class="card-header bg-light text-center">
            <h5 class="mb-0">Ingresar Nuevo Proveedor</h5>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('proveedores.store') }}" method="POST">
                @csrf
                {{-- <div class="mb-3">
                    <label for="idProveedor" class="form-label">ID Proveedor</label>
                    <input type="text" class="form-control" id="idProveedor" name="idProveedor"
                           placeholder="ID del Proveedor">
                    @error('idProveedor')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div> --}}

                <div class="mb-3">
                    <label for="nombreProveedor" class="form-label">Nombre del Proveedor</label>
                    <input type="text" class="form-control" id="nombreProveedor" name="nombreProveedor"
                           placeholder="Nombre del Proveedor">
                    @error('nombreProveedor')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="contactoProveedor" class="form-label">Contacto del Proveedor</label>
                    <input type="text" class="form-control" id="contactoProveedor" name="contactoProveedor"
                           placeholder="Contacto del Proveedor">
                    @error('contactoProveedor')
                    <div class="text-danger small">{{ $message }}</div>
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
