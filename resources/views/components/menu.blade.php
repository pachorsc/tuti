<header class="bg-[#247BA0] px-5 py-3 flex items-center justify-between">
    <div class="flex items-center gap-4">
      <a href="/">
        <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="min-w-[60px] w-[10 vw]  rounded-full object-cover">
      </a>
      
      <a href="/blog" class="border border-black px-4 py-1 bg-[#247BA0] hover:bg-[#1f6887]">Blog</a>
      
      @if(Cookie::get('comprador'))
        <a href="/usuario" class="border border-black px-4 py-1 bg-[#247BA0] hover:bg-[#1f6887]">Usuario</a>
        <a href="/cerrar_sesion?" class="border border-black px-4 py-1 bg-[#247BA0] hover:bg-[#1f6887]">Salir</a>
      @elseif (Cookie::get('vendedor'))
        <a href="/usuario" class="border border-black px-4 py-1 bg-[#247BA0] hover:bg-[#1f6887]">Usuario</a>
        <a href="/vendedor/tienda" class="border border-black px-4 py-1 bg-[#247BA0] hover:bg-[#1f6887]">Tienda</a>

        <a href="/cerrar_sesion?" class="border border-black px-4 py-1 bg-[#247BA0] hover:bg-[#1f6887]">Salir</a>
        @else
        <a href="/entrar" class="border border-black px-4 py-1 bg-[#247BA0] hover:bg-[#1f6887]">Entrar</a>
        <a href="/registro" class="border border-black px-4 py-1 bg-[#247BA0] hover:bg-[#1f6887]">Registro</a>
      @endif
    </div>
    <div class="flex items-center gap-4">

      <div class="flex">
        <input type="text" placeholder="Buscar" class="px-3 py-1 outline-none rounded-s-lg">
        <button dir="rtl" class="bg-[#1f6887] border border-black px-3 rounded-s-lg">
            <img src="{{ asset('images/icons/Search.svg') }}" alt="User" class="w-8 h-8  object-cover">
        </button>
      </div>

      <a href="">
        <img src="{{ asset('images/icons/ShoppingCart.svg') }}" alt="User" class="w-8 h-8 object-cover">
      </a>
    </div>
</header>
  