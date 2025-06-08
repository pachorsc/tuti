<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<x-head></x-head>

<body class="" x-data="{ cargando: true }" x-init="
    let timeout = setTimeout(() => { cargando = false }, 5000); // Oculta el loader tras 5 segundos
    navigator.geolocation.getCurrentPosition(
        function() { cargando = false; clearTimeout(timeout); },
        function() { cargando = false; clearTimeout(timeout); }
    );
">
    <div x-show="cargando"
        class="fixed inset-0 bg-white bg-opacity-80 flex items-center justify-center z-50 transition-opacity">
        <div class="flex flex-col items-center">
            <svg class="animate-spin h-12 w-12 text-yellow-400 mb-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
            </svg>
            <span class="text-lg font-semibold text-yellow-600">Cargando ubicación...</span>
        </div>
    </div>
    <header>
        <x-menu></x-menu>
    </header>
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    <main class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-6 text-center">Ofertas de la semana</h1>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
            
            @forelse($productos as $producto)
                @foreach ($producto as $oferta)
                <a href="{{ '/producto/' . $oferta->nombre . '/' . $oferta->id }}"
                    class="shadow-2xl transition-transform duration-300 hover:scale-105 h-40 flex items-center justify-center flex-col bg-white rounded-lg">
                    <div class="w-full h-24 overflow-hidden rounded-t-lg">
                        <img class="w-full h-full object-cover" src="{{ asset(explode('***', $oferta->imagen)[0]) }}"
                            alt="{{ $oferta->nombre }}">
                    </div>
                    <span class="font-bold sm:text-xl text-sm p-2 text-center">{{ $oferta->nombre }}</span>
                </a>
                @endforeach
            @empty
                <div class="col-span-4 text-center text-gray-500">No hay ofertas disponibles.</div>
            @endforelse
        </div>
    </main>

    <footer>
        <x-footer></x-footer>
    </footer>

</body>

</html>