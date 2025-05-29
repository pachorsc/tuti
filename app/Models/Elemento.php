<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Elemento extends Model
{
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
}
