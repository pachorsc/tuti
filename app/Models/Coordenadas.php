<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

// por ahora la aplicaccion solo funciona en granada capital por lo que no filtrará primero por comunidad, así que comprobaremos todas las tiendas
class Coordenadas extends Model
{
    public static function coordenada_por_direccion($direccion)
    {
        $geocoder = new \OpenCage\Geocoder\Geocoder(env('OPENCAGE_API_KEY'));

        $result = $geocoder->geocode($direccion, ['language' => 'es', 'countrycode' => 'es']);

        if ($result && $result['total_results'] > 0) {
            $first = $result['results'][0];
            $coord=  $first['geometry']['lng'] . ';' . $first['geometry']['lat'];
            
        } else {
            
            return null;
        }
        return $coord;
    }
    
    public static function top10_tiendas_cercanas($posicion_usuario = '-3.60667;37.18817')
    {
        
        if (is_null($posicion_usuario) || $posicion_usuario == '') {
            // Si no se proporciona una posición, se usa una posición por defecto
            $posicion_usuario = '-3.60667;37.18817'; // Granada, España
        }
        $posicion_usuario = explode(';', $posicion_usuario);


        $longitud_usuario = $posicion_usuario[0];
        $latitud_usuario = $posicion_usuario[1];

        //saco todas las coordenadas de las tiendas
        $coordenadas = DB::table('tienda')->select('id', 'coordenada', 'nombre', 'imagen')->get();
        $tiendas = [];
        foreach ($coordenadas as $tienda) {
            $coordenada = explode(';', $tienda->coordenada);
            $longitud = $coordenada[0];
            $latitud = $coordenada[1];

            // Calculo la distancia entre la tienda y el usuario
            $distancia = self::distanciaHaversine($latitud, $longitud, $latitud_usuario, $longitud_usuario);

            // Almaceno la tienda y su distancia
            array_push($tiendas, [
                'id' => $tienda->id,
                'nombre' => $tienda->nombre,
                'imagen' => $tienda->imagen,
                'distancia' => $distancia
            ]);


        }
        // Ordenar las tiendas por distancia de menor a mayor
        usort($tiendas, function($a, $b) {
            return $a['distancia'] <=> $b['distancia'];
        });
        
        // Devolver solo los IDs de las 10 tiendas más cercanas
        return array_slice($tiendas, 0, 10);
    }
    
    public static function distanciaHaversine($lat1, $lon1, $lat2, $lon2)
        {
            $radioTierra = 6371; // Radio de la Tierra en km

            $deltaLat = deg2rad($lat2 - $lat1);
            $deltaLon = deg2rad($lon2 - $lon1);

            $a = sin($deltaLat / 2) * sin($deltaLat / 2) +
                cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
                sin($deltaLon / 2) * sin($deltaLon / 2);

            $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
            return $radioTierra * $c; // Distancia en km
        }
}