<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<x-head></x-head>

<body class="">
  <header>
    <x-menu></x-menu>
  </header>
  <main>
    <!-- Sección: ¿Quiénes somos? -->
    <section class="text-center px-4 py-12">
      <h2 class="text-3xl font-bold mb-4">¿Quienes somos?</h2>
      <p class="max-w-2xl mx-auto mb-6">
        En Tuti, creemos en el poder del comercio local para fortalecer comunidades y fomentar el desarrollo sostenible.
        Nuestra plataforma está diseñada para conectar a pequeños negocios con clientes que valoran la cercanía, la
        calidad y el impacto positivo de comprar localmente.
      </p>
      <img src="{{ asset('images/quienes_somos.webp') }}" alt="Imagen de quienes somos" class="mx-auto w-full max-w-md">
    </section>

    <!-- Sección: ¿Objetivo Final? -->
    <section class="text-center px-4 py-12 bg-white">
      <h2 class="text-3xl font-bold mb-4">¿Objetivo Final?</h2>
      <p class="max-w-2xl mx-auto mb-6">
        El objetivo final de Tuti es fortalecer el comercio local y hacer que los pequeños negocios prosperen en un
        entorno cada vez más digital. A través de nuestra plataforma, buscamos conectar a emprendedores y comerciantes
        con clientes cercanos, creando una comunidad desde el apoyo mutuo impulsor de crecimiento económico y social.
      </p>
      <img src="{{ asset('images/objetivo_final.jpg') }}" alt="Imagen de objetivo final"
        class="mx-auto w-full max-w-md">
    </section>

    <!-- Sección: Unete a nosotros -->
    <section class="text-center px-4 py-12 bg-gray-400 text-white">
      <h2 class="text-3xl font-bold mb-6">¡ Únete a nosotros !</h2>
      <img src="{{ asset('images/unete.png') }}" alt="Imagen unete a nosotros" class="mx-auto w-full max-w-sm mb-6">
      <button class="bg-white text-black px-6 py-2 rounded font-semibold hover:bg-gray-200">
        Contacto
      </button>
    </section>

  </main>

  <footer>
    <x-footer></x-footer>
  </footer>
</body>

</html>