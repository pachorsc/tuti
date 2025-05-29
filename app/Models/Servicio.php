<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Servicio extends Model
{
    public static function insert_servicio($servicio, $id_usuario)
    {
        //hay que guardar las imagenes en la carpeta de la tienda, si no existe se crea la carpeta
        $tienda_nombre = Tienda::get_tienda($id_usuario)->nombre;
        
        $tienda_nombre = str_replace(' ', '_', $tienda_nombre); // Reemplaza espacios por guiones bajos
        $carpeta_tienda = public_path('images/tiendas/' . $tienda_nombre.'_'.$id_usuario.'/servicios');
        
        if (!file_exists($carpeta_tienda)) {
            mkdir($carpeta_tienda); // Crea la carpeta si no existe
        }
        // Guardar la imagen del servicio
        if ($servicio->imagen) {
            $servicio->nombre = str_replace(' ', '_', $servicio->nombre); // Reemplaza espacios por guiones bajos
            $nombreArchivo = 'servicio_' . $servicio->nombre . '.' . $servicio->imagen->getClientOriginalExtension();
            $servicio->imagen->move($carpeta_tienda, $nombreArchivo);
            $servicio->imagen = 'images/tiendas/' . $tienda_nombre .'_'.$id_usuario. '/servicios/' . $nombreArchivo;

        } else {
            $servicio->imagen = ''; // Si no hay imagen, asignar null
        }

        //hay que sacar la tienda que tiene el usuario
        $tienda = Tienda::get_id_tienda($id_usuario);

        // Insertar en la tabla elemento y obtener el id
        $elemento_id = DB::table('elemento')->insertGetId([
            'nombre' => $servicio->nombre,
            'tienda' => $tienda,
            'descripcion' => $servicio->descripcion,
            'precio' => $servicio->precio,
            'imagen' => $servicio->imagen,
        ]);

        // Ahora insertas el post y guardas el id del elemento
        DB::table('servicio')->insert([
            'id' => $elemento_id,
            'horario_disp' => $servicio->horario,
        ]);

    }
}
