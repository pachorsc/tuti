<div class=" rounded-lg shadow flex flex-col items-center p-6 w-72 mx-auto shadow-lg transition-transform duration-300 hover:scale-105">
    <div class="w-40 h-40  rounded-full flex items-center justify-center mb-6 overflow-hidden">
        @if(isset($imagen) && $imagen)
            <img src="{{ asset($imagen) }}" alt="{{ $nombre }}" class="object-cover w-full h-full rounded-full">
        @else
            <span class="text-white text-2xl font-semibold">Tienda</span>
        @endif
    </div>
    <div class="mb-8 text-center">
        <span class="text-xl font-bold text-black">{{ $nombre }}</span>
    </div>
    <div class="mt-auto">
        <a href="/ver_tienda/{{ $id }}" class="bg-gray-300 text-black font-semibold px-8 py-2 rounded transition hover:bg-gray-400">Ver</a>
    </div>
</div>