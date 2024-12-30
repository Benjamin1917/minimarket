<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .login-box {
            max-width: 400px;
            width: 100%;
        }

        .form-control {
            border-radius: 25px;
            padding: 1rem;
            border: 1px solid #ced4da;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 25px;
            padding: 0.75rem 1.5rem;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .text-dark {
            color: #212529;
        }

        .text-muted {
            color: #6c757d;
        }
    </style>
    <title>Tu Despensa Web</title>
</head>
<body style="background-color: #f8f9fa;">

    <div class="container d-flex justify-content-center align-items-center min-vh-100">

        <div class="row border rounded-4 p-4 bg-white shadow-sm login-box">
            
            <div class="col-md-12 text-center mb-4">
                <img src="/img/logo.png" class="img-fluid" style="max-width: 180px;">
                <h2 class="mt-3 mb-2 text-dark">Tu Despensa Web</h2>
                <p class="text-muted">Ingresa tus datos</p>
            </div>

            <div class="col-md-12">
                <form method="POST" action="{{ route('usuarios.autenticar') }}">
                    @csrf
                    <div class="mb-3">
                        <input type="text" class="form-control form-control-lg" placeholder="Rut" aria-label="Rut" id="rut" name="rut" value="{{ old('rut') }}">
                    </div>
                    <div class="mb-4">
                        <input type="password" class="form-control form-control-lg" placeholder="Contraseña" aria-label="Contraseña" id="password" name="password">
                    </div>
                    <button class="btn btn-primary btn-lg w-100">Ingresar</button>
                </form>

                {{-- errores --}}
                @if($errors->any())
                <div class="alert alert-warning py-1 mt-3">
                    {{ $errors->all()[0] }}
                </div>
                @endif
                {{-- /errores --}}
            </div>

        </div>
    </div>

</body>
</html>
