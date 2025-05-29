<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria; // Asegúrate de importar el modelo correcto
use App\Models\Post;

class Blog_controller extends Controller
{
    public function trear_categorias_tienda()
    {
        $categorias = Categoria::getCategorias(); // Obtén las categorías
        $posts = Post::getPostsWithCategorias(2); // Obtén los posts con sus categorías

        foreach ($posts as $post) {
        // Procesa el campo imagen para separar por ***
        if (strpos($post->imagen, '***') !== false) {
            $imagenes = explode('***', $post->imagen);
            $post->imagen = $imagenes[0]; // Imagen principal
            $post->imagen_destacada = $imagenes[1]; // Imagen secundaria, si la necesitas
        }
}

        // Retorna la vista con los datos
        return view('blog', data: ['categorias' => $categorias, 'posts' => $posts]);
    }
    public function traer_posts_categoria($categoria)
    {
        $categorias = Categoria::getCategorias(); // Obtén las categorías

        $post_filtrado = Post::getPostFiltreado($categoria, 3); // Obtén los posts filtrados por categoría

        

        return view('blog', data: ['categorias' => $categorias, 'posts' => $post_filtrado]);

    }
    public function traer_post($id)
    {
        $post = Post::getPost($id); // Obtén el post por ID

        
        return view('post', data: ['post' => $post]);

    }
}
