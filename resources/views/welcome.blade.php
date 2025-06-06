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
    <script src="//unpkg.com/alpinejs" defer></script>

</head>

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
                                class="text-white font-bold text-xl bg-[#EEC643] p-2 rounded-3xl text-center">{{ $producto->nombre }}</span></a>
                    @endforeach
                </div>
            </section>

            <!-- Sección inferior con tarjetas -->
            <section class="container mx-auto p-4">
                <h2 class="text-xl font-semibold mb-6">La mejor manera de conecta</h2>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <div class="bg-white shadow p-4 rounded text-center">
                        <div class="bg-gray-300 rounded-full h-24 w-24 mx-auto mb-4 flex items-center justify-center">
                            Tienda</div>
                        <h3 class="font-bold text-lg mb-2">nombre</h3>
                        <p class="text-sm mb-4">Reseña Reseña Reseña Reseña Reseña</p>
                        <button class="bg-blue-500 text-white px-4 py-1 rounded">leer más</button>
                    </div>
                    <div class="bg-white shadow p-4 rounded text-center">
                        <div class="bg-gray-300 rounded-full h-24 w-24 mx-auto mb-4 flex items-center justify-center">
                            Producto</div>
                        <h3 class="font-bold text-lg mb-2">nombre</h3>
                        <p class="text-sm mb-4">Reseña Reseña Reseña Reseña Reseña</p>
                        <button class="bg-blue-500 text-white px-4 py-1 rounded">leer más</button>
                    </div>
                    <div class="bg-white shadow p-4 rounded text-center">
                        <div class="bg-gray-300 rounded-full h-24 w-24 mx-auto mb-4 flex items-center justify-center">
                            Usuario</div>
                        <h3 class="font-bold text-lg mb-2">nombre</h3>
                        <p class="text-sm mb-4">Reseña Reseña Reseña Reseña Reseña</p>
                        <button class="bg-blue-500 text-white px-4 py-1 rounded">leer más</button>
                    </div>
                </div>
            </section>

        </body>
    </main>

    <footer>
        <x-footer></x-footer>
    </footer>
   
</body>

</html>