<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesion</title>
</head>
<body>

    @extends('layouts.app')
    @section('content')

    <h1>INICIO DE SESION</h1>

    <form action="{{ route('acceso.store') }}" method="POST">
        
        @csrf
        <input type="email" name="email" placeholder="Email" class="form-control">
        <br>
        <input type="password" name="password" placeholder="Contraseña" class="form-control">
        <br>

        <button type="submit" class="btn btn-primary">Enviar</button>

    </form>
    @endsection
</body>
</html>