<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormularioController;
use App\Http\Controllers\Blog_controller;
use App\Http\Controllers\Registro_controlador;
use App\Http\Controllers\Inicio_sesion_controller;
use App\Http\Controllers\Tiendas_cercanas_controller;
use App\Http\Controllers\admin_controller;
use App\Http\Controllers\vendedor_controller;


Route::get('/', function () {
    
    return view('welcome');
})->name('inicio');

Route::get('/admin', function () {
    if (Cookie::get('admin') != 'true') {
        return redirect()->route('inicio');
    }
    return view('admin.admin');
})->name('admin.admin');


// Rutas para el controlador admin
Route::match(['get', 'post'], '/admin/{action}', function($action, \Illuminate\Http\Request $request) {
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
Route::match(['get', 'post'], '/vendedor/{action}', function($action, \Illuminate\Http\Request $request) {
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

Route::post('/', [Tiendas_cercanas_controller::class, 'tiendas_cercanas'])->name('tiendas_cercanas');

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
    if (Cookie::get('usuario') != null) {
        return redirect()->route('inicio');
    }
    return view('registro');
});
Route::post('/registrar', [Registro_controlador::class,'store'])->name('registrar');

Route::get('/entrar', function () {
    if (Cookie::get('usuario') != null) {
        return redirect()->route('inicio');
    }
    return view('entrar');
})->name('entrar');
Route::post('/inicio_sesion', [Inicio_sesion_controller::class,'iniciar_sesion'])->name('inicio_sesion');

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