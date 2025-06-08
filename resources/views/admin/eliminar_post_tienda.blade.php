<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<x-head></x-head>

<body class="">
  <header>
    <x-menu></x-menu>
  </header>
  <main>
    <h1 class="text-2xl text-center font-bold">Elige el Post para eliminar</h1>
    <div class="flex flex-col items-center justify-center my-4">
      <form action="/admin/delete_post" method="POST">
        @csrf
        <label for="post_id" class="mb-2">Selecciona una Post:</label>
        <select name="post_id" class="border rounded px-2 py-1 mb-4">
          @foreach ($posts as $post)
            <option value="{{ $post->id }}">{{ $post->titulo }}</option>
          @endforeach
        </select>
        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Eliminar Post</button>
      </form>
    </div>
</main>

  <footer>
    <x-footer></x-footer>
  </footer>
</body>

</html>