<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libros</title>
</head>
<body>

    <h1>LIBROS DISPONIBLES</h1>

    <div style="display: flex; flex-wrap: wrap; gap: 20px;">

        @foreach ($history as $libro)
            <div style="border: 1px solid #ccc; padding: 10px; width: 200px;">

                <!-- Título del libro -->
                <h3>
                    {{ $libro['volumeInfo']['title'] ?? 'Sin Titulo' }}
                </h3>

                <!-- Autor del libro -->
                 <p>
                    {{ $libro['volumeInfo']['authors'][0] ?? 'Autor Desconocido' }}
                 </p>

                 <!-- Portada del libro -->
                    @if (isset($libro['volumeInfo']['imageLinks']['thumbnail']))
                        <img src="{{ $libro['volumeInfo']['imageLinks']['thumbnail'] }}" alt="Portada del libro">
                    @endif

            </div>
        @endforeach

    </div>
    
</body>
</html>