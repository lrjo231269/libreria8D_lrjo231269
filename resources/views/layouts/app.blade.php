<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Booststrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FontAwesone -->
    <script src="https://kit.fontawesome.com/f37df07289.js" crossorigin="anonymous"></script>

</head>
<body>

    <div class="container p-5 my-5 border">
        <!-- Uso de Blade para definir la plantilla -->
        @yield('content')
    </div>
    
</body>
</html>