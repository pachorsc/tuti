<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<x-head></x-head>

<body class="">
  <header>
    <x-menu></x-menu>
  </header>
  <main class="h-screen flex flex-col justify-center items-center">
    @if (session('success'))
      <div class="alert alert-success">
        <ul class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
          <li>{{ session('success') }}</li>
        </ul>
      </div>
    @endif
    @if (session('error'))
      <div class="alert alert-success">
        <ul class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
          <li>{{ session('error') }}</li>
        </ul>
      </div>
    @endif
    <div class="container mx-auto my-4">
      <ul class="flex flex-col gap-4 mt-4 justify-center items-center">
        <li class="text-2xl font-bold border-b-2 border-gray-300 hover:bg-gray-200">
            <a href="/admin/Anadir_usuario" class="">Añadir Usuario Vendedor</a>
        </li>
        <li class="text-2xl font-bold border-b-2 border-gray-300 hover:bg-gray-200">
            <a href="/admin/anadir_categoria">Añadir Categoría</a>
        </li>
        <li class="text-2xl font-bold border-b-2 border-gray-300 hover:bg-gray-200">
          <a href="/admin/Eliminar_Usuarios">Eliminar Usuarios</a>
        </li>
        <li class="text-2xl font-bold border-b-2 border-gray-300 hover:bg-gray-200">
            <a href="/admin/tienda_eliminar_post">Eliminar Posts</a>
        </li>
        <li class="text-2xl font-bold border-b-2 border-gray-300 hover:bg-gray-200">
          <a href="/admin/eliminar_categoria">Eliminar Categoría</a>
        </li>
        <li class="text-2xl font-bold border-b-2 border-gray-300 hover:bg-gray-200">
          <a href="/admin/eliminar_producto">Eliminar Productos de la Tienda</a>
        </li>
        <li class="text-2xl font-bold border-b-2 border-red-300 hover:bg-red-200">
          <a href="/cerrar_sesion">Salir</a>
        </li>
      </ul>
     
  </main>

  <footer>
    <x-footer></x-footer>
  </footer>
</body>

</html>