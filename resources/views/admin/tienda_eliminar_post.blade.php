<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<x-head></x-head>

<body class="">
  <header>
    <x-menu></x-menu>
  </header>
  <main>
    <h1 class="text-2xl text-center font-bold">Elige la tienda para eliminar el Post</h1>
    <div class="flex flex-col items-center justify-center my-4">
      <form action="/admin/eliminar_post_tienda" method="POST">
        @csrf
        <label for="tienda_id" class="mb-2">Selecciona una tienda:</label>
        <select name="tienda_id" class="border rounded px-2 py-1 mb-4">
          @foreach ($tiendas as $tienda)
            <option value="{{ $tienda->id }}">{{ $tienda->nombre }}</option>
          @endforeach
        </select>
        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Elegir Tienda</button>
      </form>
    </div>
</main>

  <footer>
    <x-footer></x-footer>
  </footer>
</body>

</html>