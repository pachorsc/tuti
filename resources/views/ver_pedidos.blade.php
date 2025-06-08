<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tuti</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <script src="http://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="overflow-x-hidden h-screen bg-gray-50 text-gray-900 font-sans antialiased">
    <header>
        <x-menu></x-menu>
    </header>
    <main class="max-w-5xl mx-auto p-6 h-screen">

        <h1 class="text-2xl font-bold mb-6">Mis pedidos</h1>

        @if(session('mensaje'))
            <div x-data="{ show: true }" x-show="show" @click="show = false"
                class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded cursor-pointer max-w-xl mx-auto my-4 shadow transition-opacity duration-300"
                title="Haz clic para cerrar">
                {{ session('mensaje') }}
            </div>
        @endif
        @if(count($pedidos) == 0)
            <div class="bg-white p-6 rounded shadow text-center text-gray-500">
                No tienes pedidos realizados.
            </div>
        @else
            <div class="space-y-6">
                @for($i = 0; $i < count($pedidos); $i++)
                    <div class="bg-white rounded shadow p-4 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <p class="font-semibold text-lg mb-1">Pedido #{{ $pedidos[$i]->id }}</p>
                            <p class="text-gray-600 text-sm mb-1">Fecha:
                                {{ \Carbon\Carbon::parse($pedidos[$i]->fecha_pedido)->format('d/m/Y H:i') }}
                            </p>
                            <p class="text-gray-600 text-sm mb-1">Tienda: {{ $tiendas[$i]->nombre ?? 'N/A' }}</p>
                            <p class="text-gray-600 text-sm mb-1">Dirección: {{ $tiendas[$i]->direccion }}</p>
                            <p class="text-gray-600 text-sm mb-1">Productos:

                                @foreach(explode(';', $pedidos[$i]->elementos) as $prod)
                                    @php
                                        if (empty($prod))
                                            continue;
                                        $partes = explode(':', $prod);
                                        if (count($partes) < 2)
                                            continue;
                                        list($producto_id, $cantidad) = $partes;
                                    @endphp
                                    <span class="inline-block bg-gray-100 rounded px-2 py-1 text-xs mr-1 mb-1">
                                        x{{ $cantidad }}
                                    </span>
                                @endforeach
                            </p>
                        </div>
                        <div class="flex flex-col items-end gap-2">
                            <span class="text-lg font-bold text-gray-800">Total:
                                {{ number_format($pedidos[$i]->precio_total, 2) }}
                                €</span>
                            <span class="px-3 py-1 rounded-full text-xs font-semibold
                                                            @if($pedidos[$i]->estado == false) bg-yellow-100 text-yellow-700
                                                                @else bg-green-100 text-green-700
                                                            @endif">
                                @if($pedidos[$i]->estado == false)
                                    En preparación
                                @else
                                    Listo
                                @endif
                            </span>
                        </div>
                    </div>
                @endfor
            </div>
        @endif
    </main>

    <footer>
        <x-footer></x-footer>
    </footer>
</body>

</html>