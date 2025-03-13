<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Miuni Kids - Ejercicio</title>
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
        .exercise-board a {
            color: #3498db;
            text-decoration: none;
            font-size: 18px;
        }
        .exercise-board a:hover {
            text-decoration: underline;
        }
        .exercise {
            background-color: #ffffff;
            color: #000;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
            font-size: 1.2rem;
        }
        .completed {
            background-color: #d4edda;
            color: #155724;
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
        <h1 class="text-green-600 text-5xl font-bold mt-6">Bienvenido a Miuni Kids</h1>
        <p class="text-gray-600 text-lg mt-4">Aquí puedes comenzar tus ejercicios de matemáticas.</p>
        
        <div class="exercise-board mt-6">
            <h2>Ejercicios</h2>
            @foreach ($exercises as $index => $exercise)
                <div class="exercise {{ isset($exercise['completed']) && $exercise['completed'] ? 'completed' : '' }}">
                    @if(isset($exercise['completed']) && $exercise['completed'])
                        {{ implode(' + ', $exercise['values']) }} = {{ $exercise['result'] }}
                    @else
                        <a href="{{ route('show_exercise', ['index' => $index]) }}">
                            {{ implode(' + ', $exercise) }} =
                        </a>
                    @endif
                </div>
            @endforeach
        </div>
    </main>
    
    <!-- Footer -->
    <footer class="w-full bg-white text-center p-4 shadow-md mt-auto">
        <p class="text-gray-600">&copy; {{ date('Y') }} Miuni Kids. Todos los derechos reservados.</p>
    </footer>
</body>
</html>