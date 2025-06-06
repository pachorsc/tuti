<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;

class Pedido extends Model
{
    static function realizar_pedido($id_usuario, $carrito)
    {
        
        //hay que hacer un pedido segun la tienda de cada producto
        //primero pasamos el carrito a un objeto igual que hice en el carrito
        $carrito = rtrim($carrito, ';'); // le quietamos el ultmo ;

        $carrito = explode(';', $carrito); // separamos los productos por ;

        $por_tienda = []; // Array para agrupar productos por tienda

        foreach ($carrito as $item) {
            list($cantidad, $producto_id) = explode(':', $item);
            $producto =Elemento::find($producto_id);
            if ($producto) {
                $tienda_id = $producto->tienda;
                if (!isset($por_tienda[$tienda_id])) {
                    $por_tienda[$tienda_id] = [];
                }
                if ($producto->precio_descuento){
                    $precio_producto = $producto->precio_descuento;
                } else {
                    $precio_producto = $producto->precio;
                }
                $por_tienda[$tienda_id][] = [
                    'producto_id' => $producto_id,
                    'cantidad' => $cantidad,
                    'precio_f' => $precio_producto,
                    
                ];
            }
        }
        
        
        // Ahora podemos procesar los pedidos por tienda y hacer el pedido
        foreach ($por_tienda as $tienda_id => $items) {
            $elementos = '';
            $precio_total = 0;

            foreach ($items as $item) {
                $elementos .= $item['producto_id'] . ':' . $item['cantidad'] . ';'; // Formato: producto_id:cantidad;
                $precio_total += $item['cantidad'] * $item['precio_f']; // Calcular el precio total del pedido
            }
            // Insertar el pedido en la base de datos
            DB::table('pedido')->insert([
                'usuario' => $id_usuario,
                'elementos' => $elementos, // le quitamos el ultimo ;
                'precio_total' => $precio_total,
                'estado' => false, // Estado del pedido (false = pendiente)
            ]);
        }
        // Limpiar el carrito del usuario
        Cookie::queue(Cookie::forget('carrito'));
    }
    static function get_pedidos_usuario_para_pedidos($id_usuario)
    {
        // Obtener los pedidos del usuario
        return DB::table('pedido')
            ->where('usuario', $id_usuario)
            ->orderBy('fecha_pedido', 'desc')
            ->get();
    }
}
