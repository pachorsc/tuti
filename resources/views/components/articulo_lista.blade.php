<li class="max-w-4xl mx-auto bg-gray-100 p-4 rounded-md shadow-md flex gap-4">
  <!-- Imagen -->
  <div class="w-1/3">
    <div class="aspect-video rounded-md">
      <img src="{{ $imagen }}" alt="{{ $titulo }}" class="w-full h-full object-cover rounded-md">
    </div>
  </div>

  <!-- Contenido -->
  <div class="w-2/3 flex flex-col justify-between">
    <div>
      <p class="text-sm text-gray-600 mb-1">{{ $categoria }}</p>
      <h2 class="text-lg font-semibold text-gray-800 leading-tight">
        {{ $titulo }}
      </h2>
      <p class="text-sm text-gray-700 mt-2">
        {{ $contenido }}...
      </p>
    </div>
    <a href="/blog/{{ $codigo }}" class="mt-4 text-sm text-blue-600 hover:underline">Leer Artículo</a>
  </div>
</li>