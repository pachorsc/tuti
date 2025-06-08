<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Elemento extends Model
{
    protected $table = 'elemento';
    static function get_elementos_tienda($id_tienda)
    {
        //seleccionar todos los elementos de la tienda
        return DB::table('elemento')
            ->where('tienda', $id_tienda)
            ->get();

    }
    static function delete_elemento($id_elemento)
    {
        //tambien hay que eliminar la imagen del elemento en la carpeta de imagenes
        $elemento_imagen = DB::table('elemento')
            ->select('imagen')
            ->where('id', $id_elemento)
            ->first();

     
        if (file_exists($elemento_imagen->imagen)) {
            unlink($elemento_imagen->imagen);
        }
        //primero hay que eliminar segun de la tabla de servicios o productos
        // Intenta eliminar en ambas tablas, solo una tendrá el ID
        DB::table('servicio')->where('id', $id_elemento)->delete();
        DB::table('producto')->where('id', $id_elemento)->delete();
        // eliminar elemento
        DB::table('elemento')
            ->where('id', $id_elemento)
            ->delete();
    }

    static function update_elemento($request, $id_usuario, $is_producto){
        // Actualizar el elemento
        //si la imagen no es null, hay que eliminar la imagen anterior y guardar la nueva
        if ($request->hasFile('imagen')) {
            // Obtener la imagen anterior
            $elemento = DB::table('elemento')
                ->select('imagen')
                ->where('id', $request->id)
                ->first();

            // Eliminar la imagen anterior si existe
            if (file_exists($elemento->imagen)) {
                unlink($elemento->imagen);
            }
            //obtenemos el nombre de la tienda con e id_usuario

            $tienda_id = DB::table('dueno')
                ->where('id', $id_usuario)
                ->value('tienda');

            $tienda_nombre = DB::table('tienda')
                ->where('id', $tienda_id)
                ->value('nombre');
            
            // Reemplazar espacios por guiones bajos en el nombre de la tienda
            $tienda_nombre = str_replace(' ', '_', $tienda_nombre); // Reemplaza espacios por guiones bajos

            // Guardar la nueva imagen
            $nombreArchivo = 'elemento_' . str_replace(' ', '_', $request->nombre) . '.' . $request->imagen->getClientOriginalExtension();
            if($is_producto) {
                $carpeta = 'productos';
            } else {
                $carpeta = 'servicios';
            }
            //nombre de la carpeta de la tienda
            
            $carpeta_tienda = 'images/tiendas/' .$tienda_nombre.'_'. $id_usuario . '/' . $carpeta. '/';

            $request->imagen->move($carpeta_tienda, $nombreArchivo);
            $request->imagen = $carpeta_tienda . $nombreArchivo;
        } else {
            // Si no hay nueva imagen, mantener la anterior
            $request->imagen = DB::table('elemento')
                ->where('id', $request->id)
                ->value('imagen');
        }
        // Actualizar el elemento 
        DB::table('elemento')
            ->where('id', $request->id)
            ->update([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'precio' => $request->precio,
                'precio_descuento' => $request->precio_descuento,
                'imagen' => $request->imagen,
            ]);
            if ($is_producto) {
                // Actualizar la tabla producto
                Producto::update_producto($request);
            } else {
                // Actualizar la tabla servicio
                Servicio::update_servicio($request);
            }
    }
    static function get_elemento($id_elemento)
    {
        // Obtener el elemento por su ID
        return DB::table('elemento')
            ->where('id', $id_elemento)
            ->first();
    }
    static function get_elementos($id_tienda)
    {
        // Obtener todos los elementos de la tienda
        return DB::table('elemento')
            ->whereIn('id', $id_tienda)
            ->get();
    }
    static function get_elemento_tienda($id_elemento){
        //dependiendo si es un producto o un servicio, se obtiene el elemento de la tabla correspondiente
        $is_producto = DB::table('producto')
            ->where('id', $id_elemento)
            ->exists();
        if ($is_producto) {
            $elemento = DB::table('producto')
                ->join('elemento', 'producto.id', '=', 'elemento.id')
                ->select('producto.*', 'elemento.*')
                ->where('elemento.id',$id_elemento)
                ->first();
        } else {
            $elemento = DB::table('servicio')
                ->join('elemento', 'servicio.id', '=', 'elemento.id')
                ->select('servicio.*', 'elemento.*')
                ->where('elemento.id',$id_elemento)
                ->first();
        }
        $datos = [$elemento, $is_producto];
        
        return $datos;
    }
}
