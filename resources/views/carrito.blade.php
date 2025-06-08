<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<x-head></x-head>

<body class="overflow-x-hidden">
    <header>
        <x-menu></x-menu>
    </header>
    <main class="max-w-5xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Carrito</h1>
        <div class="bg-gray-200 p-6 rounded mb-8">

            @foreach($carrito as $item)

                <div class="flex items-center bg-white rounded mb-6 p-4 shadow">
                    <div class="w-24 h-24 bg-gray-300 flex items-center justify-center mr-4 rounded">
                        @if(isset($item['imagen']))
                            <img src="{{ asset($item['imagen']) }}" alt="{{ $item['nombre'] }}"
                                class="w-full h-full object-cover rounded">
                        @else
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <line x1="4" y1="4" x2="20" y2="20" stroke="currentColor" />
                                <line x1="20" y1="4" x2="4" y2="20" stroke="currentColor" />
                            </svg>
                        @endif
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-lg">{{ $item['nombre'] }}</p>
                    </div>
                    <div class="text-right min-w-[120px]">
                        <p class="font-semibold text-lg">
                            @if(isset($item['precio_descuento']) && $item['precio_descuento'])
                                <span class="line-through text-red-400 mr-2">{{ $item['precio'] }}€</span>
                                <span class="text-green-600 font-bold">{{ $item['precio_descuento'] }}€</span>
                            @else
                                {{ $item['precio'] }}€
                            @endif
                            x {{ $item['cantidad'] }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>

        @php
            $total = 0;
            foreach ($carrito as $item) {
                if (isset($item['precio_descuento'])) {
                    $total += $item['precio_descuento'] * $item['cantidad'];
                } else {
                    $total += $item['precio'] * $item['cantidad'];
                }
            }
        @endphp

        <div class="text-right text-xl font-bold mb-8">
            Total: {{ $total }} €
        </div>

        <div class="bg-gray-300 p-6 rounded " x-data="carritoSeguro({{ $total }})">

            <div class="text-right mt-4">
                <p class="text-lg font-semibold">Total a pagar: {{$total}} €</p>
                <form method="POST" action="/realizar_pedido">
                    @csrf
                    <input type="hidden" name="total" :value="total - descuento">
                    @if ($carrito ==null)
                         <button type="button" class="bg-gray-400 text-white px-6 py-2 rounded hover:bg-gray-500">
                        Reservar
                    </button>
                    @else
                    <button type="submit" class="bg-gray-400 text-white px-6 py-2 rounded hover:bg-gray-500">
                        Reservar
                    </button>
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