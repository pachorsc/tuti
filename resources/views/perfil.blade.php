<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tuti</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    <script src="http://cdn.tailwindcss.com"></script>

</head>

<body class="">
    <header>
        <x-menu></x-menu>
    </header>
    <main class="min-h-screen bg-gray-100 py-10 flex flex-col items-center justify-center">
        <div class="max-w-md mx-auto mt-10 bg-white rounded-xl shadow-md overflow-hidden p-8">
            <h2 class="text-2xl font-bold mb-6 text-center text-amber-500">Información de Usuario</h2>
            <div class="mb-4">
                <span class="block text-gray-700 font-semibold">Nombre:</span>
                <span class="block text-lg">{{ $usuario->nombre }}</span>
            </div>
            <div class="mb-4">
                <span class="block text-gray-700 font-semibold">Apellido:</span>
                <span class="block text-lg">{{ $usuario->apellido }}</span>
            </div>
            <div class="mb-4">
                <span class="block text-gray-700 font-semibold">Correo:</span>
                <span class="block text-lg">{{ $usuario->correo }}</span>
            </div>
            <div class="text-center mt-6">
                <a href="{{ route('editar_perfil') }}"
                    class="inline-block bg-amber-400 hover:bg-amber-500 text-white font-bold py-2 px-6 rounded transition">
                    Editar datos
                </a>
            </div>
        </div>
    </main>


    <footer>
        <x-footer></x-footer>
    </footer>
</body>

</html>