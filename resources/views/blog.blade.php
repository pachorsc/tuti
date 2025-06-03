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

<body class="">
    <header>
        <x-menu></x-menu>
    </header>
    <main class="min-h-screen flex flex-col  bg-gray-100 overflow-hidden items-center justify-center">
        <div class="flex flex-col items-center justify-center mt-10 mb-10">
            <h1 class="text-4xl font-bold mb-4">Categorias</h1>
        </div>
        <div x-data="{ scroll: $refs.slider }" class="relative w-[80vw] ">
            <!-- Flecha izquierda -->
            <button type="button"
                class="absolute left-0 top-1/2 -translate-y-1/2 z-10 bg-white/80 hover:bg-amber-400 rounded-full p-2 shadow"
                @click="scroll.scrollBy({ left: -300, behavior: 'smooth' })">
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <div x-ref="slider" class="overflow-x-auto w-full py-4 hide-scrollbar">
                <ul class="flex gap-4 flex-nowrap px-4">
                    @foreach ($categorias as $categoria)
                        <li class="flex-shrink-0 list-none text-center">
                            <a href="/blog/categoria/{{ $categoria->nombre }}">
                                <div
                                    class="w-40 h-40 bg-gray-200 rounded-full flex justify-center items-center mb-2 overflow-hidden hover:scale-105 transition-transform duration-300 ease-in-out">
                                    <img src="{{ asset($categoria->imagen) }}" alt="{{ $categoria->nombre }}"
                                        class="w-full h-full object-cover">
                                </div>
                                <h3>{{ $categoria->nombre }}</h3>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Flecha derecha -->
            <button type="button"
                class="absolute right-0 top-1/2 -translate-y-1/2 z-10 bg-white/80 hover:bg-amber-400 rounded-full p-2 shadow"
                @click="scroll.scrollBy({ left: 300, behavior: 'smooth' })">
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
        <h1 class="text-center text-4xl font-bold">Lista de Posts</h1>
        <ul class="flex flex-col gap-4 max-w-4xl mx-auto mt-10 mb-10">

            @foreach ($posts as $post)
                <x-articulo_lista 
                    imagen="{{ asset($post->imagen) }}" 
                    titulo="{{ $post->titulo }}"
                    contenido="{{ explode(';;;', $post->contenido)[0] }}" categoria="{{ $post->nombre }}"
                    codigo="{{ $post->id }}">
                </x-articulo_lista>
            @endforeach
        </ul>
        <div class="mt-6 flex flex-col justify-center items-center">
            {{ $posts->links() }}
        </div>
    </main>

    <footer>
        <x-footer></x-footer>
    </footer>
</body>
<style>
    .hide-scrollbar {
        scrollbar-width: none;
        /* Firefox */
        -ms-overflow-style: none;
        /* IE y Edge */
    }

    .hide-scrollbar::-webkit-scrollbar {
        display: none;
        /* Chrome, Safari y Opera */
    }
</style>

</html>