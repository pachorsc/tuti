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

</head>

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
                        <img class="w-full" src="{{ asset($datos_producto->imagen) }}" alt="{{ $datos_producto->nombre }}">
                    </div>

                </div>

                <!-- Imagen principal -->
                <div class="flex-1 order-1 lg:order-2 shadow">
                    <div class="aspect-square w-full">
                        <img src="{{ asset( $datos_producto->imagen) }}" alt="Imagen del producto"
                            class="w-full h-full object-cover">
                    </div>
                </div>

                <!-- Descripción -->
                <div class="flex-1 order-3 space-y-4">
                    <h2 class="text-xl font-semibold">{{$datos_producto->nombre}}</h2>
                    <p class="text-gray-600 text-sm">
                        {{ $datos_producto->descripcion }}
                    </p>
                    <p class="text-sm text-gray-800 font-medium"><strong>Precio: </strong> {{$datos_producto->precio}}€</p>
                    @if ($is_producto)
                    <p class="text-sm text-gray-800 font-medium"><strong>Color: </strong>{{$datos_producto->color}}</p>
                    <p class="text-sm text-gray-800 font-medium"><strong>Stock: </strong> {{$datos_producto->cantidad}}</p>
                    @else
                    <p><strong>Horario: </strong>{{$datos_producto->horario_disp}}</p>
                    @endif
                    @if (!$iniciado)
                        <a href="{{ asset('/reserva/'.$datos_producto->nombre.'/'. $datos_producto->id) }}" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded inline-block">
                        Iniciar Sección
                    </a>
                    @else
                    <a href="{{ asset('/reserva/'.$datos_producto->nombre.'/'. $datos_producto->id) }}" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded inline-block">
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
                        @foreach ($otros_productos as $producto )
                        <a href="{{ asset('/producto/'.$producto->nombre.'/'. $producto->id) }}" class="flex justify-center items-center md:w-1/5 h-32 bg-cover bg-center bg-[url({{ asset($producto->imagen) }})]">
                            <span class="text-white font-bold transition-transform duration-300 hover:scale-105 bg-[#EEC643] p-2 rounded-3xl text-center">{{$producto->nombre}}</span>
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