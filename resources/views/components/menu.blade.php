
<header class="bg-[#247BA0] px-5 py-3 flex items-center justify-between h-[10vh] overflow-hidden">
    <div class="flex items-center gap-4">
        <a href="/">
            <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="max-w-[100px] min-w-[70px] w-[10vw] rounded-full object-cover">
        </a>
        <a href="/blog" class="border border-black px-4 py-1 bg-[#247BA0] hover:bg-[#1f6887] hidden md:inline">Blog</a>
        @if(Cookie::get('comprador'))
            <a href="/usuario/perfil" class="border border-black px-4 py-1 bg-[#247BA0] hover:bg-[#1f6887] hidden md:inline">Usuario</a>
            <a href="/cerrar_sesion?" class="border border-black px-4 py-1 bg-[#247BA0] hover:bg-[#1f6887] hidden md:inline">Salir</a>
        @elseif (Cookie::get('vendedor'))
            <a href="/usuario/perfil" class="border border-black px-4 py-1 bg-[#247BA0] hover:bg-[#1f6887] hidden md:inline">Usuario</a>
            <a href="/vendedor/tienda" class="border border-black px-4 py-1 bg-[#247BA0] hover:bg-[#1f6887] hidden md:inline">Tienda</a>
            <a href="/cerrar_sesion?" class="border border-black px-4 py-1 bg-[#247BA0] hover:bg-[#1f6887] hidden md:inline">Salir</a>
        @else
            <a href="/entrar" class="border border-black px-4 py-1 bg-[#247BA0] hover:bg-[#1f6887] hidden md:inline">Entrar</a>
            <a href="/registro" class="border border-black px-4 py-1 bg-[#247BA0] hover:bg-[#1f6887] hidden md:inline">Registro</a>
        @endif
    </div>
    <div class="flex items-center gap-4">
        <a href="/ver_pedidos" class="relative">
            <img src="{{ asset('images/icons/pedidos.svg') }}" alt="User" class="w-8 h-8 object-cover">
        </a>
        <a href="/ver_carrito" class="relative">
            <img src="{{ asset('images/icons/ShoppingCart.svg') }}" alt="User" class="w-8 h-8 object-cover">
        </a>
        <!-- Botón hamburguesa -->
        <button @click="open = !open" class="md:hidden focus:outline-none ml-2" x-data="{ open: false }">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16"/>
                <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6 18L18 6M6 6l12 12"/>
            </svg>
            <!-- Menú móvil -->
            <div x-show="open" @click.away="open = false" class="absolute right-4 top-16 bg-[#247BA0] rounded shadow-lg flex flex-col items-start w-48 z-50 p-4 space-y-2">
                <a href="/blog" class="w-full text-left border border-black px-4 py-1 bg-[#247BA0] hover:bg-[#1f6887]">Blog</a>
                @if(Cookie::get('comprador'))
                    <a href="/usuario/perfil" class="w-full text-left border border-black px-4 py-1 bg-[#247BA0] hover:bg-[#1f6887]">Usuario</a>
                    <a href="/cerrar_sesion?" class="w-full text-left border border-black px-4 py-1 bg-[#247BA0] hover:bg-[#1f6887]">Salir</a>
                @elseif (Cookie::get('vendedor'))
                    <a href="/usuario/perfil" class="w-full text-left border border-black px-4 py-1 bg-[#247BA0] hover:bg-[#1f6887]">Usuario</a>
                    <a href="/vendedor/tienda" class="w-full text-left border border-black px-4 py-1 bg-[#247BA0] hover:bg-[#1f6887]">Tienda</a>
                    <a href="/cerrar_sesion?" class="w-full text-left border border-black px-4 py-1 bg-[#247BA0] hover:bg-[#1f6887]">Salir</a>
                @else
                    <a href="/entrar" class="w-full text-left border border-black px-4 py-1 bg-[#247BA0] hover:bg-[#1f6887]">Entrar</a>
                    <a href="/registro" class="w-full text-left border border-black px-4 py-1 bg-[#247BA0] hover:bg-[#1f6887]">Registro</a>
                @endif
            </div>
        </button>
    </div>
</header>
  