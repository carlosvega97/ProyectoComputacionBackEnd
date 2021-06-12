<?php

namespace App\Http\Controllers;

use App\Models\Provincia;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\JsonResponse;

class ProvinciasController extends Controller
{
    /**
     * @OA\Get(
     *     path="/Provincias",
     *     description="Muestra todas las provincias",
     *     tags={"Provincias"},
     *     @OA\Response(
     *          response="200", description="Todas las provincias"
     *      ),
     *      @OA\Response(
     *          response="500", description="Server Error"
     *      ),
     * )
     */
    public function index()
    {
        $provincias = Provincia::select('CODPROV', 'NOMBRE', 'CODAUTO')->get();
        return response()->json($provincias, JsonResponse::HTTP_OK);
    }

    /**
     * @OA\Post(
     *     path="/Provincias",
     *     tags={"Provincias"},
     *     description="Crea una nueva provincia en la base de datos",
     *     operationId="store",
     *     @OA\Response(
     *         response=200,
     *         description="Provincia agregada correctamente"
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
     *                     property="CODPROV",
     *                     description="ID de la provincia a ingresar en la base de datos",
     *                     type="integer",
     *                     format="int64"
     *                 ),
     *                 @OA\Property(
     *                     property="NOMBRE",
     *                     description="Nombre de la provincia",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="CODAUTO",
     *                     description="Codigo de la comunidad autonoma a la que pertenece",
     *                     type="integer",
     *                     format="int64"
     *                 ),
     *             )
     *         )
     *     )
     * )
     */
    public function store(Request $provincia)
    {
        return Provincia::create([
            'CODPROV' => $provincia->CODPROV,
            'NOMBRE' => $provincia->NOMBRE,
            'CODAUTO' => $provincia->CODAUTO
        ]); 
    }

    /**
     * @OA\Get(
     *     path="/Provincias/{idProvincia}",
     *     description="Muestra la informacion de la provincia",
     *     tags={"Provincias"},
     *     @OA\Response(
     *          response="200", description="Muestra la informacion de la provincia"
     *      ),
     *     @OA\Response(
     *          response="404", description="No se ha encontrado la provincia"
     *      ),
     *      @OA\Response(
     *          response="500", description="Server Error"
     *      ),
     *      @OA\Parameter(
     *         name="idProvincia",
     *         in="path",
     *         description="id de la provincia en la que buscar informacion",
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
        $provincia = Provincia::select('CODPROV', 'NOMBRE', 'CODAUTO')->where('CODPROV', $id)->firstOrFail();
        return response()->json($provincia, JsonResponse::HTTP_OK);
    }

    /**
     * @OA\Get(
     *     path="/Provincias/showFromComunidad/{idProvincia}",
     *     description="Muestra la informacion de las provincias de la comunidad elegida",
     *     tags={"Provincias"},
     *     @OA\Response(
     *          response="200", description="Muestra la informacion de la provincia"
     *      ),
     *      @OA\Response(
     *          response="500", description="Server Error"
     *      ),
     *      @OA\Parameter(
     *         name="idComunidad",
     *         in="path",
     *         description="id de la comunidad en la que buscar provincias",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *      )
     * )
     */
    public function showFromComunidad($id)
    {
        $provincia = Provincia::where('CODAUTO', $id)->get();
        return response()->json($provincia, JsonResponse::HTTP_OK);
    }

    /**
     * @OA\Put(
     *     path="/Provincias/{idProvincia}",
     *     tags={"Provincias"},
     *     description="Crea una nueva provincia en la base de datos",
     *     operationId="store",
     *     @OA\Response(
     *         response=200,
     *         description="Provincia agregada correctamente"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Ha ingresado uno o varios campos erroneamente o hay un problema con el servidor"
     *     ),
     *     @OA\Parameter(
     *         name="idProvincia",
     *         in="path",
     *         description="id de la provincia a modificar",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *      ),
     *      @OA\RequestBody(
     *         description="Datos a modificar en la base de datos",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="CODPROV",
     *                     description="ID de la provincia a ingresar en la base de datos",
     *                     type="integer",
     *                     format="int64"
     *                 ),
     *                 @OA\Property(
     *                     property="NOMBRE",
     *                     description="Nombre de la provincia",
     *                     type="integer",
     *                     format="int64"
     *                 ),
     *                 @OA\Property(
     *                     property="CODAUTO",
     *                     description="Codigo de la comunidad autonoma a la que pertenece",
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
            $updateProvincia = Provincia::where('CODPROV', $id)->update($request->all());
            return response()->json($updateProvincia, JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @OA\Delete(
     *     path="/Provincias/{idProvincia}",
     *     description="Elimina la provincia elegida",
     *     tags={"Provincias"},
     *     @OA\Response(
     *          response="200", description="Se ha eliminado correctamente"
     *      ),
     *      @OA\Response(
     *          response="404", description="No se ha encontrado el colegio con el ID seleccionado"
     *      ),
     *      @OA\Response(
     *          response="500", description="Server Error"
     *      ),
     *      @OA\Parameter(
     *         name="idProvincia",
     *         in="path",
     *         description="id de la provincia a eliminar",
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
            $provincia = Provincia::where('CODPROV', $id)->delete();
            return response()->json(JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
             return $e->getMessage();
        }
    }
}
