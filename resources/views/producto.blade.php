<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<x-head></x-head>

<body class="overflow-x-hidden">
    <header>
        <x-menu></x-menu>
    </header>
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    @endif
    <main>

        <div class="p-4 max-w-7xl mx-auto mt-2">
            <!-- Sección Principal -->
            <div class="flex flex-col lg:flex-row gap-6">
                <!-- Imágenes laterales -->
                <div class="flex lg:flex-col gap-2 order-2 lg:order-1">

                    <div class="w-16 h-16 shadow">
                        <img class="w-full" src="{{ asset($datos_producto->imagen) }}"
                            alt="{{ str_replace('_',' ',$datos_producto->nombre) }}">
                    </div>

                </div>

                <!-- Imagen principal -->
                <div class="flex-1 order-1 lg:order-2 shadow">
                    <div class="aspect-square w-full">
                        <img src="{{ asset($datos_producto->imagen) }}" alt="Imagen del producto"
                            class="w-full h-full object-cover">
                    </div>
                </div>

                <!-- Descripción -->
                <div class="flex-1 order-3 space-y-4">
                    <h2 class="text-xl font-semibold">{{$datos_producto->nombre}}</h2>
                    <p class="text-gray-600 text-sm">
                        {{ $datos_producto->descripcion }}
                    </p>

                    <p class="text-sm text-gray-800 font-medium"><strong>Precio: </strong>
                        @if($datos_producto->precio_descuento)
                            <span class="line-through text-red-400 mr-2">{{ $datos_producto->precio }}€</span>
                            <span class="text-green-600 font-bold">{{ $datos_producto->precio_descuento }}</span>
                        @else
                            {{ $datos_producto->precio }}
                        @endif €
                    </p>
                    @if ($is_producto)
                        <p class="text-sm text-gray-800 font-medium"><strong>Color: </strong>{{$datos_producto->color}}</p>
                        <p class="text-sm text-gray-800 font-medium"><strong>Stock: </strong> {{$datos_producto->cantidad}}
                        </p>
                    @else
                        <p><strong>Horario: </strong>{{$datos_producto->horario_disp}}</p>
                    @endif
                    @if (!$iniciado)
                        <a href="/entrar" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded inline-block">
                            Iniciar Sesión para Reservar
                        </a>
                    @elseif (Cookie::get('vendedor') != null)
                        <a class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded inline-block">
                            Reservar
                        </a>
                    @else
                        <a href="{{ asset('/reserva/' . $datos_producto->nombre . '/' . $datos_producto->id) }}"
                            class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded inline-block">
                            Reservar
                        </a>
                    @endif
                </div>
            </div>

            <!-- Sección Servicios Relacionados -->
            <div class="mt-10">
                <h3 class="text-lg font-semibold mb-4">Productos Relacionados</h3>
                <div class="bg-gray-200 p-4 ">
                    <div class="flex gap-4 min-w-max flex-col md:flex-row">
                        @foreach ($otros_productos as $producto)
                            <a href="{{ asset('/producto/' . $producto->nombre . '/' . $producto->id) }}"
                                class="flex justify-center items-center md:w-1/5 h-32 flex-col bg-gray-300 hover:bg-gray-400 transition duration-300 transform hover:scale-105 shadow-lg rounded-lg">
                                <div class="w-full h-full overflow-hidden rounded-lg shadow-lg mb-2">
                                    <img src="{{ asset($producto->imagen) }}" alt="{{ $producto->nombre }}"
                                        class="w-full h-full object-cover rounded-t-lg">
                                </div>
                                <span
                                    class="font-bold transition-transform duration-300 hover:scale-105 p-2 rounded-3xl text-center">{{str_replace('_',' ',$producto->nombre)}}</span>
                            </a>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </main>

    <footer>
        <x-footer></x-footer>
    </footer>
</body>

</html>