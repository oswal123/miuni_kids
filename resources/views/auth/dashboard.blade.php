<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h2>Bienvenido al Dashboard</h2>
    <p>Hola, {{ auth()->user()->name }}!</p>
    <a href="{{ url('/logout') }}">Cerrar sesión</a>
</body>
</html>
