<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <h2>Registro</h2>
    @if($errors->any())
        <p>{{ $errors->first() }}</p>
    @endif
    <form action="{{ url('/register') }}" method="POST">
        @csrf
        <label>Nombre:</label>
        <input type="text" name="name" required>
        <label>Email:</label>
        <input type="email" name="email" required>
        <label>Contraseña:</label>
        <input type="password" name="password" required>
        <button type="submit">Registrarse</button>
    </form>
    <a href="{{ url('/login') }}">Iniciar sesión</a>
</body>
</html>