<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\JsonResponse;

class UsuariosController extends Controller
{
    /**
     * @OA\Get(
     *     path="/Usuarios",
     *     description="Muestra todos los usuarios",
     *     tags={"Usuarios"},
     *     operationId="index",
     *     @OA\Response(
     *          response="200", description="Todos los usuarios"
     *      ),
     *      @OA\Response(
     *          response="500", description="Server Error"
     *      ),
     * )
     */

    public function index()
    {
        $usuarios = Usuario::select('idUsuario', 'nombre', 'apellido', 'correo', 'contrasena', 'idMunicipio', 'rol')->get();
        return response()->json($usuarios, JsonResponse::HTTP_OK);
    }

    /**
     * @OA\Post(
     *     path="/Usuarios",
     *     tags={"Usuarios"},
     *     description="Crea un nuevo usuarios en la base de datos",
     *     operationId="store",
     *     @OA\Response(
     *         response=200,
     *         description="Usuario agregado correctamente"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Ha ingresado uno o varios campos erroneamente o hay un problema con el servidor"
     *     ),
     *     @OA\RequestBody(
     *         description="Datos a ingresar en la base de datos",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="idUsuario",
     *                     description="ID del usuario a ingresar en la base de datos",
     *                     type="integer",
     *                     format="int64"
     *                 ),
     *                 @OA\Property(
     *                     property="nombre",
     *                     description="Nombre del usuario",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="apellido",
     *                     description="Apellido del usuario",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="correo",
     *                     description="Correo del usuario",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="contrasena",
     *                     description="Contraseña del usuario",
     *                     type="string"
     *                 ),
     *                @OA\Property(
     *                     property="idMunicipio",
     *                     description="Municipio del usuario",
     *                     type="integer",
     *                     format="int64"
     *                 ),
     *                 @OA\Property(
     *                     property="rol",
     *                     description="Rol del usuario",
     *                     type="integer",
     *                     format="int64"
     *                 ),
     *             )
     *         )
     *     )
     * )
     */

    

    public function store(Request $request)
    {
        $usuario = Usuario::create(request()->all());
    }

    /**
     * @OA\Get(
     *     path="/Usuarios/{idUsuario}",
     *     description="Muestra la informacion del usuario",
     *     tags={"Usuarios"},
     *     @OA\Response(
     *          response="200", description="Muestra la informacion del usuario"
     *      ),
     *     @OA\Response(
     *          response="404", description="No se ha encontrado el municipio"
     *      ),
     *      @OA\Response(
     *          response="500", description="Server Error"
     *      ),
     *      @OA\Parameter(
     *         name="idMunicipio",
     *         in="path",
     *         description="id del municipio en el que buscar informacion",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *      )
     * )
     */

    
    public function show($id)
    {
        $usuario = Usuario::select('idUsuario', 'nombre', 'apellido', 'correo', 'contrasena', 'idMunicipio', 'rol')->where('idUsuario', $id)->firstOrFail();
        return response()->json($usuario, JsonResponse::HTTP_OK);  
    }

    /**
     * @OA\Get(
     *     path="/Usuarios/getIdFromCorreo/{correo}",
     *     description="Muestra el id de los usuarios a través del correo",
     *     tags={"Usuarios"},
     *     @OA\Response(
     *          response="200", description="Muestra el id de los usuarios a través del correo"
     *      ),
     *      @OA\Response(
     *          response="500", description="Server Error"
     *      ),
     *      @OA\Parameter(
     *         name="correo",
     *         in="path",
     *         description="Correo del usuario del cual sacar el id",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *      )
     * )
     */

    
    public function getIdFromCorreo($correo)
    {
        $usuario = Usuario::select('idUsuario')->where('correo', $correo)->firstOrFail();
        return response()->json($usuario, JsonResponse::HTTP_OK);
    }

    /**
     * @OA\Put(
     *     path="/Usuarios/{Usuario}",
     *     tags={"Usuarios"},
     *     description="Modifica un usuario en la base de datos",
     *     operationId="store",
     *     @OA\Response(
     *         response=200,
     *         description="Usuario modificado correctamente"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Ha ingresado uno o varios campos erroneamente o hay un problema con el servidor"
     *     ),
     *     @OA\Parameter(
     *         name="idUsuario",
     *         in="path",
     *         description="id del usuario a modificar",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *      ),
     *     @OA\RequestBody(
     *         description="Datos a ingresar en la base de datos",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="idUsuario",
     *                     description="ID del usuario a ingresar en la base de datos",
     *                     type="integer",
     *                     format="int64"
     *                 ),
     *                 @OA\Property(
     *                     property="nombre",
     *                     description="Nombre del usuario",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="apellidos",
     *                     description="Apellido del usuario",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="correo",
     *                     description="Correo del usuario",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="contraseña",
     *                     description="Contraseña del usuario",
     *                     type="string"
     *                 ),
     *                @OA\Property(
     *                     property="idMunicipio",
     *                     description="Municipio del usuario",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="rol",
     *                     description="Rol del usuario",
     *                     type="string"
     *                 ),
     *             )
     *         )
     *     )
     * )
     */

    
    public function update(Request $request, $id)
    {
        try {
            $updateUsuario = Usuario::where('idUsuario', $id)->update($request->all());
            return response()->json($updateUsuario, JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @OA\Delete(
     *     path="/Usuarios/{idUsuario}",
     *     description="Elimina el municipio elegido",
     *     tags={"Usuarios"},
     *     @OA\Response(
     *          response="200", description="Se ha eliminado correctamente"
     *      ),
     *      @OA\Response(
     *          response="404", description="No se ha encontrado el usuario con el ID seleccionado"
     *      ),
     *      @OA\Response(
     *          response="500", description="Server Error"
     *      ),
     *      @OA\Parameter(
     *         name="idUsuarios",
     *         in="path",
     *         description="id del usuario a eliminar",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *      )
     * )
     */
    
    public function destroy($id)
    {
        try{
            $usuario = Usuario::where('idUsuario', $id)->delete();
            return response()->json(JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
             return $e->getMessage();
        }
    }


    /**
     * @OA\Get(
     *     path="/Usuarios/existeUsuario/{correo}",
     *     description="Comprueba si un usuario existe",
     *     tags={"Usuarios"},
     *     @OA\Response(
     *          response="200", description="Muestra si hay un usuario en la base de datos"
     *      ),
     *     @OA\Response(
     *          response="404", description="No se ha encontrado el usuario"
     *      ),
     *      @OA\Response(
     *          response="500", description="Server Error"
     *      ),
     *      @OA\Parameter(
     *         name="correo",
     *         in="path",
     *         description="correo de un usuario",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *      )
     * )
     */
    
    public function existeUsuario($usuario)
    {
        $existe = false;
        $usuario = Usuario::where('correo', $usuario)->get();
        //Checkeamos un valor cualquiera por comprobar si existe
        if(count($usuario) == 1)
        {
            $existe = true;
        }
        return $existe;
    }
    
    

    public function checkPassword($usuario, $password)
    {
        $correcto = false;
        if($password === Usuario::where('correo', $usuario)->value('contrasena'))
        {
            $correcto = true;
        }
        
        return $correcto;
    }

    /**
     * 
     * @OA\Get(
     *     path="/Usuarios/isAdmin/{idUsuario}",
     *     description="Comprueba es admin",
     *     tags={"Usuarios"},
     *     @OA\Response(
     *          response="200", description="Muestra si un usuario es admin"
     *      ),
     *     @OA\Response(
     *          response="404", description="No se ha encontrado el usuario"
     *      ),
     *      @OA\Response(
     *          response="500", description="Server Error"
     *      ),
     *      @OA\Parameter(
     *         name="idUsuario",
     *         in="path",
     *         description="idUsuario",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *      )
     * )
     */

    public function isAdmin($usuario)
    {
        $isAdmin = false;
        if(Usuario::where('idUsuario', $usuario)->value('rol') == 1)
        {
            $isAdmin = true;
        }
        return $isAdmin;
    }

    public function createUser(Request $usuario)
    {

        return Usuario::create([
            'nombre' => $usuario->nombre,
            'apellido' => $usuario->apellido,
            'correo' => $usuario->correo,
            'contrasena' => $usuario->contrasena,
            'idMunicipio' => $usuario->idMunicipio,
            'rol' => 0,
        ]);

    }

        
}
