<?php
// filepath: c:\xampp\htdocs\tuti3\app\Models\User.php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'usuario';

    protected $fillable = [
        'correo',
        'contrasena',
    ];

    protected $hidden = [
        'contrasena',
        'remember_token',
    ];
    public static function iniciar_sesion($correo, $contrasena)
    {
        // Buscar usuario por correo
        $usuario = self::where('correo', $correo)->first();

        // Si existe y la contraseña es correcta
        if ($usuario && Hash::check($contrasena, $usuario->contrasena)) {
            return true;
        }

        // Si no existe o la contraseña es incorrecta
        return false;
    }

    public static function usuarios_list()
    {
        // Obtener todos los usuarios
        $usuarios = DB::table('usuario')
            ->select('id', 'nombre', 'correo')
            ->get();

        // Obtener todos los IDs de usuarios que son dueños
        $duenos = DB::table('dueno')->pluck('id')->toArray();

        $usuariosArray = [];
        // tipo usuario segun si está en la tabla dueno o no
        foreach ($usuarios as $usuario) {
            $usuarioArr = (array) $usuario;
            $usuarioArr['tipo'] = in_array($usuario->id, $duenos) ? 'Vendedor' : 'Comprador';
            $usuariosArray[] = $usuarioArr;
        }
        
        return $usuariosArray;
    }
    public static function tipo_usuario($id_usuario)
    {
        // Buscar si el usuario está en la tabla dueno
        $dueno = DB::table('dueno')->where('id', $id_usuario)->first();

        if ($dueno) {
            return 'Vendedor';
        } else {
            return 'Comprador';
        }
    }

    public static function delete_usuarios($usuarios_id)
    {
        $duenos = DB::table('dueno')->pluck('id')->toArray();
        foreach ($usuarios_id as $id) {
            // Eliminar el usuario de la tabla 'comprador' o 'dueno' según corresponda
            if (in_array($id, $duenos)) {
                DB::table('dueno')->where('id', $id)->delete();
            } else {
                DB::table('comprador')->where('id', $id)->delete();
            }
            // Eliminar el usuario de la tabla 'usuario'
            DB::table('usuario')->where('id', $id)->delete();

        }
    }

    public static function find($id)
    {
        // Buscar usuario por ID
        return DB::table('usuario')
            ->where('id', $id)
            ->select('id', 'nombre', 'apellido', 'correo')
            ->first();
    }

    public static function update_usuario($id, $nombre, $apellido, $correo, $contrasena)
    {
        if($contrasena == null || $contrasena == '') {
            // Si la contraseña es nula o vacía, no la actualizamos
            $contrasena = DB::table('usuario')
                ->where('id', $id)
                ->value('contrasena'); // Obtener la contraseña actual
        } else {
            // Si se proporciona una nueva contraseña, la actualizamos
            $contrasena = Hash::make($contrasena); // Hacemos la encriptacion de la nueva contraseña
        }
        // Actualizar el usuario
        DB::table('usuario')
            ->where('id', $id)
            ->update([
                'nombre' => $nombre,
                'apellido' => $apellido,
                'correo' => $correo,
                'contrasena' => $contrasena
            ]);
    }
}