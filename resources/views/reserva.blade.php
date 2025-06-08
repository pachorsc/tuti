<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<x-head></x-head>

<body class="overflow-x-hidden">
    <header>
        <x-menu></x-menu>
    </header>
    <main>
        <div class="max-w-md mx-auto p-4 space-y-6">
            <div
                class="bg-gray-400 p-4 rounded-md flex flex-col sm:flex-row items-center sm:items-start justify-between space-y-4 sm:space-y-0 sm:space-x-4">

                <div class="w-24 h-24 bg-gray-300 flex items-center justify-center text-gray-600 text-xs">
                    <img class="w-full" src="{{ asset($producto[0]->imagen) }}" alt="">
                </div>

                <div class="flex-1 text-center sm:text-left">
                    <p class="font-bold text-black">{{$nombre}}</p>
                    <p class="text-sm text-gray-800 font-medium">
                        <strong>Precio: </strong>
                        @if($producto[0]->precio_descuento)
                            <span class="line-through font-light text-red-400 mr-2">{{ $producto[0]->precio }}€</span>
                            <span class="text-black font-bold">{{ $producto[0]->precio_descuento }}€</span>
                        @else
                            {{ $producto[0]->precio }}€
                        @endif
                    </p>
                </div>

                @if ($producto[1])
                        <form action="/reservar_producto" method="post">
                            @csrf
                            <div x-data="{ cantidad: 1 }" class="flex items-center space-x-2">
                                <button class="px-2 py-1 bg-gray-200 rounded" @click="if(cantidad > 1)cantidad--"
                                    type="button">-</button>

                                <input type="number" name="cantidad" :value="cantidad" readonly
                                    class="w-10 text-center border rounded bg-white" />

                                <button class="px-2 py-1 bg-gray-200 rounded"
                                    @click="if(cantidad < {{ $producto[0]->cantidad }}) cantidad++" type="button">+</button>
                            </div>


                    </div>
                    <div class="text-center sm:text-left">
                        <p class="font-semibold">Método de pago</p>
                        <div class="inline-block relative">
                            <select class="appearance-none px-4 py-2 pr-8 rounded bg-gray-200">
                                <option>En tienda</option>
                            </select>
                            <div class="absolute right-2 top-2 pointer-events-none">
                                <span class="text-sm">⬇</span>
                            </div>
                        </div>
                    </div>
                    <input type="number" hidden name="producto" value="{{ $producto[0]->id }}">
                    <div class="text-center">
                        <button type="submit" class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">
                            Añadir al carrito
                        </button>
                    </div>
                    </form>
                @else
                </div>
                <h3>Debido a que este servicio depende de la disponibilidad de la tienda este tipo de servicios se reservan
                    directamente con la tienda</h3>

                <ul>
                    <li><strong>Telefono: </strong>{{$tienda->telefono}}</li>
                    <li><strong>Direccion: </strong>{{$tienda->direccion }}</li>
                    <li><strong>Horario: </strong>{{$tienda->horario}}</li>
                </ul>
                <div>
                    <img class="w-100" src="{{ asset($tienda->imagen) }}" alt="">
                </div>


            @endif
        </div>

    </main>

    <footer>
        <x-footer></x-footer>
    </footer>
</body>

</html>