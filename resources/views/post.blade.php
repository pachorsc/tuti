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
    <main>
        <div class="container mx-auto mt-10 mb-10 px-20 ">
            <div class="flex flex-col items-center justify-center">
                @for ($index = 0; $index < count($post->titulo); $index++)
                    @if ($index == 0)
                        <h1 class="text-4xl font-bold mb-2 mt-6">{{ $post->titulo[$index] }}</h1>
                        <h2 class="text-2xl font-bold mb-2 mt-6">{{ $post->titulo[$index + 1] }}</h2>
                    @endif

                    @if ($index >= 1 && $index < count($post->titulo)-1)
                        <h2 class="text-3xl font-bold mb-2 mt-6">{{ $post->titulo[$index+1] }}</h2>
                    @endif
                    
                    @if (isset($post->contenido[$index]))
                        <p>
                            {{ $post->contenido[$index] }}
                        </p>
                    @endif
                    <div class="flex flex-col items-center justify-center mt-4 mb-4">
                        @if (isset($post->imagen[$index]))
                            @if (is_array($post->imagen[$index]))
                                @foreach ($post->imagen[$index] as $imagenP)
                                    <div>
                                        <img src="{{ trim(asset($imagenP)) }}" alt="Imagen {{ $index + 1 }}"
                                            class="w-full h-auto mb-4 rounded-lg shadow-lg">
                                    </div>
                                @endforeach
                            @else
                                <img src="{{ trim(string: asset($post->imagen[$index])) }}" alt="Imagen {{ $index + 1 }}"
                                    class="w-full h-auto mb-4 rounded-lg shadow-lg">
                            @endif
                        @endif
                    </div>
                @endfor
            </div>
        </div>
    </main>

    <footer>
        <x-footer></x-footer>
    </footer>
</body>

</html>