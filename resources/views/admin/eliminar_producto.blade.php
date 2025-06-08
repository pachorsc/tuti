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

    <main class="max-w-xl mx-auto mt-10 p-6 bg-white rounded shadow">
        <h1 class="text-2xl font-bold mb-6 text-center">Eliminar Producto/Servicio</h1>
        <form method="GET" action="{{ url('/admin/eliminar_producto_tienda') }}">
            <div class="mb-4">
                <label for="tienda_id" class="block text-gray-700 font-semibold mb-2">Selecciona una tienda:</label>
                <select name="tienda_id" id="tienda_id" required
                    class="w-full border border-gray-300 rounded px-3 py-2">
                    <option value="">-- Selecciona --</option>
                    @foreach($tiendas as $tienda)
                        <option value="{{ $tienda->id }}">{{ $tienda->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex justify-center">
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded">
                    Seleccionar
                </button>
            </div>
        </form>
    </main>

    <footer>
        <x-footer></x-footer>
    </footer>
</body>

</html>