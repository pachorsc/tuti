<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Coordenadas;

class Tienda extends Model
{
    static function tienda_list_id_nombre()
    {
        $tienda = DB::table('tienda')
            ->select('id', 'nombre')
            ->get();

        return $tienda;
    }
    static function traer_posts_tienda($id_tienda)
    {
        $posts = DB::table('post')
            ->select('id', DB::raw("SUBSTRING_INDEX(titulo, ';;;', 1) as titulo"))
            ->where('tienda', $id_tienda)
            ->get();

        return $posts;
    }
    static function delete_post($id)
    {
        DB::table('post')
            ->where('id', $id)
            ->delete();
    }
    public static function registro_tienda(Request $request)
    {

        $id_usuario = $request->cookie('id_usuario');
        $nombre = $request->input('nombre');
        $direccion = $request->input('direccion');
        $horario = $request->input('horario');
        $categoria = $request->input('tipo');
        $imagen = $request->file('imagen');
        $telefono = $request->file('telefono');

        // Guardar la imagen

        //primero se crea la carpteta de la tienda
        $nom_carpeta_tienda = $nombre . '_' . $id_usuario;
        $nom_carpeta_tienda = str_replace(' ', '_', $nom_carpeta_tienda); // Reemplaza espacios por guiones bajos

        $carpeta_tienda = public_path('images/tiendas/' . $nom_carpeta_tienda);
        if (!file_exists($carpeta_tienda)) {
            mkdir($carpeta_tienda);
        }

        $nombreArchivo = 'principal.' . $imagen->getClientOriginalExtension();
        $imagen->move(public_path('images/tiendas/' . $nom_carpeta_tienda), $nombreArchivo);
        $ruta_imagen = 'images/tiendas/' . $nom_carpeta_tienda . '/' . $nombreArchivo;

        //ahora sacamos la coordenada del local con la direccion
        $coordenada = Coordenadas::coordenada_por_direccion($direccion);



        // Insertar la tienda en la base de datos
        DB::table('tienda')->insert([
            'nombre' => $nombre,
            'direccion' => $direccion,
            'coordenada' => $coordenada,
            'horario' => $horario,
            'tipo' => $categoria,
            'imagen' => $ruta_imagen,
            'calificacion' => 0,
            'telefono' => $telefono
        ]);
        // Obtener el ID de la tienda recién creada
        $id_tienda = DB::getPdo()->lastInsertId();
        // update de tienda en la tabla dueno
        DB::table('dueno')
            ->where('id', $id_usuario)
            ->update(['tienda' => $id_tienda]);

    }
    public static function get_tienda_id_tienda($id_tienda)
    {
        return DB::table('tienda')
            ->select('nombre', 'direccion', 'horario', 'tipo', 'imagen')
            ->where('tienda.id', $id_tienda)
            ->first();
    }
    public static function get_tienda_id_prod($elemento_id)
    {
        $tienda = DB::table('tienda')
            ->join('elemento', 'tienda.id', '=', 'elemento.tienda')
            ->select('tienda.nombre', 'tienda.direccion', 'tienda.horario', 'tienda.imagen', 'tienda.telefono')
            ->where('elemento.id', $elemento_id)
            ->first();


        return $tienda;
    }
    public static function editar_tienda(Request $request)
    {
        $id_usuario = $request->cookie('id_usuario');
        $nombre_nuevo = $request->input('nombre');
        $direccion_nuevo = $request->input('direccion');
        $horario_nuevo = $request->input('horario');
        $categoria_nuevo = $request->input('tipo');
        $imagen_nuevo = $request->file('imagen');
        $telefono_nuevo = $request->input('telefono');

        $tienda_fin = [];


        // primero miramos que datos cambiaron
        $antiegua_tienda = DB::table('tienda')
            ->join('dueno', 'tienda.id', '=', 'dueno.tienda')
            ->select('nombre', 'direccion', 'coordenada', 'horario', 'tipo', 'imagen', 'telefono')
            ->where('dueno.id', $id_usuario)
            ->first();
        if ($antiegua_tienda->nombre != $nombre_nuevo) {
            //en caso de que cambie el nombre hay que cambiar el nombre de la carpeta
            $carpeta_antigua = public_path('images/tiendas/' . str_replace(' ', '_', $antiegua_tienda->nombre . '_' . $id_usuario));
            $carpeta_nueva = public_path('images/tiendas/' . str_replace(' ', '_', $nombre_nuevo . '_' . $id_usuario));

            if (file_exists($carpeta_antigua)) {
                rename($carpeta_antigua, $carpeta_nueva);
            }
            $tienda_fin['nombre'] = $nombre_nuevo;

        } else {
            $tienda_fin['nombre'] = $antiegua_tienda->nombre;
        }

        if ($antiegua_tienda->direccion != $direccion_nuevo) {
            //en caso de que cambie la direccion hay que cambiar la coordenada
            $tienda_fin['coordenada'] = Coordenadas::coordenada_por_direccion($direccion_nuevo);

            if ($tienda_fin['coordenada'] === null) {
                // Redirigir de vuelta al formulario con error
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'La dirección no es válida. Por favor, escríbela correctamente.');
            }
            $tienda_fin['direccion'] = $direccion_nuevo;
        } else {
            $tienda_fin['direccion'] = $antiegua_tienda->direccion;

            $tienda_fin['coordenada'] = $antiegua_tienda->coordenada;
        }

        if ($antiegua_tienda->horario != $horario_nuevo) {
            $tienda_fin['horario'] = $horario_nuevo;
        } else {
            $tienda_fin['horario'] = $antiegua_tienda->horario;
        }

        if ($antiegua_tienda->tipo != $categoria_nuevo) {
            $tienda_fin['tipo'] = $categoria_nuevo;
        } else {
            $tienda_fin['tipo'] = $antiegua_tienda->tipo;
        }

        if ($imagen_nuevo != null) {
            // Guardar la nueva imagen
            $nombreArchivo = 'principal.' . $imagen_nuevo->getClientOriginalExtension();
            //
            $nombre_carpeta_nueva = str_replace(' ', '_', $tienda_fin['nombre'] . '_' . $id_usuario);

            $imagen_nuevo->move(public_path('images/tiendas/' . $nombre_carpeta_nueva), $nombreArchivo);

            $ruta_imagen = 'images/tiendas/' . $nombre_carpeta_nueva . '/' . $nombreArchivo;
            $tienda_fin['imagen'] = $ruta_imagen;
        } else {
            $tienda_fin['imagen'] = $antiegua_tienda->imagen;
        }
        if ($antiegua_tienda->telefono != $telefono_nuevo) {
            $tienda_fin['telefono'] = $telefono_nuevo;
        } else {
            $tienda_fin['telefono'] = $antiegua_tienda->telefono;
        }

        // Actualizar la tienda en la base de datos
        DB::table('tienda')
            ->join('dueno', 'tienda.id', '=', 'dueno.tienda')
            ->where('dueno.id', $id_usuario)
            ->update($tienda_fin);
    }
    public static function get_id_tienda($id_usuario)
    {
        $tienda = DB::table('dueno')
            ->where('id', $id_usuario)
            ->value('tienda');

        return $tienda;
    }

    public static function get_tienda_id_usu($id_usuario)
    {
        return DB::table('tienda')
            ->join('dueno', 'tienda.id', '=', 'dueno.tienda')
            ->where('dueno.id', $id_usuario)
            ->select('tienda.*')
            ->first();
    }

    public static function traer_productos_tienda($id_tienda)
    {
        $productos = DB::table('elemento')
            ->select('id', 'nombre')
            ->where('tienda', $id_tienda)
            ->get();

        return $productos;
    }

    public static function delete_producto($id_producto)
    {
        //eliminamos las imagenes del producto de nuestro sistema de archivos 
        $imagen = DB::table('elemento')
            ->select('imagen')
            ->where('id', $id_producto)
            ->first();

        //eliminamos la imagen con la ruta
        $ruta_imagen = public_path($imagen->imagen);

        if (file_exists($ruta_imagen)) {
            unlink($ruta_imagen);
        }

        // Eliminar de producto o servicio según corresponda
        if (DB::table('producto')->where('id', $id_producto)->exists())
         {
            DB::table('producto')->where('id', $id_producto)->delete();
        }

        if (DB::table('servicio')->where('id', $id_producto)->exists())
         {
            DB::table('servicio')->where('id', $id_producto)->delete();
        }
        // Eliminar de la tabla elemento
        DB::table('elemento')->where('id', $id_producto)->delete();
    }
}
