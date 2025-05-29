<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Post extends Model
{
    public static function getPost($id)
    {   
        $post = DB::table('post')
            ->join('tienda', 'post.tienda', '=', 'tienda.id') // Relación con tienda
            ->join('categorias', 'tienda.tipo', '=', 'categorias.id') // Relación con categorias
            ->select(
                'post.id',
                'categorias.nombre',
                'post.titulo',
                'post.contenido',
                'post.imagen'
            )
            ->where('post.id', $id)
            ->first(); // Obtiene un solo resultado

            
            // Separa los títulos, contenidos e imágenes por ';;;'
            $titulo = explode(';;;', $post->titulo);
            $contenido = explode(';;;', $post->contenido);
            $imagen = explode(';;;', trim($post->imagen));

            // Procesa los '***' en cada imagen
            foreach ($imagen as $i => $img) {
                if (strpos($img, '***') !== false) {
                    $imagen[$i] = explode('***', trim($img));
                }
            }

            $post->titulo = $titulo;
            $post->contenido = $contenido;
            $post->imagen = $imagen;
            
            return $post;
    }
    public static function getPostsWithCategorias($perPage = 2)
    {
        return DB::table('post')
            ->join('tienda', 'post.tienda', '=', 'tienda.id') // Relación con tienda
            ->join('categorias', 'tienda.tipo', '=', 'categorias.id') // Relación con categorias
            ->select(
                'post.id',
                'categorias.nombre',
                DB::raw("SUBSTRING_INDEX(post.titulo, ';;;', 1) as titulo"), // Obtiene el texto antes de ';;;'
                DB::raw("SUBSTRING(post.contenido, 1, 120) as contenido"),   // Obtiene los primeros 120 caracteres
                DB::raw("SUBSTRING_INDEX(post.imagen, ';;;', 1) as imagen")  // Obtiene el texto antes de ';;;'
            )
            ->paginate($perPage); // Pagina los resultados
    }
    public static function getPostFiltreado($categoria, $perPage = 2)
    {
        return DB::table('post')
            ->join('tienda', 'post.tienda', '=', 'tienda.id') // Relación con tienda
            ->join('categorias', 'tienda.tipo', '=', 'categorias.id') // Relación con categorias
            ->select(
                'post.id',
                'categorias.nombre',
                DB::raw("SUBSTRING_INDEX(post.titulo, ';;;', 1) as titulo"), // Obtiene el texto antes de ';;;'
                DB::raw("SUBSTRING(post.contenido, 1, 120) as contenido"),   // Obtiene los primeros 120 caracteres
                DB::raw("SUBSTRING_INDEX(post.imagen, ';;;', 1) as imagen")  // Obtiene el texto antes de ';;;'
            )
            ->where('categorias.nombre', $categoria)
            ->paginate($perPage);
    }
    //esto va a sacar los primeros 3 post que necesiamos en la pantalla de inicio
    public static function sacar_Posts_inicio(array $tiendas)
    {
        $posts =[];
        for ($i=0; $i < 2; $i++)  {
            $post = DB::table('post')
            ->select(
                'post.id',
                DB::raw("SUBSTRING_INDEX(post.titulo, ';;;', 1) as titulo"), // Obtiene el texto antes de ';;;'
                DB::raw("SUBSTRING_INDEX(post.imagen, ';;;', 1) as imagen")  
            )
            ->where('post.tienda', $tiendas[$i])
            ->first();
        array_push($posts, $post);
        }
        return $posts;
    }

    public static function num_post_tienda($id_usuario) {

        $num_posts = DB::table('post')
        ->join('tienda', 'post.tienda', '=', 'tienda.id')
        ->join('dueno', 'tienda.id', '=', 'dueno.tienda') // <-- usa 'dueno' aquí
        ->where('dueno.id', $id_usuario)
        ->count();
        

    return $num_posts;
    }

    public static function insert_post($id_usuario, $titulos, $parrafos, $imagenes) {
        // Obtenemos el id de la tienda del usuario
        $tienda = DB::table('dueno')
            ->join('tienda', 'dueno.tienda', '=', 'tienda.id')
            ->where('dueno.id', $id_usuario)
            ->select('tienda.id')
            ->first();

        // Insertamos el post en la base de datos
        DB::table('post')->insert([
            'tienda' => $tienda->id,
            'titulo' => $titulos,
            'contenido' => $parrafos,
            'imagen' => $imagenes,
        ]);
    }
}
