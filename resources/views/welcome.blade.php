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
    <main>

        <body class="bg-gray-100 text-gray-800">


            <!-- Post Principal y Secundarios -->
            <section class="container h-[50vh] mx-auto p-4 grid grid-cols-1 lg:grid-cols-3 gap-4">
                <a href="{{ '/blog/' . $datos['posts'][0]->id }}"
                    class="rounded transition-transform duration-300 hover:scale-105 lg:col-span-2 bg-cover bg-center h-full bg-[url('{{ explode('***', $datos['posts'][0]->imagen)[0] }}')] bg-gray-300 flex items-center justify-center">
                    <span
                        class="text-white font-bold text-xl bg-[#EEC643] w-full text-center">{{ $datos['posts'][0]->titulo }}</span>
                </a>
                <div class="flex flex-col gap-4">
                    <a href="{{ '/blog/' . $datos['posts'][1]->id }}"
                        class="rounded transition-transform duration-300 hover:scale-105 h-full bg-cover bg-center bg-[url('{{ explode('***', $datos['posts'][1]->imagen)[0] }}')] flex items-center justify-center">
                        <span
                            class="text-white font-bold text-xl bg-[#EEC643] w-full text-center">{{ $datos['posts'][1]->titulo }}</span>
                    </a>
                    <a href="{{ '/blog/' . $datos['posts'][2]->id }}"
                        class="rounded transition-transform duration-300 hover:scale-105 h-full bg-cover bg-center bg-[url('{{ explode('***', $datos['posts'][2]->imagen)[0] }}')] flex items-center justify-center">
                        <span
                            class="text-white font-bold text-xl bg-[#EEC643] w-full text-center">{{ $datos['posts'][2]->titulo }}</span>
                    </a>
                </div>
            </section>

            <!-- Suscripción -->
            <section class="container mx-auto p-4">
                <div class="bg-[#247BA0] p-4 flex flex-col sm:flex-row items-center justify-center space-x-5z gap-4">
                    <span class="text-lg font-semibold">Suscríbete y sabras todas las novedades de las tiendas cerca de
                        ti</span>
                    <div class="flex  w-full sm:w-auto">
                        <input type="email" placeholder="Tu correo"
                            class="p-2 border border-gray-400 rounded-l w-full sm:w-auto" />
                        <button class="bg-gray-500 text-white px-4 rounded-r">Entrar</button>
                    </div>
                </div>
            </section>

            <!-- Categorías -->
            <section class="container flex flex-col mx-auto p-4 gap-4">
                <h1 class="text-xl font-semibold">Categorías cercanas</h1>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    @foreach ($datos['categorias'] as $categoria)
                        <a href="{{ '/blog/categoria/' . $categoria['nombre'] }}"
                            class="bg-[url('{{ $categoria['imagen'] }}')] bg-cover bg-center h-24 flex items-center justify-center shadow rounded transition-transform duration-300 hover:scale-105"><span
                                class="text-white font-bold text-xl bg-[#EEC643] p-2 rounded-3xl text-center">{{ $categoria['nombre'] }}</span></a>
                    @endforeach
                </div>

            </section>

            <!-- Ofertas de la semana -->
            <section class="container mx-auto p-4">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold">Ofertas de la semana</h2>
                    <a href="#" class="text-blue-500 text-sm">Ver más →</a>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach ($datos['productos']->take(8) as $producto)
                        <a href="{{ '/producto/' . $producto->nombre . '/' . $producto->id }}"
                            class="shadow transition-transform duration-300 hover:scale-105 bg-[url('{{ $producto->imagen }}')] bg-cover bg-center h-32 flex items-center justify-center"><span
                                class="text-white font-bold sm:text-xl text-sm bg-[#EEC643] p-2 rounded-3xl text-center">{{ $producto->nombre }}</span></a>
                    @endforeach
                </div>
            </section>

            
            
            <section class="container mx-auto p-4 my-2">
                <h2 class="text-xl font-semibold my-2">Tiendas cercanas</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($datos['tiendas_cercanas'] as $tienda)
                        <x-tienda :nombre="$tienda['nombre']" :imagen="$tienda['imagen']" :id="$tienda['id']"></x-tienda>
                    @endforeach
                </div>
            </section>

        </body>
    </main>

    <footer>
        <x-footer></x-footer>
    </footer>
   
</body>

</html>