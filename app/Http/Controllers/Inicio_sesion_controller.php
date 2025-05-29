<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Cookie;

class Inicio_sesion_controller
{
    public function iniciar_sesion(Request $request)
    {
        if (User::iniciar_sesion($request->correo, $request->contrasena)) {
            // Correcto
            Cookie::queue('usuario', $request->correo, 60); // 60 minutos
            if ($request->correo =='admin@admin.com'){
                Cookie::queue('admin', 'true', 60); 
                return redirect()->route('admin.admin');
            } else {
                //funcion para ver si estña en la tabla vendedor segun el id
                $id_usuario = User::where('correo', $request->correo)->value('id'); // Obtener el ID del usuario
                $usuario = User::tipo_usuario($id_usuario); // Obtener el tipo de usuario

                //sacamos el tipo de usuario y creamos la cookie segun sea 
                if ($usuario == 'Vendedor') {
                    Cookie::queue('vendedor', 'true', 60); 
                } else Cookie::queue('comprador', 'true', 60);

                //creo una cookie con el id del usuario para poder usarlo en cualquier cambio
                Cookie::queue('id_usuario', $id_usuario, 60); // 60 minutos
                return redirect()->route('blog');
            }

        } else {
            // Incorrecto
            return back()->withErrors([
                'correo' => 'usuario o contraseña incorrectos.',
            ]);
        }


    }
}