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
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    @endif
    <main>

        <body class="bg-gray-100 text-gray-800">

            <!-- Post Principal y Secundarios -->
            <section class="container mx-auto p-4 grid grid-cols-1 lg:grid-cols-3 gap-4">
                <div class="lg:col-span-2 h-100 bg-gray-300 flex items-center justify-center">POST</div>
                <div class="flex flex-col gap-4">
                    <div class="h-32 bg-gray-300 flex items-center justify-center">POST</div>
                    <div class="h-32 bg-gray-300 flex items-center justify-center">POST</div>
                </div>
            </section>

            <!-- Suscripción -->
            <section class="container mx-auto p-4">
                <div class="bg-gray-200 p-4 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <span class="text-lg font-semibold">Suscríbete</span>
                    <div class="flex w-full sm:w-auto">
                        <input type="email" placeholder="Tu correo"
                            class="p-2 border border-gray-400 rounded-l w-full sm:w-auto" />
                        <button class="bg-blue-500 text-white px-4 rounded-r">Entrar</button>
                    </div>
                </div>
            </section>

            <!-- Categorías -->
            <section class="container mx-auto p-4 grid grid-cols-2 sm:grid-cols-4 gap-4">
                <div class="bg-gray-300 h-24 flex items-center justify-center">CATEGORÍA</div>
                <div class="bg-gray-300 h-24 flex items-center justify-center">CATEGORÍA</div>
                <div class="bg-gray-300 h-24 flex items-center justify-center">CATEGORÍA</div>
                <div class="bg-gray-300 h-24 flex items-center justify-center">CATEGORÍA</div>
                <div class="bg-gray-300 h-24 flex items-center justify-center">CATEGORÍA</div>
                <div class="bg-gray-300 h-24 flex items-center justify-center">CATEGORÍA</div>
                <div class="bg-gray-300 h-24 flex items-center justify-center">CATEGORÍA</div>
                <div class="bg-gray-300 h-24 flex items-center justify-center">CATEGORÍA</div>
            </section>

            <!-- Ofertas de la semana -->
            <section class="container mx-auto p-4">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold">Ofertas de la semana</h2>
                    <a href="#" class="text-blue-500 text-sm">Ver más →</a>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                    <div class="bg-gray-300 h-32 flex items-center justify-center">Anuncio</div>
                    <div class="bg-gray-300 h-32 flex items-center justify-center">Oferta</div>
                    <div class="bg-gray-300 h-32 flex items-center justify-center">Oferta</div>
                    <div class="bg-gray-300 h-32 flex items-center justify-center">Oferta</div>
                    <div class="bg-gray-300 h-32 flex items-center justify-center">Oferta</div>
                    <div class="bg-gray-300 h-32 flex items-center justify-center">Oferta</div>
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