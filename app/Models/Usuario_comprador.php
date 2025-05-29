<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class usuario_comprador extends Model
{
    public static function existe($correo) {
        $usuarioExistente = DB::table('usuario')->where('usuario.correo',$correo)->first();

        if ($usuarioExistente) {
            // El correo ya existe en la base de datos
            return true;
        }else {
            // El correo no existe en la base de datos
            return false;
        }
    }
    public static function insertar(Request $request)
    {
        // Validar los datos del formulario
        DB::table('usuario')->insert([
            'fecha_creacion' => date('Y-m-d H:i:s'),
            'nombre' => $request->input('nombre'),
            'apellido' => $request->input('apellido'),
            'correo' => $request->input('correo'),
            'contrasena' => bcrypt($request->input('contrasena')),
        ]);

        $id_usuario = DB::table('usuario')->select('id')->where('correo', $request->input('correo'))->first()->id;

        DB::table('comprador')->insert([
        'id' => $id_usuario,
        'telefono' => $request->input('telefono'),
        'tipo' => 0,
        ]);
        
    }
}
