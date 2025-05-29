<footer class="bg-[#EEC643] px-6 py-8 ">
    <div class="max-w-6xl mx-auto flex flex-col align-middle md:flex-row justify-between items-center md:items-center text-center md:text-left gap-8">
      
      <!-- Columna izquierda: Enlaces -->
      <div class="flex flex-col gap-2">
        <a href="/nosotros" class="font-semibold">Nosotros</a>
        <a href="/politica-privasidad" class="font-semibold">Privacidad</a>
        <a href="/contacto" class="font-semibold">Contacto</a>
      </div>
  
      <!-- Columna central: Logo y copyright -->
      <div class="flex flex-col items-center gap-2">
        <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="min-w-[60px] w-[10 vw] object-cover">
        <p class="text-sm">Texto de copyright</p>
      </div>
  
      <div class="flex  ">
        <input type="text" placeholder="Buscar" class="px-3 py-1 outline-none rounded-s-lg">
        <button dir="rtl" class="bg-[#1f6887] border border-black px-3 rounded-s-lg">
            <img src="{{ asset('images/icons/Search.svg') }}" alt="User" class="w-8 h-8  object-cover">
        </button>
      </div>
  
    </div>
  </footer>
  