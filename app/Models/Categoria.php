<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
class Categoria extends Model
{
    public static function getCategorias()
    {
        return DB::table('categorias')
            ->select('id', 'nombre', 'imagen')
            ->orderBy('nombre', 'asc') // Ordena por nombre
            //->inRandomOrder() // Selecciona los registros en orden aleatorio
            ->get();
    }
    public static function getCategorias_nombre_id()
    {
        return DB::table('categorias')
            ->select('nombre', 'id')
            //->inRandomOrder() // Selecciona los registros en orden aleatorio
            ->limit(5)        // Limita el resultado a 5 registros
            ->orderBy('nombre', 'asc') // Ordena por nombre
            ->get();
    }

    public static function getCategorias_cercanas(array $tiendas)
    {
        $categorias = [];

    foreach ($tiendas as $tiendaId) {
        $categoria = DB::table('categorias')
            ->join('tienda', 'categorias.id', '=', 'tienda.tipo')
            ->select('categorias.nombre', 'categorias.imagen')
            ->where('tienda.id', $tiendaId)
            ->first();

        // Si existe y no está repetida, la agregamos
        if ($categoria && !array_key_exists($categoria->nombre, $categorias)) {
            $categorias[$categoria->nombre] = [
                'nombre' => $categoria->nombre,
                'imagen' => $categoria->imagen,
            ];
        }
    }

    // Devolver solo los valores (sin claves)
    return array_values($categorias);
        
    }
    public static function insertar_categoria($nombre, $imagen)
    {
        //guardamos la imagen en la carpeta public/images/categorias
        $extension = $imagen->getClientOriginalExtension();
        $nombreArchivo = str_replace(' ', '_', strtolower($nombre)) . '.' . $extension;

        // Guardar la imagen en public/images/categorias
        $imagen->move(public_path('images/categorias'), $nombreArchivo);

        DB::table('categorias')->insert([
            //la primera letra de cada palabra en mayuscula
            //el resto en minuscula
            'nombre' => ucfirst(strtolower($nombre)),
            'imagen' => 'images/categorias/'.$nombreArchivo,            
        ]);
    }

    public static function delete_categoria($id_categoria)
    {
        //si la categoria está siendo usada no la eliminamos
        $tienda = DB::table('tienda')->where('tipo', $id_categoria)->first();
        if ($tienda) {
            // Si la categoría está siendo usada por una tienda, no la eliminamos
            return false;
        }
        // Primero, obtenemos la categoría para eliminar su imagen
        $categoria = DB::table('categorias')->where('id', $id_categoria)->first();

        if ($categoria) {
            // Eliminamos la imagen del servidor
            if (Storage::exists($categoria->imagen)) {
                Storage::delete($categoria->imagen);
            }

            // Luego, eliminamos la categoría de la base de datos
            DB::table('categorias')->where('id', $id_categoria)->delete();
        }
        return true; // Retornamos true si la categoría fue eliminada correctamente
    }
}
