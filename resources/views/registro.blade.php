<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<x-head></x-head>

<body class="">
    <header>
        <x-menu></x-menu>
    </header>
    
    <main class="bg-gray-100 flex items-center justify-center min-h-screen">

        <div class="flex flex-col md:flex-row items-center justify-center gap-8 w-full max-w-5xl p-4">
          
          <!-- Imagen -->
          <div class="w-full md:w-1/2">
            <img src="https://cdn.dribbble.com/users/988448/screenshots/5240042/icon_cadastro_v5.gif" 
                 alt="Imagen de registro" 
                 class="w-full h-auto object-cover rounded-md shadow-md">
        </div>
      
          <!-- Formulario -->
          <div class="w-full md:w-1/2 bg-gray-300 p-6 rounded-md shadow-md">
            <h2 class="text-2xl font-bold text-center mb-4">Registro</h2>
            <form method="POST" action="{{ route('registrar') }}">
              @csrf
              <div>
                <label class="block font-semibold mb-1">Usuario</label>
                <input name="nombre" type="text" class="w-full p-2 rounded bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('nombre')
                    <p class="text-red-500 font-semibold text-sm mt-1">{{ $message }}</p>
                @enderror
              </div>
              <div>
                <label class="block font-semibold mb-1">Apellido</label>
                <input name="apellido" type="text" class="w-full p-2 rounded bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('nombre')
                    <p class="text-red-500 font-semibold text-sm mt-1">{{ $message }}</p>
                @enderror
              </div>
              <div>
                <label class="block font-semibold mb-1">Correo</label>
                <input name="correo" type="email" class="w-full p-2 rounded bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('correo')
                    <p class="text-red-500 font-semibold text-sm mt-1">{{ $message }}</p>
                @enderror

                <label class="block font-semibold mb-1">Teléfono</label>
                <input name="telefono" type="phone" class="w-full p-2 rounded bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
              </div>
              <div>
                <label class="block font-semibold mb-1">Contraseña</label>
                <input id="contrasena" name="contrasena" type="password" class="w-full p-2 rounded bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('contrasena')
                    <p class="text-red-500 font-semibold text-sm mt-1">{{ $message }}</p>
                @enderror
              </div>
              <div>
                <label class="block font-semibold mb-1">Repite Contraseña</label>
                <input id="repite_contrasena" type="password" class="w-full p-2 rounded bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                <p id="mensaje-error" class="text-red-500 font-semibold text-sm mt-1 hidden">Las contraseñas no coinciden.</p>
              </div>
              <div class="text-center">
                <button id="submit-btn" type="submit" disabled class="bg-white px-6 py-2 my-2 rounded shadow hover:bg-gray-200 font-semibold opacity-50 cursor-not-allowed">
                  Registrarse
              </button>
              </div>
              
              @if(isset($error))
                  <p class="text-red-500 font-semibold">{{ $error }}</p>
              @endif
          </form>
          </div>
      
        </div>
      
      </main>
    
    <footer>
        <x-footer></x-footer>
    </footer>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
          const password = document.getElementById('contrasena');
          const repeatPassword = document.getElementById('repite_contrasena');
          const submitBtn = document.getElementById('submit-btn');
          const errorMsg = document.getElementById('mensaje-error');
      
          function checkPasswords() {
              if (password.value && repeatPassword.value && password.value === repeatPassword.value) {
                  submitBtn.disabled = false;
                  submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                  errorMsg.classList.add('hidden');
              } else {
                  submitBtn.disabled = true;
                  submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
                  if (repeatPassword.value) {
                      errorMsg.classList.remove('hidden');
                  } else {
                      errorMsg.classList.add('hidden');
                  }
              }
          }
          password.addEventListener('input', checkPasswords);
          repeatPassword.addEventListener('input', checkPasswords);
      });
      </script>
</body>

</html>