<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;
use \App\Models\Coordenadas;
use App\Models\Post;



class Tiendas_cercanas_controller extends Controller
{
     static public function tiendas_cercanas(Request $request)
    {
        $coordenada = $request->input('coordenada', '-3.60667;37.18817'); // valor por defecto si no hay coordenada
        $tiendas = Coordenadas::top10_tiendas_cercanas($coordenada);
        // con las tiendas cercanas, ya puedo mostrar las publicaciones y productos de las tienddas cdrcanas
        $tiendas_ids = array_column(array_slice($tiendas, 0, 10), 'id');
        //ahora saco las 3 publicaciones necesarias para el inicio
        $posts = Post::sacar_Posts_inicio($tiendas_ids);

        //sacamos las 6 categorias para el inicio deben ser de las tiendas cercanas
        $categorias = Categoria::getCategorias_cercanas($tiendas_ids);
        
        //ahora saco los productos de las tiendas cercanas 
        $productos = Producto::sacar_Productos_inicio($tiendas_ids); //productos con descuentos y sin descuentos cercanos
        //solo necesito 3 tiendas cercanas
        $tiendas = array_slice($tiendas, 0, 3);
        $datos = [
            'tiendas' => $tiendas_ids,
            'posts' => $posts,
            'categorias' => $categorias,
            'productos' => $productos,
            'tiendas_cercanas' => $tiendas  
        ];
        
        return($datos);
    }
}
