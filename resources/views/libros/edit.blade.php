<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
</head>
<body>
    @extends('layouts.app')

    @section('content')

    <h1> EDITAR LIRBO: {{ $libro->nombre }}</h1>

    <form action="{{ route('libros.update', $libro) }}" method="POST">

        <!-- OBLIGATORIO -->
        @csrf
        <!-- Idicar método para actualizar un registro -->
        @method('PUT')

        <input type="text" name="nombre" placeholder="Nombre" class="form-control" value="{{ $libro->nombre }}">
        <br><br>
        <input type="text" name="autor" placeholder="Autor" class="form-control" value="{{ $libro->autor }}">
        <br><br>
        <input type="text" name="editorial" placeholder="Editorial" class="form-control" value="{{ $libro->editorial }}">
        <br><br>
        <input type="number" name="precio"  placeholder="Precio" class="form-control" value="{{ $libro->precio }}">

        <br>
        <button type="submit" class="btn btn-outline-primary"><i class="fa-solid fa-floppy-disk"></i> Guardar </button>

    </form>

    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('libros.index') }}" class="btn btn-danger">
            <i class="fa-solid fa-rotate-left"></i> Regresar 
        </a>
    </div>

    @endsection
</body>
</html>