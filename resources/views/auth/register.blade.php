<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Miuni Kids - Registro</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex flex-col items-center min-h-screen">
    
    <!-- Navbar -->
    <nav class="w-full bg-white shadow-md p-4 flex justify-between items-center">
        <div class="text-green-600 text-3xl font-bold">MK</div>
        <div>
            <a href="{{ route('index') }}" class="text-blue-600 font-semibold hover:underline">Inicio</a>
            <a href="{{ route('login') }}" class="ml-4 text-blue-600 font-semibold hover:underline">Iniciar sesión</a>
            <a href="{{ route('register') }}" class="ml-4 text-blue-600 font-semibold hover:underline">Registrarse</a>
        </div>
    </nav>
    
    <!-- Contenido principal -->
    <main class="flex flex-col items-center justify-center flex-grow w-full p-8 text-center">
        <!-- Espacio para el logo -->
        <div class="w-40 h-40 bg-gray-300 flex items-center justify-center rounded-lg shadow-lg">
            <!-- Aquí se insertará el logo -->
            <span class="text-gray-500">Logo aquí</span>
        </div>
        
        <h1 class="text-green-600 text-5xl font-bold mt-6">Miuni Kids</h1>
        <p class="text-gray-600 text-lg mt-4">Aprender matemáticas nunca fue tan divertido</p>
        
        <h2 class="text-3xl font-bold mt-6">Registro</h2>
        @if($errors->any())
            <p class="text-red-600">{{ $errors->first() }}</p>
        @endif
        <form action="{{ url('/register') }}" method="POST" class="w-full max-w-md mt-6">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Nombre:</label>
                <input type="text" name="name" id="name" class="w-full px-4 py-2 border rounded-lg" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email:</label>
                <input type="email" name="email" id="email" class="w-full px-4 py-2 border rounded-lg" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700">Contraseña:</label>
                <input type="password" name="password" id="password" class="w-full px-4 py-2 border rounded-lg" required>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg shadow-lg text-lg font-semibold hover:bg-blue-700">
                Registrarse
            </button>
        </form>
        <a href="{{ route('login') }}" class="mt-6 text-blue-600 font-semibold hover:underline">Iniciar sesión</a>
    </main>
    
    <!-- Footer -->
    <footer class="w-full bg-white text-center p-4 shadow-md mt-auto">
        <p class="text-gray-600">&copy; {{ date('Y') }} Miuni Kids. Todos los derechos reservados.</p>
    </footer>
</body>
</html>