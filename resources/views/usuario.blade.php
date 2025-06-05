<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tuti</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <script src="http://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="overflow-x-hidden">
    <header>
        <x-menu></x-menu>
    </header>
    <main>
        <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
            <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-md">
                <h2 class="text-2xl font-bold mb-4 text-center">Usuario</h2>
                <p class="text-gray-600 mb-4">Bienvenido, {{ $usuario->nombre }} {{ $usuario->apellido }}</p>
                <p class="text-gray-600 mb-4">Email: {{ $usuario->correo }}</p>
                <a href="/editar_perfil" class="block text-blue-500 hover:underline mb-4">Editar Perfil</a>
            </div>
        </div>
    </main>

    <footer>
        <x-footer></x-footer>
    </footer>
</body>

</html>