<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<x-head></x-head>

<body class="overflow-x-hidden">
    <header>
        <x-menu></x-menu>
    </header>
    <main class="bg-gray-100">
        @if($mensaje)
            <div class="max-w-md mx-auto pt-6 mb-4 px-4 py-3 rounded bg-yellow-100 border-l-4 border-yellow-500 text-yellow-800 shadow">
                {{ $mensaje }}
            </div>
        @endif
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