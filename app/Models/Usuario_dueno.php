<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Usuario_dueno extends Model
{
    public static function insertar_usuario($nombre, $apellido, $correo, $password) {
        // Validar los datos del formulario
        DB::table('usuario')->insert([
            'fecha_creacion' => date('Y-m-d H:i:s'),
            'nombre' => $nombre,
            'apellido' => $apellido,
            'correo' => $correo,
            'contrasena' => bcrypt($password),
        ]);

        $id_usuario = DB::table('usuario')->select('id')->where('correo', $correo)->first()->id;

        DB::table('dueno')->insert([
            'id' => $id_usuario,
        ]);
    }
    public static function get_datos($id_usuario) {
        $datos = DB::table('usuario')
            ->join('dueno', 'usuario.id', '=', 'dueno.id')
            ->select('usuario.*', 'dueno.*')
            ->where('usuario.id', $id_usuario)
            ->first();
        dd($datos);
        return $datos;
    }
    public static function get_tienda($id_usuario) {
        $tienda = DB::table('dueno')
            ->select( 'dueno.tienda')
            ->where('dueno.id', $id_usuario)
            ->first();

        
        return $tienda;
    }
}
