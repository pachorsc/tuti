<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<x-head></x-head>

<body class="">
  <header>
    <x-menu></x-menu>
  </header>
  <main>
    <div class="bg-gray-400 p-6">
      <div class="max-w-4xl mx-auto text-center">
        <h2 class="text-xl font-bold mb-4">¿Quieres Formar Parte de Nuestra Plataforma?</h2>
        <p class="text-sm text-black mb-6">
          ¡Impulsa tu negocio con TuTi! Únete a nuestra plataforma y aumenta la visibilidad de tu tienda.
          Conéctate con clientes cercanos, destaca tus productos y servicios, y participa en eventos exclusivos.
          Moderniza tu comercio sin perder el contacto personal. Juntos, fortalecemos el comercio local.
          ¡Haz crecer tu tienda hoy mismo con TuTi!
        </p>
        <!-- Imagen o video promocional -->
        <div class="bg-gray-300  flex items-center justify-center p-4 rounded">
          <img src="{{ asset('images/local.jpg') }}" alt="Imagen de unete a nosotros" class=" w-full  rounded">
        </div>
      </div>
    </div>

    <div class="bg-[#AD5D4E] py-10 h-[80vh] flex flex-col items-center justify-center ">
      <div class="mb-4">
        <img src="{{ asset('images/icons/Store.svg') }}" alt="" class="w-[10dvw]">
      </div>
      <div class="max-w-md mx-auto text-center">
        <h3 class="text-lg font-semibold mb-6">Envía el Formulario y Únete a muchos como tú</h3>
        <form action="{{ route('enviar.formulario') }}" method="POST" class="bg-gray-200 p-6 rounded-lg space-y-4">
          @csrf
          <div class="flex flex-col sm:flex-row sm:space-x-4">
            <input type="text" name="nombre" placeholder="Nombre" class="flex-1 p-2 rounded-md text-sm" required />
            <input type="text" name="apellidos" placeholder="Apellidos"
              class="flex-1 p-2 rounded-md text-sm mt-2 sm:mt-0" required />
          </div>
          <input type="email" name="correo" placeholder="Correo" class="w-full p-2 rounded-md text-sm" required />
          <input type="tel" name="telefono" placeholder="Teléfono" class="w-full p-2 rounded-md text-sm" required />
          @if (isset($success))
              @if ($success)
                  <p style="color: green;">Correo enviado correctamente.</p>
              @else
                  <p style="color: red;">Error al enviar el correo.</p>
              @endif
          @endif
          <button type="submit" class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700">
            Enviar
          </button>
        </form>
      </div>
    </div>

  </main>

  <footer>
    <x-footer></x-footer>
  </footer>
</body>

</html>