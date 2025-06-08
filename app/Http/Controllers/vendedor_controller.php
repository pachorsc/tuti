<?php

namespace App\Http\Controllers;
use App\Models\Tienda;
use \App\Models\Usuario_dueno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use \App\Models\Categoria;
use \App\Models\Coordenadas;
use App\Models\Post;
use App\Models\Servicio;
use App\Models\Producto;
use App\Models\Elemento;
use Illuminate\Support\Facades\DB;
use App\Models\Pedido;


class vendedor_controller extends Controller
{
    function tienda()
    {
        $id_usuario = Cookie::get('id_usuario');
        // verificamos si tiene tienda
        $tienda_vendedor = Usuario_dueno::get_tienda($id_usuario);


        return view('dueno.dueno_menu', ['tienda' => $tienda_vendedor->tienda]);
    }
    function crear_tienda()
    {
        $categorias = Categoria::getCategorias_nombre_id();

        return view('dueno.crear_tienda', ['categorias' => $categorias]);
    }
    function registro_tienda(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string',
            'tipo' => 'required|integer',
            'horario' => 'required|string',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'telefono' => 'required|string|max:9'
        ]);

        Tienda::registro_tienda($request);
        // Redirigir a la vista de la tienda
        return redirect('/vendedor/tienda')->with('success', 'Tienda creada correctamente.');
    }

    function editar_tienda()
    {
        $id_usuario = Cookie::get('id_usuario');
        // verificamos si tiene tienda
        $tienda_vendedor = Tienda::get_tienda_id_usu($id_usuario);
        $categorias = Categoria::getCategorias_nombre_id();

        return view('dueno.editar_tienda', ['tienda' => $tienda_vendedor, 'categorias' => $categorias]);
    }
    function update_tienda(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string',
            'tipo' => 'required|integer',
            'horario' => 'required|string',
            'imagen' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'telefono' => 'required|string|max:9'
        ]);
        //si la direccion no es valida vuelve al formulario
        $coordenada = Coordenadas::coordenada_por_direccion($request->input('direccion'));
        if ($coordenada === null) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'La dirección no es válida. Por favor, escríbela correctamente.');
        }

        Tienda::editar_tienda($request);
        // Redirigir a la vista de la tienda
        return redirect('/vendedor/tienda')->with('success', 'Tienda editada correctamente.');
    }
    function hacer_post()
    {
        return view('dueno.hacer_post');
    }

    function insert_post(Request $request)
    {
        $request->validate([
            'titulo*' => 'required|string|max:255',
            'contenido*' => 'required|string',
            'imagen*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        //Primero vamos a guardar en orden las imagenes del post
        $id_usuario = Cookie::get('id_usuario');

        //numero de posts que tiene la tienda
        $n_posts = Post::num_post_tienda($id_usuario);



        //creamos la carpeta del post dentro de la carpeta de la tienda
        // Obtén el nombre de la tienda del usuario
        $tienda = Tienda::get_tienda_id_usu($id_usuario);
        $nombre_tienda = str_replace(' ', '_', $tienda->nombre);

        // Crea la carpeta del post dentro de la carpeta de la tienda
        $carpeta = public_path('images/tiendas/' . $nombre_tienda . '_' . $id_usuario . '/post_' . $n_posts);
        // Verifica si la carpeta ya existe, si no, la crea
        if (!file_exists($carpeta)) {
            mkdir($carpeta);
        }


        // Guardamos las imagenes del post 

        $imagenes = '';
        $ruta_relativa = 'images/tiendas/' . $nombre_tienda . '_' . $id_usuario . '/post_' . $n_posts . '/';


        if ($request->hasFile('imagen')) {
            $contador = 0;

            foreach ($request->file('imagen') as $imagen) {
                // Guardamos la imagen en la carpeta del post
                $extension = $imagen->getClientOriginalExtension();
                $nombreArchivo = 'f' . $contador . '.' . $extension;
                $imagen->move($carpeta, $nombreArchivo);
                $imagenes .= $ruta_relativa . $nombreArchivo . ';;;';
                $contador++;
            }
        }
        if ($request->hasFile('imagen2')) {
            //añadimos esa imagen2 al string de imagenes justamente antes del primer ;;;

            $imagen2 = $request->file('imagen2');
            $extension2 = $imagen2->getClientOriginalExtension();

            $nombreArchivo2 = 'f_2.' . $extension2;
            // Añadimos la imagen2 al string de imagenes justo antes del primer ';;;'
            $pos = strpos($imagenes, ';;;');
            if ($pos !== false) {
                $imagenes = substr($imagenes, 0, $pos) . '***' . $ruta_relativa . $nombreArchivo2 . substr($imagenes, $pos);
            } else {
                $imagenes .= '***' . $ruta_relativa . $nombreArchivo2;
            }
            $imagen2->move($carpeta, $nombreArchivo2);
        }


        //ahora concatenamos todos los titulos y parrafos
        $titulos = '';
        $parrafos = '';
        if ($request->has('titulo')) {
            foreach ($request->input('titulo') as $titulo) {
                $titulos .= $titulo . ';;;';
            }
        }
        if ($request->has('parrafo')) {
            foreach ($request->input('parrafo') as $parrafo) {
                $parrafos .= $parrafo . ';;;';
            }
        }

        $titulos = rtrim($titulos, ';;;');
        $parrafos = rtrim($parrafos, ';;;');
        $imagenes = rtrim($imagenes, ';;;');
        //ahora insertamos los titulos, parrafos e imagenes en la base de datos
        Post::insert_post($id_usuario, $titulos, $parrafos, $imagenes);
        // Redirigir a la vista de la tienda
        return redirect('/vendedor/tienda')->with('success', 'Post creado correctamente.');
    }

    function nuevo_servicio()
    {
        return view('dueno.nuevo_servicio');
    }

    function insert_servicio(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|string',
            'horario' => 'required|string',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $id_usuario = Cookie::get('id_usuario');

        // Guardar el servicio en la base de datos
        Servicio::insert_servicio($request, $id_usuario);

        // Redirigir a la vista de la tienda
        return redirect('/vendedor/tienda')->with('success', 'Servicio creado correctamente.');
    }

    function nuevo_producto()
    {
        return view('dueno.nuevo_producto');
    }
    function insert_producto(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|string',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'cantidad' => 'required|integer|min:1',
        ]);
        $id_usuario = Cookie::get('id_usuario');

        // Guardar el producto en la base de datos
        Producto::insert_servicio($request);


        // Redirigir a la vista de la tienda
        return redirect('/vendedor/tienda')->with('success', 'Producto creado correctamente.');
    }

    function eliminar_elemento()
    {
        //sacamos la lista de elementos que tiene la tienda
        $id_usuario = Cookie::get('id_usuario');
        $tienda_vendedor = Usuario_dueno::get_tienda($id_usuario);



        $elementos = Elemento::get_elementos_tienda($tienda_vendedor->tienda);
        return view('dueno.eliminar_elemento')->with('elementos', $elementos);
    }

    function detete_elemento(Request $request)
    {
        // Validar el ID del elemento
        $request->validate([
            'elementos_seleccionados' => 'required|exists:elemento,id',
        ]);
        foreach ($request->elementos_seleccionados as $value) {
            // Eliminar el elemento de la base de datos
            Elemento::delete_elemento($value);
        }

        // Redirigir a la vista de eliminar elemento con un mensaje de éxito
        return redirect('/vendedor/tienda')->with('success', 'Elemento(s) eliminado(s) correctamente.');
    }

    function editar_elemento()
    {
        //sacamos la lista de elementos que tiene la tienda
        $id_usuario = Cookie::get('id_usuario');
        $tienda_vendedor = Usuario_dueno::get_tienda($id_usuario);

        $elementos = Elemento::get_elementos_tienda($tienda_vendedor->tienda);
        return view('dueno.editar_elemento')->with('elementos', $elementos);
    }

    function editar_elemento_form($elemento_id)
    {
        // Validar el ID del elemento
        $elemento = Elemento::get_elemento($elemento_id);
        if (!$elemento) {
            return redirect('/vendedor/tienda')->with('error', 'Elemento no encontrado.');
        }
        // Verificar si el elemento es un producto o un servicio y hacer join para obtener todos los datos
        if (DB::table('producto')->where('id', $elemento->id)->exists()) {
            $es_producto = true;
            $elemento = DB::table('elemento')
                ->join('producto', 'elemento.id', '=', 'producto.id')
                ->select('elemento.*', 'producto.cantidad', 'producto.color')
                ->where('elemento.id', $elemento_id)
                ->first();
        } else {
            $es_producto = false;
            $elemento = DB::table('elemento')
                ->join('servicio', 'elemento.id', '=', 'servicio.id')
                ->select('elemento.*', 'servicio.horario_disp')
                ->where('elemento.id', $elemento_id)
                ->first();
        }


        return view('dueno.editar_elemento_form', compact('elemento', 'es_producto'));

    }

    function update_elemento(Request $request)
    {
        $id_usuario = Cookie::get('id_usuario');
        $is_producto = $request->has('cantidad');

        // Validar los datos del formulario segun si es producto o servicio
        if ($is_producto) {
            // Es un producto
            $request->validate([
                'nombre' => 'required|string|max:255',
                'descripcion' => 'required|string',
                'precio' => 'required|string',
                'imagen' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'cantidad' => 'required|integer|min:1',
                'color' => 'nullable|string|max:255',
            ]);
        } else {
            // Es un servicio
            $request->validate([
                'nombre' => 'required|string|max:255',
                'descripcion' => 'required|string',
                'precio' => 'required|string',
                'imagen' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'horario_disp' => 'required|string',
            ]);
        }

        Elemento::update_elemento($request, $id_usuario, $is_producto);
        // Redirigir a la vista de la tienda
        return redirect('/vendedor/tienda')->with('success', 'Elemento actualizado correctamente.');
    }

    function pedidos_pendientes()
    {

        // Obtener los pedidos pendientes del vendedor
        $id_usuario = Cookie::get('id_usuario');
        $id_tienda = Usuario_dueno::get_tienda($id_usuario)->tienda;
        $pedidos = Pedido::get_pedidos_vendedor($id_tienda);

        $elementos = [];
        $pedidos_fin = []; // este es el array que vamos a devolver a la vista con los datos necesarios

        foreach ($pedidos as $value) {
            $elementos_str = rtrim($value->elementos, ';');
            $id_productos_raw = explode(';', $elementos_str);
            $id_productos = array_map(function ($item) {
                return explode(':', $item)[0]; // Obtenemos solo el ID del producto
            }, $id_productos_raw);
            array_push($elementos, $id_productos);
            //el total va a ser el precio del producto por la cantidad
            $total = 0;
            //sacamos solo las id de los productos
            $id_productos = array_map(function ($item) {
                return explode(':', $item)[0]; // Obtenemos solo el ID del producto
            }, $id_productos_raw);
            //ahora usamos una funcion para sacar el precio de cada producto
            $precio_total = array_map(function ($id_producto) {
                $elemento = Elemento::get_elemento($id_producto);
                return $elemento->precio_descuento ?? $elemento->precio; 
            }, $id_productos);
            $cantidad = array_map(function ($item) {
                return explode(':', $item)[1]; // Obtenemos solo la cantidad del producto
            }, $id_productos_raw);
            $total = array_sum(array_map(function ($precio, $cantidad) {
                return $precio * $cantidad;
            }, $precio_total, $cantidad));

            //hacemos un array con los nombres de los productos
            $nombre_productos = array_map(function ($item) {
               $elemento = Elemento::get_elemento($item);
               return $elemento->nombre;
            }, $id_productos_raw);

            $nombre_cliente = DB::table('usuario')
                ->where('id', $value->usuario)
                ->value('nombre');

            $pedido = [
                'id' => $value->id,
                'fecha' => $value->fecha_pedido,
                'estado' => $value->estado,
                'nombre_cliente' => $nombre_cliente,
                'nombre_productos' => $nombre_productos, // Mantenemos el formato original
                'cantidad_productos' => $cantidad, // Mantenemos el formato original
                'total' => $total,
            ];
            array_push($pedidos_fin, $pedido);

        }
        return view('dueno.pedidos_pendientes')->with('pedidos', $pedidos_fin);
    }

    function pedidos_listos(Request $request)
    {
        // Validar el ID del pedido
        $request->validate([
            'listos' => 'required',
        ]);

        // Actualizar el estado del pedido a "listo"
        Pedido::update_estado_pedido_listo($request->listos);

        // Redirigir a la vista de pedidos pendientes con un mensaje de éxito
        return $this->pedidos_pendientes()->with('success', 'Pedido marcado como listo.');
    }
}

