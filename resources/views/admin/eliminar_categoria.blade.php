<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<x-head></x-head>

<body class="h-screen bg-gray-100">
    <header>
        <x-menu></x-menu>
    </header>

    <main class="max-w-xl mx-auto mt-10 p-6 bg-white rounded shadow">
        <h1 class="text-2xl font-bold mb-6 text-center">Eliminar Categoría</h1>
        <form method="POST" action="{{ url('/admin/delete_categoria') }}">
            @csrf
            <div class="mb-4">
                <label for="categoria_id" class="block text-gray-700 font-semibold mb-2">Selecciona una
                    categoría:</label>
                <select name="categoria_id" id="categoria_id" required
                    class="w-full border border-gray-300 rounded px-3 py-2">
                    <option value="">-- Selecciona --</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex justify-center">
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded">
                    Eliminar
                </button>
            </div>
        </form>
    </main>

    <footer>
        <x-footer></x-footer>
    </footer>
</body>

</html>