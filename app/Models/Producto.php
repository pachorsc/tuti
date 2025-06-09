<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class Producto extends Model
{
    static public function insert_servicio($producto) {
        //hay que guardar las imagenes en la carpeta de la tienda, si no existe se crea la carpeta
        $id_usuario = Cookie::get('id_usuario');
        $tienda_nombre = Tienda::get_tienda($id_usuario)->nombre;
        
        $tienda_nombre = str_replace(' ', '_', $tienda_nombre); // Reemplaza espacios por guiones bajos
        $carpeta_tienda = public_path('images/tiendas/' . $tienda_nombre.'_'.$id_usuario.'/productos');
        
        if (!file_exists($carpeta_tienda)) {
            mkdir($carpeta_tienda); // Crea la carpeta si no existe
        }
        // Guardar la imagen del servicio
        if ($producto->imagen) {
            $producto->nombre = str_replace(' ', '_', $producto->nombre); // Reemplaza espacios por guiones bajos
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
    static public function update_producto($producto) {
        DB::table('producto')
                    ->where('id', $producto->id)
                    ->update([
                        'cantidad' => $producto->cantidad,
                        'color' => $producto->color,
                    ]);
    }
    static public function sacar_Productos_inicio($tiendas) {
        $productos = DB::table('elemento')
            ->join('tienda','elemento.tienda', '=', 'tienda.id') // Relación con tienda
            ->select(
                'elemento.id',
                'elemento.nombre',
                'elemento.descripcion',
                'elemento.precio',
                'elemento.precio_descuento',
                'elemento.imagen',
                'tienda.nombre as tienda_nombre'
            )
            ->whereIn('tienda.id', $tiendas)
            ->where('elemento.precio_descuento', '>', 0) // Filtrar productos con descuento
            ->inRandomOrder() // Orden aleatorio
            ->get();
            
        return $productos;
    }
    
}
