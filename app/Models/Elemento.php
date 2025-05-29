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
        //primero hay que eliminar segun de la tabla de servicios o productos
        // Intenta eliminar en ambas tablas, solo una tendrá el ID
        DB::table('servicio')->where('id', $id_elemento)->delete();
        DB::table('producto')->where('id', $id_elemento)->delete();

        // Elimina el elemento principal
        // eliminar elemento
        DB::table('elemento')
            ->where('id', $id_elemento)
            ->delete();
    }
}
