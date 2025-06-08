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
                <h2 class="text-2xl font-bold text-center mb-4">Crear servicio</h2>
                <form method="POST" action="/vendedor/insert_servicio" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label class="block font-semibold mb-1">Nombre del Servicio</label>
                        <input name="nombre" maxlength="25" required type="text" class="w-full p-2 rounded bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('nombre')
                            <p class="text-red-500 font-semibold text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Descripcion</label>
                        <input name="descripcion" required type="text" class="w-full p-2 rounded bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('descripcion')
                            <p class="text-red-500 font-semibold text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="precio" class="block font-semibold mb-1">Precio</label>
                        <input name="precio" type="number" step="0.01" required  class="w-full p-2 rounded bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('precio')
                            <p class="text-red-500 font-semibold text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Horario</label>
                        <input name="horario" type="text" required class="w-full p-2 rounded bg-white focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ejemplo: L - V de 9:00 a 18:00">
                        @error('nombre')
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
                            Añadir Servicio
                        </button>
                    </div>
                    @if(isset($error))
                        <p class="text-red-500 font-semibold">{{ $error }}</p>
                    @endif
                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
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