<?php

namespace App\Http\Controllers;

use App\Models\Comunidad;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class ComunidadesController extends Controller
{
    /**
     * @OA\Get(
     *     path="/Comunidades",
     *     description="Muestra todas las comunidades",
     *     tags={"Comunidades"},
     *     operationId="index",
     *     @OA\Response(
     *          response="200", description="Todas las comunidades"
     *      ),
     *      @OA\Response(
     *          response="500", description="Server Error"
     *      ),
     * )
     */
    public function index()
    {
        $comunidades = Comunidad::select('CODAUTO', 'AUTONOMIA', 'TEXTO_AUTONOMIA')->get();
        return response()->json($comunidades, JsonResponse::HTTP_OK);
    }
    
    /**
     * @OA\Post(
     *     path="/Comunidades",
     *     tags={"Comunidades"},
     *     description="Crea una nueva comunidad en la base de datos",
     *     operationId="store",
     *     @OA\Response(
     *         response=200,
     *         description="Comunidad agregada correctamente"
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
     *                     property="CODAUTO",
     *                     description="ID de la comunidad a ingresar en la base de datos",
     *                     type="integer",
     *                     format="int64"
     *                 ),
     *                 @OA\Property(
     *                     property="AUTONOMIA",
     *                     description="Nombre de la comunidad",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="TEXTO_AUTONOMIA",
     *                     description="Texto de la comunidad",
     *                     type="string"
     *                 ),
     *             )
     *         )
     *     )
     * )
     */
    
    public function store(Request $comunidad)
    {
        return Comunidad::create([
            'CODAUTO' => $comunidad->CODAUTO,
            'AUTONOMIA' => $comunidad->AUTONOMIA,
            'TEXTO_AUTONOMIA' => $comunidad->TEXTO_AUTONOMIA
        ]);
    }

    /**
     * @OA\Get(
     *     path="/Comunidades/{idComunidad}",
     *     description="Muestra la informacion de la comunidad",
     *     tags={"Comunidades"},
     *     @OA\Response(
     *          response="200", description="Muestra la informacion de la comunidad"
     *      ),
     *     @OA\Response(
     *          response="404", description="No se ha encontrado la comunidad"
     *      ),
     *      @OA\Response(
     *          response="500", description="Server Error"
     *      ),
     *      @OA\Parameter(
     *         name="idComunidad",
     *         in="path",
     *         description="id de la comunidad en el que buscar informacion",
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
        try{
            $comunidad = Comunidad::where('CODAUTO', $id)->firstOrFail();;
        } catch (\Throwable $th) {
            return false;
        }
        return response()->json($comunidad, JsonResponse::HTTP_OK);
    }

    /**
     * @OA\Put(
     *     path="/Comunidades/{idComunidad}",
     *     tags={"Comunidades"},
     *     description="modifica una comunidad en la base de datos",
     *     operationId="store",
     *     @OA\Response(
     *         response=200,
     *         description="Comunidad modificado correctamente"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Ha ingresado uno o varios campos erroneamente o hay un problema con el servidor"
     *     ),
     *     @OA\Parameter(
     *         name="idMunicipio",
     *         in="path",
     *         description="id de la comunidad a modificar",
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
     *                     property="CODAUTO",
     *                     description="ID de la comunidad a ingresar en la base de datos",
     *                     type="integer",
     *                     format="int64"
     *                 ),
     *                 @OA\Property(
     *                     property="AUTONOMIA",
     *                     description="Nombre de la comunidad",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="TEXTO_AUTONOMIA",
     *                     description="Texto de la comunidad",
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
            $updateComunidad = Comunidad::where('CODAUTO', $id)->update($request->all());
            return response()->json($updateComunidad, JsonResponse::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json($th, JsonResponse::HTTP_NOT_FOUND);
        }
    }

    /**
     * @OA\Delete(
     *     path="/Comunidades/{idComunidad}",
     *     description="Elimina la comunidad elegida",
     *     tags={"Comunidades"},
     *     @OA\Response(
     *          response="200", description="Se ha eliminado correctamente"
     *      ),
     *      @OA\Response(
     *          response="404", description="No se ha encontrado la comunidad con el ID seleccionado"
     *      ),
     *      @OA\Response(
     *          response="500", description="Server Error"
     *      ),
     *      @OA\Parameter(
     *         name="idComunidad",
     *         in="path",
     *         description="id de la comunidad a eliminar",
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
            $comunidad = Comunidad::where('CODAUTO', $id)->delete();
            return response()->json(JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
             return $e->getMessage();
        }
    }
}
