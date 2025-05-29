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
        <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden p-8">
            <h2 class="text-2xl font-bold mb-6 text-center text-amber-500">Editar Perfil</h2>
            <form method="POST" action="">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-1">Nombre</label>
                    <input type="text" name="nombre" value="{{ $usuario->nombre }}"
                        class="w-full p-2 rounded bg-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-1">Apellido</label>
                    <input type="text" name="apellido" value="{{ $usuario->apellido }}"
                        class="w-full p-2 rounded bg-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-1">Correo</label>
                    <input type="email" name="correo" value="{{ $usuario->correo }}"
                        class="w-full p-2 rounded bg-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-1">Contraseña</label>
                    <input type="password" name="password"
                        class="w-full p-2 rounded bg-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Nueva contraseña (opcional)">
                </div>
                <div class="text-center">
                    <button type="submit"
                        class="bg-amber-400 hover:bg-amber-500 text-white font-bold py-2 px-6 rounded transition">
                        Guardar cambios
                    </button>
                </div>
            </form>
        </div>
    </main>

    <footer>
        <x-footer></x-footer>
    </footer>
</body>

</html>