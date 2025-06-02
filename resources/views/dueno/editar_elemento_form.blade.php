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
        <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden p-8">
            <h2 class="text-2xl font-bold mb-6 text-center text-amber-500">Editar Elemento</h2>
            <form method="POST" action="{{ route('update_elemento', ['id' => $elemento->id]) }}"
                enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-1">Nombre</label>
                    <input type="text" name="nombre" value="{{ $elemento->nombre }}"
                        class="w-full p-2 rounded bg-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-1">Precio</label>
                    <input type="number" step="0.01" name="precio" value="{{ $elemento->precio }}"
                        class="w-full p-2 rounded bg-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-1">Precio Descuento</label>
                    <input type="number" step="0.01" name="precio_descuento" value="{{ $elemento->precio_descuento }}"
                        class="w-full p-2 rounded bg-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-1">Descripción</label>
                    <textarea name="descripcion" rows="3"
                        class="w-full p-2 rounded bg-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>{{ $elemento->descripcion }}</textarea>
                </div>
                @if($es_producto)
                    <div class="mb-4">
                        <label for="cantidad" class="block text-gray-700 font-semibold mb-1">Cantidad</label>
                        <input type="number" name="cantidad" value="{{ $elemento->cantidad }}"
                            class="w-full p-2 rounded bg-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                    </div>
                    <div class="mb-4">
                        <label for="color" class="block text-gray-700 font-semibold mb-1">Color</label>
                        <input type="text" name="color" value="{{ $elemento->color }}"
                            class="w-full p-2 rounded bg-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                @else
                    <div class="mb-4">
                        <label for="horario_disp" class="block text-gray-700 font-semibold mb-1">Horario disponible</label>
                        <input type="text" name="horario_disp" value="{{ $elemento->horario_disp }}"
                            class="w-full p-2 rounded bg-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                @endif
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-1">Imagen actual</label>
                    <img src="{{ asset($elemento->imagen) }}" alt="Imagen actual"
                        class="w-32 h-32 object-cover mb-2 rounded">
                    <input type="file" name="imagen"
                        class="w-full p-2 rounded bg-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 mt-2">
                    <small class="text-gray-500">Deja vacío para mantener la imagen actual.</small>
                </div>
                <div class="text-center">
                    <button type="submit"
                        class="bg-amber-400 hover:bg-amber-500 text-white font-bold py-2 px-6 rounded transition">
                        Guardar cambios
                    </button>
                </div>
                @if ($errors->any())
                    <div class="mt-4 text-red-500">
                        <ul>
                            @foreach ($errors->all() as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </form>
        </div>
    </main>

    <footer>
        <x-footer></x-footer>
    </footer>
</body>

</html>