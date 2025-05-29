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
    <h1 class="text-2xl text-center font-bold border-b-2">
        Añadir Categoría
    </h1>
    <div>
        <form action="/admin/insertar_categoria" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4 mt-4 justify-center items-center my-4">
            @csrf
            <label for="nombre">Nombre Categoría</label>
            <input type="text" name="nombre" id="nombre" class="border-2 border-gray-300 rounded-md p-2">
            <label for="imagen">Imagen de Categoría</label>
            <input type="file" name="imagen" id="imagen" accept="image/*" class="border-2 border-gray-300 rounded-md p-2">
            <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-700">
                Añadir Categoría
            </button>
        </form>
    </div>
     @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif
  </main>

  <footer>
    <x-footer></x-footer>
  </footer>
</body>

</html>