<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Miuni Kids - Resolver Ejercicio</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .exercise-board {
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .exercise-board h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }
    </style>
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
        <h1 class="text-green-600 text-5xl font-bold mt-6">Resolver Ejercicio</h1>
        <p class="text-gray-600 text-lg mt-4">Resuelve el siguiente ejercicio:</p>
        
        @if($errors->any())
            <div class="text-red-600">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div class="exercise-board mt-6">
            <h2>{{ implode(' + ', $exercise) }} =</h2>
            <form action="{{ route('verify_exercise', ['index' => $index]) }}" method="POST" class="w-full max-w-md mt-6">
                @csrf
                <input type="hidden" name="exercise" value="{{ json_encode($exercise) }}">
                <input type="number" name="result" id="result" class="w-full px-4 py-2 border rounded-lg" required>
                <button type="submit" class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg shadow-lg text-lg font-semibold hover:bg-blue-700 mt-4">
                    Verificar
                </button>
            </form>
        </div>
    </main>
    
    <!-- Footer -->
    <footer class="w-full bg-white text-center p-4 shadow-md mt-auto">
        <p class="text-gray-600">&copy; {{ date('Y') }} Miuni Kids. Todos los derechos reservados.</p>
    </footer>
</body>
</html>