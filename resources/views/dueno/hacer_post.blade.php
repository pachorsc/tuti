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

<body class="">
    <header>
        <x-menu></x-menu>
    </header>

    <main class="bg-gray-100 flex items-center justify-center min-h-screen">
        <div class="flex flex-col md:flex-row items-center justify-center gap-8 w-full max-w-5xl p-4">
            <!-- Formulario -->
            <div class="w-full md:w-1/2 bg-gray-300 p-6 rounded-md shadow-md">
                <h2 class="text-2xl font-bold text-center mb-4">Crear Post</h2>
                <form method="POST" action="/vendedor/insert_post" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label class="block font-semibold mb-1">Titulo</label>
                        <input name="titulo[]" type="text"
                            class="w-full p-2 rounded bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">

                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Subtitulo</label>
                        <input name="titulo[]" type="text"
                            class="w-full p-2 rounded bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">

                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Imagen</label>
                        <input name="imagen[]" type="file" accept="image/*"
                            class="w-full p-2 rounded bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">

                    </div>
                    <div id="add-image2-btn"
                        class="flex items-center justify-center bg-amber-200 rounded-md p-2 my-4 w-20 mx-auto cursor-pointer hover:bg-amber-300">
                        <span>+</span>
                    </div>
                    <div id="imagen2-div" style="display:none">
                        <label class="block font-semibold mb-1">Imagen</label>
                        <input name="imagen2" type="file" accept="image/*"
                            class="w-full p-2 rounded bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Parrafo</label>
                        <textarea name="parrafo[]" rows="4"
                            class="w-full p-2 rounded bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>

                    </div>

                    <div id="partes-container"></div>

                    <div id="add-parte-btn"
                        class="flex items-center justify-center bg-amber-200 rounded-md p-2 my-4 w-20 mx-auto cursor-pointer hover:bg-amber-300">
                        <span>+</span>
                    </div>



                    <div class="text-center">
                        <button type="submit"
                            class="bg-white px-6 py-2 my-2 rounded shadow hover:bg-gray-200 font-semibold">
                            Crear Post
                        </button>
                    </div>
                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </main>

    <footer>
        <x-footer></x-footer>
    </footer>
    <script>
        let parte = `
                    <div>
                        <label class="block font-semibold mb-1">Titulo</label>
                        <input name="titulo[]" type="text"
                            class="w-full p-2 rounded bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('Titulo')
                            <p class="text-red-500 font-semibold text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Imagen</label>
                        <input name="imagen[]" type="file" accept="image/*"
                            class="w-full p-2 rounded bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Parrafo</label>
                        <textarea name="parrafo[]" rows="4"
                            class="w-full p-2 rounded bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>`;
        document.getElementById('add-image2-btn').addEventListener('click', function () {
            document.getElementById('imagen2-div').style.display = 'block';
            this.style.display = 'none';
        });

        document.getElementById('add-parte-btn').addEventListener('click', function () {
            document.getElementById('partes-container').insertAdjacentHTML('beforeend', parte);
        });

    </script>
</body>

</html>