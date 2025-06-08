<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<x-head></x-head>

<body class="">
    <header>
        <x-menu></x-menu>
    </header>

    <main>
        <h1 class="text-center text-4xl">Eliminar Elemento</h1>

        <div class="w-full max-w-4xl mx-auto p-6">
            <div>
                <form method="POST" action="/vendedor/detete_elemento">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach($elementos as $elemento)
                            <div class="bg-white rounded shadow p-4 flex flex-col items-center">
                                <img src="{{ asset($elemento->imagen) }}" alt="{{ $elemento->nombre }}"
                                    class="w-32 h-32 object-cover mb-2 rounded">
                                <h3 class="font-bold text-lg mb-1">{{ $elemento->nombre }}</h3>
                                <p class="text-gray-700 mb-2">Precio: ${{ $elemento->precio }}</p>
                                <label class="flex items-center">
                                    <input type="checkbox" name="elementos_seleccionados[]" value="{{ $elemento->id }}"
                                        class="mr-2">
                                    Seleccionar
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <div class="text-center mt-6">
                        <button type="submit"
                            class="bg-amber-400 hover:bg-amber-500 text-white font-bold py-2 px-6 rounded">
                            Eliminar seleccionados
                        </button>
                    </div>
                    @if ($errors->any())
                        <div class="mt-4">
                            <ul class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                                role="alert">
                                @foreach ($errors->all() as $message)
                                    <li>{{ $message }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </main>

    <footer>
        <x-footer></x-footer>
    </footer>
</body>

</html>