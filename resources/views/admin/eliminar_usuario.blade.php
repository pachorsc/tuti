<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<x-head></x-head>

<body class="">
  <header>
    <x-menu></x-menu>
  </header>
  <main class="container mx-auto my-8">
    <h1 class="text-2xl font-bold mb-4">Eliminar Usuarios</h1>
    <form action="/admin/delete_usuarios" method="POST">
      @csrf
      <table class="min-w-full bg-white border">
        <thead>
          <tr>
            <th class="px-4 py-2 border">Seleccionar</th>
            <th class="px-4 py-2 border">ID</th>
            <th class="px-4 py-2 border">Nombre</th>
            <th class="px-4 py-2 border">Correo</th>
            <th class="px-4 py-2 border">Tipo</th>
          </tr>
        </thead>
        <tbody>
          @foreach($usuarios as $usuario)
            <tr>
              <td class="px-4 py-2 border text-center">
                <input type="checkbox" name="usuarios[]" value="{{ $usuario['id'] }}">
              </td>
              <td class="px-4 py-2 border">{{ $usuario['id'] }}</td>
              <td class="px-4 py-2 border">{{ $usuario['nombre'] }}</td>
              <td class="px-4 py-2 border">{{ $usuario['correo'] }}</td>
              <td class="px-4 py-2 border">{{ $usuario['tipo'] }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <button type="submit" class="mt-4 bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700">
        Eliminar seleccionados
      </button>
    </form>
  </main>

  <footer>
    <x-footer></x-footer>
  </footer>
</body>

</html>