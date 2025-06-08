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
            $from = "pachoweb@pachoweb.es";
            $to = "pachoweb@pachoweb.es";
            $subject = "Formulario Contacto Pachoweb";
            $message = "nombre: " . $datos['nombre'] . " " . $datos['apellidos'] . " Correo: " . $datos['correo'] . " telefono: " . $datos['telefono'];
            $headers = "From: " . $from . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/plain; charset=UTF-8\r\n";
            mail($to, $subject, $message, $headers);

            return view('contacto', ['success' => true]); // Enviar booleano a la vista
        } catch (Exception $e) {
            return view('contacto', ['success' => false]); // Enviar booleano a la vista
        }
    }
}