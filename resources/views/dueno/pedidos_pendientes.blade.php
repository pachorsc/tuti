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
    <script src="//unpkg.com/alpinejs" defer></script>

</head>

<body class="">
    <header>
        <x-menu></x-menu>
    </header>
    <main class="container mx-auto p-6 h-screen">
        <h1 class="text-3xl font-bold mb-4 text-center">Pedidos</h1>
        <div x-data="{ filtro: 'todos' }" class="mb-6 mx-auto">
            <div x-data="{ filtro: 'todos' }">
                <div class="mb-6 flex flex-wrap gap-2">
                    <button type="button" @click="filtro = 'todos'" :class="filtro === 'todos' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700'" class="px-4 py-2 rounded font-semibold transition">Todos</button>
                    <button type="button" @click="filtro = 'pendiente'" :class="filtro === 'pendiente' ? 'bg-yellow-500 text-white' : 'bg-gray-200 text-gray-700'"
                        class="px-4 py-2 rounded font-semibold transition">Pendiente</button>
                    <button type="button" @click="filtro = 'listo'" :class="filtro === 'listo' ? 'bg-green-600 text-white' : 'bg-gray-200 text-gray-700'" class="px-4 py-2 rounded font-semibold transition">Listo</button>
                </div>
                <form method="POST" action="/vendedor/pedidos_listos">
                    @csrf
                    <div class="space-y-4">
                        @for ($index = 0; $index < count($pedidos); $index++)
                            @php
                                $estado = $pedidos[$index]['estado'] == 1 ? 'listo' : 'pendiente';
                            @endphp
                            <div x-show="filtro === 'todos' || filtro === '{{ $estado }}'" class="flex justify-center">
                                <div
                                    class="w-full md:w-1/2 bg-white shadow-md rounded-lg p-6 mb-4 flex flex-col md:flex-row md:items-center md:justify-between">
                                    <div>
                                        <h2 class="text-xl font-semibold mb-4">Pedido #{{ $pedidos[$index]['id'] }}</h2>
                                        <p class="mb-2"><strong>Cliente:</strong> {{ $pedidos[$index]['nombre_cliente'] }}
                                        </p>
                                        <p class="mb-2"><strong>Fecha:</strong> {{ $pedidos[$index]['fecha'] }}</p>
                                        <p class="mb-2"><strong>Elementos:</strong>
                                            @for ($prodIndex = 0; $prodIndex < count($pedidos[$index]['nombre_productos']); $prodIndex++)
                                                @php
                                                    $producto['nombre'] = $pedidos[$index]['nombre_productos'][$prodIndex];
                                                    $producto['cantidad'] = $pedidos[$index]['cantidad_productos'][$prodIndex];
                                                @endphp
                                                <span class="inline-block bg-gray-100 rounded px-2 py-1 text-xs mr-1 mb-1">
                                                    {{ $producto['nombre'] }} (x{{ $producto['cantidad'] }})
                                                </span>
                                            @endfor
                                        </p>
                                        <p class="mb-2"><strong>Total:</strong> ${{ $pedidos[$index]['total']  }}</p>
                                        <p class="mb-2"><strong>Estado:</strong>
                                            @if ($pedidos[$index]['estado'] == 0)
                                                Pendiente
                                            @elseif ($pedidos[$index]['estado'] == 1)
                                                Listo
                                            @endif
                                        </p>
                                    </div>
                                    @if ($pedidos[$index]['estado'] == 0)
                                        <div class="mt-4 md:mt-0">
                                            <label class="inline-flex items-center">
                                                <input type="checkbox" name="listos[]" value="{{ $pedidos[$index]['id'] }}"
                                                    class="form-checkbox h-5 w-5 text-green-600">
                                                <span class="ml-2 text-green-700 font-semibold">Marcar como listo</span>
                                            </label>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endfor
                    </div>
                    <div class="flex justify-center mt-6">
                        <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded shadow">
                            Pedido listo
                        </button>
                    </div>
                </form>
            </div>
    </main>
    <footer>
        <x-footer></x-footer>
    </footer>
</body>

</html>