@extends ('layouts/master')

@section ('contenido-principal')

<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-sm rounded-lg" style="max-width: 600px; width: 100%;">
        <div class="card-header bg-light text-center">
            <h5 class="mb-0">Ingresar Nuevo Usuario</h5>
        </div>
        <div class="card-body p-4">
            <form action="{{route('usuarios.store')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="rut" class="form-label">Rut </label>
                    <input type="text" class="form-control" id="rut" name="rut"
                        placeholder="Ingrese un rut">
                    @error('rut')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror 
                </div>

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre del Usuario</label>
                    <input type="text" class="form-control" id="nombre" name="nombre"
                        placeholder="Ingrese un nombre">
                    @error('nombre')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror 
                </div>

                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellido del Usuario</label>
                    <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Ingrese un apellido">
                    @error('apellido')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror 
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Ingrese una contraseña">
                    @error('password')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror 
                </div>

                <div class="mb-3">
                    <label for="rol" class="form-label">Rol</label>
                    <select class="form-select @error('rol') is-invalid @enderror" id="rol"
                        name="rol">
                        <option value="" disabled selected>Selecciona un rol</option>
                        @foreach ($roles as $rol)
                        <option value="{{ $rol->id_rol }}" {{ old('rol')==$rol->id_rol ?
                            'selected' : '' }}>
                            {{ $rol->nombre_rol }}
                        </option>
                        @endforeach
                    </select>
                    @error('rol')
                    <div id="rolFeedback" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror 
                </div>

                <div class="mt-3 d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary w-50 me-2 px-4 py-2">Guardar</button>
                    <a href="javascript:history.back()" class="btn btn-secondary w-50 px-4 py-2">Volver</a>
                </div>
                
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