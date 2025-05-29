<?php

namespace App\Http\Controllers;

use App\Models\Usuario_comprador;

use Illuminate\Http\Request;

class Registro_controlador extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    // Validar los datos del formulario
    $validatedData = $request->validate([
        'nombre' => 'required|string|max:255',
        'apellido' => 'required|string|max:255',
        'correo' => 'required|email|unique:usuario,correo',
        'contrasena' => 'required|string|min:8',
    ]);

    // Verificar si el correo ya existe
    if (Usuario_comprador::existe($validatedData['correo'])) {
        return view('registro', ['error' => "El correo ya existe"]);
    }
        
    // Insertar el usuario en la base de datos
    Usuario_comprador::insertar($request);

    // Redirigir con un mensaje de éxito
    return redirect()->route('entrar')->with('success', 'Usuario registrado con éxito.');

    //->with('success', 'Usuario registrado con éxito.');

    }
}
