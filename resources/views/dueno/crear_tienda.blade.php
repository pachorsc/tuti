<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<x-head></x-head>

<body class="">
    <header>
        <x-menu></x-menu>
    </header>
    
    <main class="bg-gray-100 flex items-center justify-center min-h-screen">
        <div class="flex flex-col md:flex-row items-center justify-center gap-8 w-full max-w-5xl p-4">
            <!-- Imagen -->
            <div class="w-full md:w-1/2">
                <img src="{{ asset('images/registro/tienda.jpg') }}" 
                     alt="Imagen de registro" 
                     class="w-full h-auto object-cover rounded-md shadow-md">
            </div>
            <!-- Formulario -->
            <div class="w-full md:w-1/2 bg-gray-300 p-6 rounded-md shadow-md">
                <h2 class="text-2xl font-bold text-center mb-4">Registro de Tienda</h2>
                <form method="POST" action="/vendedor/registro_tienda" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label class="block font-semibold mb-1">Nombre</label>
                        <input name="nombre" type="text" class="w-full p-2 rounded bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('nombre')
                            <p class="text-red-500 font-semibold text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Dirección</label>
                        <input name="direccion" type="text" class="w-full p-2 rounded bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('direccion')
                            <p class="text-red-500 font-semibold text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Horario</label>
                        <input name="horario" type="text" class="w-full p-2 rounded bg-white focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ej: 9:00-14:00, 17:00-20:00">
                        @error('horario')
                            <p class="text-red-500 font-semibold text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Teléfono</label>
                        <input name="telefono" type="tel"pattern="[+][0-9]{9}" class="w-full p-2 rounded bg-white focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ej: 600123456">
                        @error('telefono')
                            <p class="text-red-500 font-semibold text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Tipo</label>
                        <select name="tipo" class="w-full p-2 rounded bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                            @endforeach
                        </select>
                        @error('tipo')
                            <p class="text-red-500 font-semibold text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Imagen</label>
                        <input name="imagen" type="file" accept="image/*" class="w-full p-2 rounded bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('imagen')
                            <p class="text-red-500 font-semibold text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="text-center">
                        <button type="submit" class="bg-white px-6 py-2 my-2 rounded shadow hover:bg-gray-200 font-semibold">
                            Registrar Tienda
                        </button>
                    </div>
                    @if(isset($error))
                        <p class="text-red-500 font-semibold">{{ $error }}</p>
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