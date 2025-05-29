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
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
        {{ session('success') }}
      </div>
    @endif
    <main class="bg-gray-100 flex items-center justify-center min-h-screen">
      
        <div class="flex flex-col md:flex-row items-center justify-center gap-8 w-full max-w-5xl p-4">
          
          <!-- Imagen -->
          <div class="w-full md:w-1/2">
            <img src="https://cdn.dribbble.com/users/988448/screenshots/5240042/icon_cadastro_v5.gif" 
                 alt="Imagen de registro" 
                 class="w-full h-auto object-cover rounded-md shadow-md">
        </div>
      
          <!-- Formulario -->
          <div class="w-full md:w-1/2 bg-gray-300 p-6 rounded-md shadow-md">
            <h2 class="text-2xl font-bold text-center mb-2">Inicio de Sesion</h2>
            <form method="POST" action="{{ route('inicio_sesion') }}">
              @csrf
                <label class="block font-semibold mb-1">Correo</label>
                <input name="correo" type="email" class="w-full p-2 rounded bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('correo')
                    <p class="text-red-500 font-semibold text-sm mt-1">{{ $message }}</p>
                @enderror
              <div>
                <label class="block font-semibold mb-1">Contraseña</label>
                <input id="contrasena" name="contrasena" type="password" class="w-full p-2 rounded bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('contrasena')
                    <p class="text-red-500 font-semibold text-sm mt-1">{{ $message }}</p>
                @enderror
              </div>
              <div class="text-center">
                <button type="submit" class="bg-white px-6 py-2 my-2 rounded shadow hover:bg-gray-200 font-semibold ">
                  Iniciar Sesion
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