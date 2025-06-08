<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<x-head></x-head>

<body class="">
    
        <x-menu></x-menu>
    
    <main>
        <div class="container mx-auto mt-10 mb-10 sm:px-20 px-4">
            <div class="flex flex-col items-center justify-center">
                @for ($index = 0; $index < count($post->titulo); $index++)
                    @if ($index == 0)
                        <h1 class="text-4xl font-bold mb-2 mt-6">{{ $post->titulo[$index] }}</h1>
                        <h2 class="text-2xl font-bold mb-2 mt-6">{{ $post->titulo[$index + 1] }}</h2>
                    @endif

                    @if ($index >= 1 && $index < count($post->titulo) - 1)
                        <h2 class="text-3xl font-bold mb-2 mt-6">{{ $post->titulo[$index + 1] }}</h2>
                    @endif

                    @if (isset($post->contenido[$index]))
                        <p>
                            {!! nl2br(e($post->contenido[$index])) !!}
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