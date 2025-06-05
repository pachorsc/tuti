<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Descuento extends Model
{
    static public  function get_descuentos() {
       $hoy = Carbon::now()->toDateString(); // Ejemplo: "2025-06-05"

        return DB::table('descuento')
        ->select('codigo', 'descuento')
        ->where('fecha_fin','>=',$hoy)
        ->get();
    }
}
