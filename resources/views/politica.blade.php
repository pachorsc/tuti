<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<x-head></x-head>

<body>
  <header>
    <x-menu></x-menu>
  </header>
  <main class="bg-white text-gray-800 font-sans p-6 w-full min-h-screen">
    <div class="max-w-xl mx-auto">
        <h1 class="text-2xl font-bold text-center my-2">Política de Privacidad de Tuti</h1>
        <p class=" text-center text-gray-600 mb-6">
          En Tuti, nos comprometemos a proteger la privacidad y seguridad de nuestros usuarios. Esta Política de Privacidad explica cómo recopilamos, utilizamos y protegemos la información personal dentro de nuestra plataforma.
        </p>
    
        <!-- Sección: Información que Recopilamos -->
        <div class="mb-8">
          <div class="flex items-center space-x-2 mb-4">
            <div class="w-9 h-9 bg-[#BEB7DF] flex justify-center items-center rounded-full"><span class="text-3xl">3</span></div>
            <h2 class="text-2xl font-semibold">Información que Recopilamos</h2>
          </div>
          <ul class="list-disc pl-6 space-y-2 ">
            <li><strong>Información de registro:</strong> Nombre, correo electrónico, dirección y otros datos que el usuario proporcione al crear una cuenta.</li>
            <li><strong>Información de uso:</strong> Datos sobre la actividad en la plataforma, preferencias y compras realizadas.</li>
            <li><strong>Datos de pago:</strong> Si el usuario realiza transacciones dentro de Tuti, procesamos la información de pago de manera segura a través de terceros confiables.</li>
            <li><strong>Cookies y tecnologías similares:</strong> Recopilamos información de navegación para mejorar la experiencia del usuario en la plataforma.</li>
          </ul>
        </div>
    
        <!-- Sección: Uso de la Información -->
        <div class="mb-8">
          <div class="flex items-center space-x-2 mb-4">
            <div class="w-9 h-9 bg-[#BEB7DF] flex justify-center items-center rounded-full "><span class="text-3xl">2</span></div>
            <h2 class="text-2xl font-semibold">Uso de la Información</h2>
          </div>
          <ul class="list-disc pl-6 space-y-2 ">
            <li>Mejorar y personalizar la experiencia dentro de Tuti.</li>
            <li>Procesar transacciones y facilitar la conexión entre comerciantes y clientes.</li>
            <li>Enviar información relevante sobre ofertas, eventos y actualizaciones.</li>
            <li>Garantizar la seguridad y el cumplimiento de regulaciones aplicables.</li>
          </ul>
        </div>
    
        <!-- Repetido: Uso de la Información (intencionalmente duplicado como en imagen) -->
        <div class="mb-8">
          <div class="flex items-center space-x-2 mb-4">
            <div class="w-9 h-9  flex justify-center items-center rounded-full bg-[#BEB7DF]"><span class="text-3xl">3</span>
            </div>
            <h2 class="text-2xl font-semibold">Uso de la Información</h2>
          </div>
          <ul class="list-disc pl-6 space-y-2">
            <li>Mejorar y personalizar la experiencia dentro de Tuti.</li>
            <li>Procesar transacciones y facilitar la conexión entre comerciantes y clientes.</li>
            <li>Enviar información relevante sobre ofertas, eventos y actualizaciones.</li>
            <li>Garantizar la seguridad y el cumplimiento de regulaciones aplicables.</li>
          </ul>
        </div>
      </div>
  </main>
    
  <footer>
    <x-footer></x-footer>
  </footer>
</body>

</html>