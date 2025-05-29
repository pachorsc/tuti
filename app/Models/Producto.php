<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Producto extends Model
{
    static public function insert_servicio($producto, $id_usuario) {
         //hay que guardar las imagenes en la carpeta de la tienda, si no existe se crea la carpeta
        $tienda_nombre = Tienda::get_tienda($id_usuario)->nombre;
        
        $tienda_nombre = str_replace(' ', '_', $tienda_nombre); // Reemplaza espacios por guiones bajos
        $carpeta_tienda = public_path('images/tiendas/' . $tienda_nombre.'_'.$id_usuario.'/productos');
        
        if (!file_exists($carpeta_tienda)) {
            mkdir($carpeta_tienda); // Crea la carpeta si no existe
        }
        // Guardar la imagen del servicio
        if ($producto->imagen) {

            $nombreArchivo = 'producto_' . $producto->nombre . '.' . $producto->imagen->getClientOriginalExtension();
            $producto->imagen->move($carpeta_tienda, $nombreArchivo);
            $producto->imagen = 'images/tiendas/' . $tienda_nombre .'_'.$id_usuario. '/productos/' . $nombreArchivo;

        } else {
            $producto->imagen = ''; // Si no hay imagen, asignar null
        }

        //hay que sacar la tienda que tiene el usuario
        $tienda = Tienda::get_id_tienda($id_usuario);

        // Insertar en la tabla elemento y obtener el id
        $elemento_id = DB::table('elemento')->insertGetId([
            'nombre' => $producto->nombre,
            'tienda' => $tienda,
            'descripcion' => $producto->descripcion,
            'precio' => $producto->precio,
            'imagen' => $producto->imagen,
        ]);

        // Ahora insertas el post y guardas el id del elemento
        DB::table('producto')->insert([
            'id' => $elemento_id,
            'cantidad' => $producto->cantidad,
        ]);
    } 
}
