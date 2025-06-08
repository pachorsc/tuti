<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<x-head></x-head>

<body class="">

    <header>
        <x-menu></x-menu>
    </header>

    <main class="flex-1 max-w-5xl mx-auto w-full px-4 py-8">

        <h1 class="text-2xl md:text-3xl font-bold text-center mb-6">{{$tienda->nombre}}</h1>

        <div class="w-full aspect-video bg-gray-300 rounded-lg mb-8 flex items-center justify-center overflow-hidden">
            <img src="{{ asset($tienda->imagen) }}" alt="Imagen de la tienda" class="object-cover w-full h-full">
        </div>

        <div class="mb-10">
            <h2 class="text-lg font-semibold mb-2">Ubicación</h2>
            <div
                class="w-full h-56 md:h-64 bg-gray-200 border-2 border-blue-400 rounded-lg flex items-center justify-center overflow-hidden">
                @if(isset($tienda->direccion) && $tienda->direccion)
                    <iframe width="100%" height="100%" frameborder="0" style="border:0; min-height: 100%; min-width: 100%;"
                        src="https://www.google.com/maps?q={{ urlencode($tienda->direccion) }}&hl=es&z=16&output=embed"
                        allowfullscreen>
                    </iframe>
                @else
                    <span class="text-gray-500">Mapa no disponible</span>
                @endif
            </div>
        </div>

        <div class="mb-10">
            <h2 class="text-lg font-semibold mb-2">Mejores productos / Servicios</h2>
            <div class="flex space-x-4 overflow-x-auto bg-gray-200 rounded-lg p-4">
                @for($i = 0; $i < count($productos); $i++)
                    <a href="{{ '/producto/' . $tienda->nombre . '/' . $productos[$i]->id }}"
                        class="min-w-[120px] shadow h-32 bg-[url('{{ asset($productos[$i]->imagen) }}')] bg-cover bg-center rounded-lg flex items-center justify-center text-white font-bold text-lg">
                        <span class="text-black bg-amber-100">{{ str_replace('_', ' ', $productos[$i]->nombre) }}</span>
                    </a>
                @endfor
            </div>
        </div>

        @if (count($posts) > 0)
            <div class="mb-10">
                <h2 class="text-lg font-semibold mb-4">Blog</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 bg-gray-200 rounded-lg p-4">
                    @for($i = 0; $i < count($posts); $i++)
                        <a href="{{ '/blog/' . $posts[$i]->id }}" class="bg-gray-500 rounded-lg p-3 flex flex-col">
                            <div class="w-full h-24 bg-gray-400 rounded mb-2">
                                <img src="{{ asset($posts[$i]->imagen) }}" alt="{{ $posts[$i]->titulo }}"
                                    class="w-full h-full object-cover rounded">
                            </div>
                            <div class="font-semibold text-white mb-1">{{ explode(';;;',$posts[$i]->titulo)[0] }}</div>
                            <div class="text-gray-300 text-sm mb-2">{{ Str::limit(explode(';;;',$posts[$i]->titulo)[1], 50) }}</div>
                        </a>
                    @endfor
                </div>
            </div>

        @endif
    </main>


    <footer>
        <x-footer></x-footer>
    </footer>

</body>

</html>