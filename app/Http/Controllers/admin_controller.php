<?php

namespace App\Http\Controllers;

use App\Models\Usuario_dueno;
use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\User;
use App\Models\Tienda;



class admin_controller extends Controller
{
    function Anadir_usuario() {
        return view('admin.anadir_usuario');
    }
    function insertar_usuario( Request $request) {  
        $nombre = $request->input('nombre');
        $apellidos = $request->input('apellido');
        $email = $request->input('correo');
        $password = $request->input('password');

        // Aquí puedes agregar la lógica para insertar el usuario en la base de datos
        Usuario_dueno::insertar_usuario($nombre, $apellidos, $email, $password);

        return redirect()->route('admin.admin')->with('success', 'Usuario creado correctamente.');
    }
    function anadir_categoria(){
        return view('admin.anadir_categoria');
    }
    function insertar_categoria( Request $request) {  
        $request->validate([
            'nombre' => 'required|string',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        //quitamos espacios por si acaso
        $nombre = trim($request->input('nombre'));
        $imagen = $request->file('imagen');

        // Aquí puedes agregar la lógica para insertar la categoría en la base de datos
        Categoria::insertar_categoria($nombre, $imagen);

        return redirect()->route('admin.admin')->with('success', 'Categoria creada correctamente.');
    }
    

    function Eliminar_Usuarios() {
        $usuarios = User::usuarios_list();
        return view('admin.eliminar_usuario', ['usuarios' => $usuarios]);
    }
    function delete_usuarios(Request $request) {
        $ids = $request->input('usuarios'); // array de ID's a eliminar

        User::delete_usuarios($ids);
        return redirect()->route('admin.admin')->with('success', 'Usuario eliminado correctamente.');
    }

    function tienda_eliminar_post() {
        $tiendas = Tienda::tienda_list_id_nombre();
        return view('admin.tienda_eliminar_post', ['tiendas' => $tiendas]);
    }

    function eliminar_post_tienda(Request $request) {
        $id_tienda = $request->input('tienda_id');
        $posts = Tienda::traer_posts_tienda($id_tienda);
        
        return view('admin.eliminar_post_tienda', ['posts' => $posts]);

    }

    function delete_post(Request $request) {
        //Eliminar el post
        
        Tienda::delete_post($request->post_id);

        return redirect()->route('admin.admin')->with('success', 'Post eliminado correctamente.');
    }

    function eliminar_categoria() {
        $categorias = Categoria::getCategorias();
        return view('admin.eliminar_categoria', ['categorias' => $categorias]);
    }

    function delete_categoria(Request $request) {
        $id_categoria = $request->input('categoria_id');
        
        //Eliminar la categoria
        $is_elimidado = Categoria::delete_categoria($id_categoria);

        if ($is_elimidado) {
            return redirect()->route('admin.admin')->with('success', 'Categoria eliminada correctamente.');
        } else {
            return redirect()->route('admin.admin')->with('error', 'No se pudo eliminar la categoria porque está en uso.');
        }
    }

    function eliminar_producto() {
        $tiendas = Tienda::tienda_list_id_nombre();
        return view('admin.eliminar_producto', ['tiendas' => $tiendas]);
    }
}
