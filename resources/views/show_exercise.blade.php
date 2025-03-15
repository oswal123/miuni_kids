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
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .navbar {
            width: 100%;
            background-color: #fff;
            padding: 10px 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar a {
            color: #3498db;
            text-decoration: none;
            font-size: 1rem;
        }

        .navbar a:hover {
            text-decoration: underline;
        }

        .ejercicio-detalle {
            text-align: center;
            font-size: 2rem;
            margin-top: 20px;
            max-width: 90vw;
        }

        .suma {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-end;
            font-size: 3rem;
            margin: 20px 0;
        }

        .numero {
            padding: 15px;
            background-color: #f1f1f1;
            border-radius: 8px;
            margin: 5px 0;
            width: 100px;
            text-align: right;
        }

        .operador {
            font-size: 3rem;
            margin: 5px 0;
            width: 100px;
            text-align: right;
        }

        .linea {
            margin-top: 10px;
            width: 450px; /* Ajusta el ancho de la línea aquí */
            height: 3px;
            background-color: black;
            margin-bottom: 20px;
        }

        .respuesta {
            padding: 10px;
            font-size: 1.5rem;
            margin-top: 20px;
            border-radius: 8px;
            width: 100%;
            max-width: 300px;
            text-align: right;
            background-color: #f1f1f1;
            border: 1px solid #ccc;
        }

        .teclado {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            max-width: 300px;
            margin-top: 20px;
            margin-left: 20px; /* Ajusta el margen izquierdo aquí */
        }

        .tecla {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            font-size: 1.5rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 5px;
            width: 60px;
            height: 60px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .tecla:hover {
            background-color: #45a049;
        }

        .resolver-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        .resolver-btn:hover {
            background-color: #45a049;
        }

        .respuesta-feedback {
            font-size: 2rem;
            font-weight: bold;
            margin-top: 20px;
        }

        .suma-item {
            display: flex;
            align-items: center;
        }

        .suma-item .operador {
            margin-right: 10px;
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
        <h1 class="text-green-600 text-5xl font-bold mt-6">¡Resuelve este ejercicio de suma!</h1>
        <a href="{{ route('ejercicio_nivel' . $level) }}" class="text-blue-600 font-semibold hover:underline mt-4">Volver a los Ejercicios</a>
        
        <div class="suma mt-6">
            <div class="numero">{{ $exercise[0] }}</div>
            <div class="numero">{{ $exercise[1] }}</div>
            <div class="numero">{{ $exercise[2] }}</div>
            <div class="suma-item">
                <div class="operador">+</div>
                <div class="numero">{{ $exercise[3] }}</div>
            </div>
        </div>

        <div class="linea"></div>

        <div class="respuesta" id="respuesta"></div>

        <div class="teclado" id="teclado">
            <button class="tecla" onclick="agregarNumero(1)">1</button>
            <button class="tecla" onclick="agregarNumero(2)">2</button>
            <button class="tecla" onclick="agregarNumero(3)">3</button>
            <button class="tecla" onclick="agregarNumero(4)">4</button>
            <button class="tecla" onclick="agregarNumero(5)">5</button>
            <button class="tecla" onclick="agregarNumero(6)">6</button>
            <button class="tecla" onclick="agregarNumero(7)">7</button>
            <button class="tecla" onclick="agregarNumero(8)">8</button>
            <button class="tecla" onclick="agregarNumero(9)">9</button>
            <button class="tecla" onclick="agregarNumero(0)">0</button>
            <button class="tecla" onclick="borrarNumero()">←</button>
            <button class="tecla" onclick="limpiarRespuesta()">C</button>
        </div>

        <button class="resolver-btn" id="submit-btn">Enviar</button>

        <div id="respuesta-feedback" class="respuesta-feedback"></div>
    </main>

    <!-- Footer -->
    <footer class="w-full bg-white text-center p-4 shadow-md mt-auto">
        <p class="text-gray-600">&copy; {{ date('Y') }} Miuni Kids. Todos los derechos reservados.</p>
    </footer>

    <script>
        function agregarNumero(numero) {
            const respuestaDiv = document.getElementById('respuesta');
            respuestaDiv.innerText += numero;
        }

        function borrarNumero() {
            const respuestaDiv = document.getElementById('respuesta');
            respuestaDiv.innerText = respuestaDiv.innerText.slice(0, -1);
        }

        function limpiarRespuesta() {
            const respuestaDiv = document.getElementById('respuesta');
            respuestaDiv.innerText = '';
        }

        document.getElementById('submit-btn').addEventListener('click', function () {
            const respuesta = document.getElementById('respuesta').innerText;
            const resultadoCorrecto = {{ $exercise[0] + $exercise[1] + $exercise[2] + $exercise[3] }};

            const feedbackDiv = document.getElementById('respuesta-feedback');

            if (respuesta == resultadoCorrecto) {
                feedbackDiv.innerHTML = '<span class="text-green-600">¡Correcto!</span>';
                document.getElementById('teclado').style.display = 'none';
                document.getElementById('submit-btn').disabled = true;

                // Enviar el formulario para guardar el ejercicio
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route("verify_exercise", ["index" => $index]) }}';
                form.innerHTML = `
                    @csrf
                    <input type="hidden" name="exercise" value='{{ json_encode($exercise) }}'>
                    <input type="hidden" name="result" value='${respuesta}'>
                `;
                document.body.appendChild(form);
                form.submit();
            } else {
                feedbackDiv.innerHTML = '<span class="text-red-600">Incorrecto. Intenta nuevamente.</span>';
            }
        });
    </script>
</body>
</html>