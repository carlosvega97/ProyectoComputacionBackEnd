<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\JsonResponse;

class UsuariosController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::select('idUsuario', 'nombre', 'apellido', 'correo', 'contrasena', 'idMunicipio', 'rol')->get();
        return response()->json($usuarios, JsonResponse::HTTP_OK);
    }

    public function store(Request $request)
    {
        $usuario = Usuario::create(request()->all());
    }

    
    public function show($id)
    {
        $usuario = Usuario::select('idUsuario', 'nombre', 'apellido', 'correo', 'contrasena', 'idMunicipio', 'rol')->where('idUsuario', $id)->firstOrFail();
        return response()->json($usuario, JsonResponse::HTTP_OK);
        
        
        
    }

    
    public function getIdFromCorreo($correo)
    {
        $usuario = Usuario::select('idUsuario')->where('correo', $correo)->firstOrFail();
        return response()->json($usuario, JsonResponse::HTTP_OK);
    }

    
    public function update(Request $request, $id)
    {
        try {
            $updateUsuario = Usuario::where('idUsuario', $id)->update($request->all());
            return response()->json($updateUsuario, JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    
    public function destroy($id)
    {
        try{
            $usuario = Usuario::where('idUsuario', $id)->delete();
            return response()->json(JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
             return $e->getMessage();
        }
    }

    
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
