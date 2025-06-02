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
    <main class="min-h-screen bg-gray-100 py-10 flex flex-col items-center justify-center">
        <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-md overflow-hidden p-8">
            <h2 class="text-2xl font-bold mb-6 text-center text-amber-500">Selecciona un elemento para editar</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($elementos as $elemento)
                    <div class="bg-gray-50 rounded shadow p-4 flex flex-col items-center">
                        <img src="{{ asset($elemento->imagen) }}" alt="{{ $elemento->nombre }}"
                            class="w-32 h-32 object-cover mb-2 rounded">
                        <h3 class="font-bold text-lg mb-1">{{ $elemento->nombre }}</h3>
                        <p class="text-gray-700 mb-2">Precio: ${{ $elemento->precio }}</p>
                        <a href="{{ route('editar_elemento_form', ['id' => $elemento->id]) }}"
                            class="mt-2 bg-amber-400 hover:bg-amber-500 text-white font-bold py-2 px-4 rounded transition">
                            Editar
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </main>

    <footer>
        <x-footer></x-footer>
    </footer>
</body>

</html>