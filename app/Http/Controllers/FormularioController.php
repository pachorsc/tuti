<?php

namespace App\Http\Controllers;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FormularioController extends Controller
{
    public function enviarFormulario(Request $request)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'correo' => 'required|email',
            'telefono' => 'required|string|max:15',
        ]);

        try {
            // Enviar correo
            Mail::send('/contacto', $datos, function ($message) use ($datos) {
                $message->to('destinatario@correo.com') // Cambia por tu correo
                        ->subject('Nuevo formulario enviado');
            });

            return view('contacto', ['success' => true]); // Enviar booleano a la vista
        } catch (Exception $e) {
            return view('contacto', ['success' => false]); // Enviar booleano a la vista
        }
    }
}