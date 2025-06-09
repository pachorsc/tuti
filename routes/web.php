<?php
use App\Models\Elemento;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormularioController;
use App\Http\Controllers\Blog_controller;
use App\Http\Controllers\Registro_controlador;
use App\Http\Controllers\Inicio_sesion_controller;
use App\Http\Controllers\Tiendas_cercanas_controller;
use App\Http\Controllers\admin_controller;
use App\Http\Controllers\vendedor_controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Tienda;
use App\Models\Pedido;
use App\Models\Descuento;
use App\Models\Post;
use Symfony\Component\Routing\Exception\RouteCircularReferenceException;


Route::get('/', function () {
    return view('coordenada'); //Longitud ; Latitud
})->name('ubicacion');

Route::post('/inicio', function (Request $request) {
    $datos = Tiendas_cercanas_controller::tiendas_cercanas($request);
    return view('welcome', [
        'datos' => $datos,
        'mensaje' => session('mensaje')
    ]);
})->name('inicio');

Route::get('/admin', function () {
    if (Cookie::get('admin') != 'true') {
        return redirect()->route('inicio');
    }
    return view('admin.admin');
})->name('admin.admin');


// Rutas para el controlador admin
Route::match(['get', 'post'], '/admin/{action}', function ($action, Request $request) {
    // Verificar si el usuario es admin
    if (Cookie::get('admin') !== 'true') {
        return redirect()->route('inicio');
    }

    $controller = app(admin_controller::class);
    if (method_exists($controller, $action)) {
        return app()->call([$controller, $action], ['request' => $request]);
    }
    abort(404);
})->name('admin_action');

// Rutas para el vendedor
Route::get('/vendedor/editar_elemento/{id}', [vendedor_controller::class, 'editar_elemento_form'])
    ->name('editar_elemento_form');

Route::post('/vendedor/update_elemento/{id}', [vendedor_controller::class, 'update_elemento'])
    ->name('update_elemento');

Route::match(['get', 'post'], '/vendedor/{action}', function ($action, Request $request) {
    // Verificar si el usuario es vendedor
    if (Cookie::get('vendedor') !== 'true') {
        return redirect()->route('inicio');
    }

    $controller = app(vendedor_controller::class);
    if (method_exists($controller, $action)) {
        return app()->call([$controller, $action], ['request' => $request]);
    }
    abort(404);
})->name('vendedor_action');


Route::get('/nosotros', function () {
    return view('nosotros');
});
Route::get('/contacto', function () {
    return view('contacto');
});
Route::post('/enviar-formulario', [FormularioController::class, 'enviarFormulario'])->name('enviar.formulario');

Route::get('/politica-privasidad', function () {
    return view('politica');
});

Route::get('/blog', [Blog_controller::class, 'trear_categorias_tienda'])->name('blog');
Route::get('/blog/{id}', [Blog_controller::class, 'traer_post']);
Route::get('/blog/categoria/{categoria}', [Blog_controller::class, 'traer_posts_categoria']);

Route::get('/registro', function () {

    return view('registro');
});
Route::post('/registrar', [Registro_controlador::class, 'store'])->name('registrar');

Route::get('/entrar', function () {

    return view('entrar');
})->name('entrar');
Route::post('/inicio_sesion', [Inicio_sesion_controller::class, 'iniciar_sesion'])->name('inicio_sesion');

Route::get('/cerrar_sesion', function () {
    // Lista de todas las cookies que quieres eliminar
    $cookies = [
        'usuario',
        'admin',
        'vendedor',
        'id_usuario',
        'carrito',
        'comprador',
        'vendedor'
        // agrega aquí cualquier otra cookie personalizada que uses
    ];
    foreach ($cookies as $cookie) {
        Cookie::queue(Cookie::forget($cookie));
    }
    return redirect()->route('entrar');
})->name('cerrar_sesion');


Route::get('usuario/perfil', function () {
    // Verificar si el usuario está autenticado
    if (Cookie::get('usuario') == null) {
        return redirect()->route('entrar');
    }
    // Obtener el ID del usuario desde la cookie
    $id_usuario = Cookie::get('id_usuario');
    //traemos nombre, apellido, correo   
    $usuario = User::find($id_usuario);

    return view('perfil', [
        'usuario' => $usuario,
    ]);

})->name('ver_perfil');

Route::get('usuario/editar', function () {
    // Verificar si el usuario está autenticado
    if (Cookie::get('usuario') == null) {
        return redirect()->route('entrar');
    }
    // Obtener el ID del usuario desde la cookie
    $id_usuario = Cookie::get('id_usuario');
    //traemos nombre, apellido, correo   
    $usuario = User::find($id_usuario);

    return view('editar_perfil', [
        'usuario' => $usuario,
    ]);

})->name('editar_perfil');

Route::Post('usuario/update', function () {
    // Verificar si el usuario está autenticado
    if (Cookie::get('usuario') == null) {
        return redirect()->route('entrar');
    }
    // Verificar si se ha enviado el formulario

    // Validar los datos del formulario
    $data = request()->validate([
        'nombre' => 'required|string|max:255',
        'apellido' => 'required|string|max:255',
        'correo' => 'required|email|max:255',
        'contrasena' => 'nullable|string|min:8',
    ]);

    // Obtener el ID del usuario desde la cookie
    $id_usuario = Cookie::get('id_usuario');

    if (!empty($data['contrasena'])) {
        $contrasena = bcrypt($data['contrasena']);
    }

    // Obtener el ID del usuario desde la cookie
    $id_usuario = Cookie::get('id_usuario');
    //hacemos el update del usuario

    User::update_usuario($id_usuario, $data['nombre'], $data['apellido'], $data['correo'], $data['contrasena']);


    $usuario = User::find($id_usuario);
    return view('perfil', [
        'usuario' => $usuario,
    ]);

})->name('update_perfil');

Route::get('/producto/{nombre}/{id}', function ($nombre, $id) {

    $datos_producto = Elemento::get_elemento_tienda($id);
    $otros_productos = Elemento::get_elementos_tienda($datos_producto[0]->tienda);
    $iniciado = true;
    //comprobar si está una sesion iniciada
    if (Cookie::get('usuario') == null) {
        $iniciado = false;
    }

    return view('producto', ['iniciado' => $iniciado, 'datos_producto' => $datos_producto[0], 'otros_productos' => $otros_productos, 'is_producto' => $datos_producto[1]]);
})->name('ver_producto');

Route::get('/reserva/{nombre}/{id}', function ($nombre, $id) {
    //pestña para reservar los productos o servicios
    $datos_producto = Elemento::get_elemento_tienda($id);
    $tienda = Tienda::get_tienda_id_prod($id);
    

    return view('reserva', ['nombre' => $nombre, 'id' => $id, 'producto' => $datos_producto, 'tienda' => $tienda]);
})->name('reserva');

Route::post('/reservar_producto', function () {
    $cantidad = $_POST['cantidad'];
    $producto = $_POST['producto'];

    // Obtener el texto plano de la cookie
    $carrito = Cookie::get('carrito', ''); // Ejemplo: "2:5;1:8;3:12;"

    // Separar los pedidos por producto
    $items = $carrito ? explode(';', trim($carrito, ';')) : [];

    $carrito_obj = [];
    $encontrado = false;
    foreach ($items as $item) {
        if (empty($item))
            continue;
        list($cant, $producto_id) = explode(':', $item);
        if ($producto_id == $producto) {
            // Si el producto ya está en el carrito, suma la cantidad
            $cant += $cantidad;
            $encontrado = true;
        }

        $producto_db = Elemento::get_elemento($producto_id);

        if ($producto_db) {
            $carrito_obj[] = [
                'cantidad' => (int) $cant,
                'producto_id' => (int) $producto_id,
                'nombre' => $producto_db->nombre,
                'precio' => $producto_db->precio,
                'precio_descuento' => $producto_db->precio_descuento,
                'tienda' => $producto_db->tienda,
                'imagen' => $producto_db->imagen,
            ];
        }
    }

    // Si el producto no estaba en el carrito, lo agregamos como nuevo
    if (!$encontrado) {
        $producto_db = Elemento::find($producto);
        if ($producto_db) {
            $carrito_obj[] = [
                'cantidad' => (int) $cantidad,
                'producto_id' => (int) $producto,
                'nombre' => $producto_db->nombre,
                'precio' => $producto_db->precio,
                'precio_descuento' => $producto_db->precio_descuento,
                'tienda' => $producto_db->tienda,
                'imagen' => $producto_db->imagen,
            ];
        }
    }
    // Convertir el carrito a string plano
    $carrito_str = '';
    foreach ($carrito_obj as $item) {
        $carrito_str .= $item['cantidad'] . ':' . $item['producto_id'] . ';';
    }

    // Guardar el string en la cookie 'carrito' por 60 minutos
    Cookie::queue('carrito', $carrito_str, 60);

    return view('carrito', ['carrito' => $carrito_obj]);
})->name('reservar_producto');

Route::post('/api/verificar-descuento', function (Request $request) {
    $codigo = strtoupper($request->input('codigo'));

    $descuentos = Descuento::get_descuentos();
    //creamos un objeto donde la clave sea el codigo y el descuento el valor
    foreach ($descuentos as $desc) {
        $descuentos_obj[strtoupper($desc->codigo)] = $desc->descuento;
    }

    if (array_key_exists($codigo, $descuentos_obj)) {
        return response()->json([
            'valido' => true,
            'porcentaje' => $descuentos_obj[$codigo]
        ]);
    } else {
        return response()->json([
            'valido' => false,
            'mensaje' => 'Código inválido'
        ], 400);
    }
});

Route::get('/ver_carrito', function () {
    // Verificar si el usuario está autenticado
    if (Cookie::get('usuario') == null) {
        return redirect()->route('entrar');
    }
    if(Cookie::get('comprador') != 'true'){
        return redirect()->route('ver_usuario', ['mensaje' => 'siendo vendedor no puedes comprar']);
    }

    // Obtener el texto plano de la cookie
    $carrito = Cookie::get('carrito', ''); // Ejemplo: "2:5;1:8;3:12;"

    // Separar los pedidos por producto
    $items = $carrito ? explode(';', trim($carrito, ';')) : [];

    $carrito_obj = [];
    foreach ($items as $item) {
        if (empty($item))
            continue;
        list($cant, $producto_id) = explode(':', $item);
        $producto_db = Elemento::get_elemento($producto_id);

        if ($producto_db) {
            $carrito_obj[] = [
                'cantidad' => (int) $cant,
                'producto_id' => (int) $producto_id,
                'nombre' => $producto_db->nombre,
                'precio' => $producto_db->precio,
                'precio_descento' => $producto_db->precio_descuento,
                'tienda' => $producto_db->tienda,
                'imagen' => $producto_db->imagen,
            ];
        }
    }

    return view('carrito', ['carrito' => $carrito_obj]);
})->name('ver_carrito');

Route::get('/usuario', function () {
    // Verificar si el usuario está autenticado
    if (Cookie::get('usuario') == null) {
        return redirect()->route('entrar');
    }
    if (Cookie::get('usuario') == 'admin@admin.com') {
        return redirect()->route('admin.admin');
    }
    // Obtener el ID del usuario desde la cookie
    $id_usuario = Cookie::get('id_usuario');
    //traemos nombre, apellido, correo   y si es un comprador traemos 
    $usuario = User::find($id_usuario);

    $mensaje = request('mensaje', ''); // Obtener el mensaje de la URL, si existe
    $error = request('error', ''); // Obtener el mensaje de error de la URL, si existe

    return view('usuario', [
        'usuario' => $usuario,
        'mensaje' => $mensaje,
        'error' => $error,
    ]);

})->name('ver_usuario');

Route::post('/realizar_pedido', function (Request $request) {
    // Verificar si el usuario está autenticado
    if (Cookie::get('usuario') == null) {
        return redirect()->route('entrar');
    }
    // Verificar si se ha enviado el formulario
   

    // Obtener el ID del usuario desde la cookie
    $id_usuario = Cookie::get('id_usuario');
    $precio = $request->total;
    // Realizar el Reserva de los objetos del carrito
    $carrito = Cookie::get('carrito', ''); // Ejemplo: "2:5;1:8;3:12;"

    Pedido::realizar_pedido($id_usuario, $carrito);

    // Redirigir al usuario a su perfil con un mensaje de éxito
    return redirect()->route('ver_pedidos')->with('mensaje', 'Pedido realizado con éxito.');
})->name('realizar_pedido');

Route::get('/ver_pedidos', function () {
    // Verificar si el usuario está autenticado
    if (Cookie::get('usuario') == null) {
        return redirect()->route('entrar');
    }
    // Obtener el ID del usuario desde la cookie
    $id_usuario = Cookie::get('id_usuario');
    //traemos nombre, apellido, correo   
    $usuario = User::find($id_usuario);

    $pedidos = Pedido::get_pedidos_usuario_para_pedidos($id_usuario);

    //ahora sacamos los datos de los elementos de cada pedido

    //para eso hay que sacar el primer id de cada pedido  con el ya sabemos que tienda es
    $tiendas = [];
    foreach ($pedidos as $key => $pedido) {
        $elementos = explode(':', $pedido->elementos)[0]; //separamos los elementos del pedido
        $tienda = Tienda::get_tienda_id_prod($elementos);
        array_push($tiendas, $tienda);
    }


    return view('ver_pedidos', [
        'usuario' => $usuario,
        'pedidos' => $pedidos,
        'tiendas' => $tiendas,
        'mensaje' => request('mensaje', ''), // Obtener el mensaje de la URL, si existe
    ]);

})->name('ver_pedidos');

Route::get('/ver_tienda/{id}', function ($id) {
    $tienda = Tienda::get_tienda_id_tienda($id);
    $productos = Elemento::get_elementos_tienda($id);
    $posts = Post::traer_posts_tienda($id);
    if (!$tienda) {
        abort(404);
    }
    return view('ver_tienda', ['tienda' => $tienda, 'productos' => $productos, 'posts'=> $posts]);
})->name('ver_tienda');

Route::get('/ver_ofertas', function () {
    $tiendas = explode(',', $_GET['tiendas']);
    $ofertas = [];

    foreach ($tiendas as $tienda) {
        array_push($ofertas, Elemento::get_elementos_tienda($tienda));
    }
   
    
    

    return view('ver_ofertas', [
        'productos' => $ofertas,
    ]);
});

Route::fallback(function () {
    return redirect()->route('ubicacion');
});