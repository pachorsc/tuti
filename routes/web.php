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

Route::get('/', function () {
    return view('coordenada'); //Longitud ; Latitud
})->name('ubicacion');

Route::post('/inicio', function (Request $request) {

    $datos = Tiendas_cercanas_controller::tiendas_cercanas($request);//saca id tiendas, posts y productos de las tiendas cercanas
    return view('welcome', ['datos' => $datos]);
})->name('inicio');

Route::get('/admin', function () {
    if (Cookie::get('admin') != 'true') {
        return redirect()->route('inicio');
    }
    return view('admin.admin');
})->name('admin.admin');


// Rutas para el controlador admin
Route::match(['get', 'post'], '/admin/{action}', function ($action, \Illuminate\Http\Request $request) {
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

Route::match(['get', 'post'], '/vendedor/{action}', function ($action, \Illuminate\Http\Request $request) {
    // Verificar si el usuario es admin
    if (Cookie::get('vendedor') !== 'true') {
        return redirect()->route('inicio');
    }

    $controller = app(vendedor_controller::class);
    if (method_exists($controller, $action)) {
        return app()->call([$controller, $action], ['request' => $request]);
    }
    abort(404);
})->name('admin_action');


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

Route::get('/producto/{nombre}/{id}', function ($nombre,$id) {
    
    $datos_producto = Elemento::get_elemento_tienda($id);
    $otros_productos = Elemento::get_elementos_tienda($datos_producto[0]->tienda);
    
    return view('producto', ['datos_producto' => $datos_producto[0],'otros_productos'=> $otros_productos ,'is_producto' => $datos_producto[1]]);
})->name('ver_producto');

Route::get('/reserva/{nombre}/{id}', function ($nombre,$id) {
    //pestña para reservar los productos o servicios
    
    return view('reserva', ['nombre'=>$nombre, 'id'=>$id]);
})->name('reserva');