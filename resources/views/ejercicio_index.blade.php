<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Miuni Kids - Ejercicio</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex flex-col items-center min-h-screen">
    
    <!-- Navbar -->
    <nav class="w-full bg-white shadow-md p-4 flex justify-between items-center">
        <div class="text-green-600 text-3xl font-bold">MK</div>
        <div>
            <a href="{{ route('index') }}" class="text-blue-600 font-semibold hover:underline">Inicio</a>
            <a href="{{ route('logout') }}" class="ml-4 text-blue-600 font-semibold hover:underline">Cerrar sesión</a>
        </div>
    </nav>
    
    <!-- Contenido principal -->
    <main class="flex flex-col items-center justify-center flex-grow w-full p-8 text-center">
        <h1 class="text-green-600 text-5xl font-bold mt-6">Bienvenido a Miuni Kids</h1>
        <p class="text-gray-600 text-lg mt-4">Aquí puedes comenzar tus ejercicios de matemáticas.</p>
        
        <a href="#" class="mt-6 bg-blue-600 text-white px-6 py-3 rounded-lg shadow-lg text-lg font-semibold hover:bg-blue-700">
            Comenzar Ejercicio
        </a>
    </main>
    
    <!-- Footer -->
    <footer class="w-full bg-white text-center p-4 shadow-md mt-auto">
        <p class="text-gray-600">&copy; {{ date('Y') }} Miuni Kids. Todos los derechos reservados.</p>
    </footer>
</body>
</html>