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
    <main class="min-h-screen flex flex-col  bg-gray-100">
        <div class="flex justify-center items-center gap-4 mt-10 mb-10">
            <h1 class="text-4xl font-bold mr-1">Categorías</h1>
            <ul class="flex gap-4 flex-wrap justify-center items-center">
                @foreach ($categorias as $categoria)
                    <a href="/blog/categoria/{{ $categoria->nombre }}" class="list-none text-center">
                        <div
                            class="w-40 h-40 bg-gray-200 rounded-full flex justify-center items-center mb-2 overflow-hidden hover:scale-105 transition-transform duration-300 ease-in-out">
                            <img src="{{  asset($categoria->imagen) }}" alt="{{ $categoria->nombre }}" class="w-[100%] h-[100%] ">
                        </div>
                        <h3>{{ $categoria->nombre }}</h3>
                    </a>
                @endforeach
            </ul>
        </div>
        <h1 class="text-center text-4xl font-bold">Lista de Posts</h1>
    <ul class="flex flex-col gap-4 max-w-4xl mx-auto mt-10 mb-10">
        
        @foreach ($posts as $post)
        <x-articulo_lista 
            imagen="{{ asset($post->imagen) }}" 
            titulo="{{ $post->titulo }}" 
            contenido="{{ explode(';;;',$post->contenido)[0] }}"
            categoria="{{ $post->nombre }}"
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

</html>