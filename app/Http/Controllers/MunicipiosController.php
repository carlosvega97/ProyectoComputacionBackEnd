<?php

namespace App\Http\Controllers;

use App\Models\Municipio;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\JsonResponse;

class MunicipiosController extends Controller
{
    /**
     * @OA\Get(
     *     path="/Municipios",
     *     description="Muestra todos los municipios",
     *     tags={"Municipios"},
     *     operationId="index",
     *     @OA\Response(
     *          response="200", description="Todos los municipios"
     *      ),
     *      @OA\Response(
     *          response="500", description="Server Error"
     *      ),
     * )
     */
    public function index()
    {
        $municipios = Municipio::select('CODMU', 'MUNICIPIO', 'CODPROV')->orderBy('MUNICIPIO', 'asc')->get();
        return response()->json($municipios, JsonResponse::HTTP_OK);
    }

     /**
     * @OA\Get(
     *     path="/getNombreMunicipios",
     *     description="Muestra el nombre de todos municipios",
     *     tags={"Municipios"},
     *     operationId="getMunicipiosNombre",
     *     @OA\Response(
     *          response="200", description="Todos los nombres de los municipios"
     *      ),
     *      @OA\Response(
     *          response="500", description="Server Error"
     *      ),
     * )
     */
    public function getMunicipiosNombre()
    {
        $municipios = Municipio::select('MUNICIPIO')->get();
        return response()->json($municipios, JsonResponse::HTTP_OK);
    }

    /**
     * @OA\Post(
     *     path="/Municipios",
     *     tags={"Municipios"},
     *     description="Crea un nuevo municipios en la base de datos",
     *     operationId="store",
     *     @OA\Response(
     *         response=200,
     *         description="Municipio agregado correctamente"
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
     *                     property="CODMU",
     *                     description="ID del municipio a ingresar en la base de datos",
     *                     type="integer",
     *                     format="int64"
     *                 ),
     *                 @OA\Property(
     *                     property="NOMBRE",
     *                     description="Nombre del municipio",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="CODPROV",
     *                     description="ID de la provincia a la que pertenece",
     *                     type="integer",
     *                     format="int64"
     *                 ),
     *             )
     *         )
     *     )
     * )
     */
    public function store(Request $municipio)
    {
        return Municipio::create([
            'CODMU' => $municipio->CODMU,
            'MUNICIPIO' => $municipio->MUNICIPIO,
            'CODPROV' => $municipio->CODPROV
        ]); 
    }

    /**
     * @OA\Get(
     *     path="/Municipios/{idMunicipio}",
     *     description="Muestra la informacion del municipio",
     *     tags={"Municipios"},
     *     @OA\Response(
     *          response="200", description="Muestra la informacion del municipio"
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
        try {
            $municipio = Municipio::where('CODMU', $id)->firstOrFail();
        }
        catch (\Throwable $e) {
            return false;
        }
        return response()->json($municipio, JsonResponse::HTTP_OK);
    }

    /**
     * @OA\Get(
     *     path="/Municipios/showFromProvincia/{idProvincia}",
     *     description="Muestra la informacion de los municipios que pertenecen a la provincia elegida",
     *     tags={"Municipios"},
     *     @OA\Response(
     *          response="200", description="Muestra la informacion de los municipios de la provincia"
     *      ),
     *      @OA\Response(
     *          response="500", description="Server Error"
     *      ),
     *      @OA\Parameter(
     *         name="idProvincia",
     *         in="path",
     *         description="id de la provincia en la que buscar municipios",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *      )
     * )
     */
    public function showFromProvincia($id)
    {
        $municipio = Municipio::where('CODPROV', $id)->get();
        return response()->json($municipio, JsonResponse::HTTP_OK);
    }

    /**
     * @OA\Put(
     *     path="/Municipios/{idMunicipio}",
     *     tags={"Municipios"},
     *     description="modifica un municipio en la base de datos",
     *     operationId="store",
     *     @OA\Response(
     *         response=200,
     *         description="Municipio modificado correctamente"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Ha ingresado uno o varios campos erroneamente o hay un problema con el servidor"
     *     ),
     *     @OA\Parameter(
     *         name="idMunicipio",
     *         in="path",
     *         description="id del municipio a modificar",
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
     *                     property="CODMU",
     *                     description="ID del municipio a ingresar en la base de datos",
     *                     type="integer",
     *                     format="int64"
     *                 ),
     *                 @OA\Property(
     *                     property="NOMBRE",
     *                     description="Nombre del municipio",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="CODPROV",
     *                     description="ID de la provincia a la que pertenece",
     *                     type="integer",
     *                     format="int64"
     *                 ),
     *             )
     *         )
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        try {
            $updateMunicipio = Municipio::where('CODMU', $id)->update($request->all());
            return response()->json($updateMunicipio, JsonResponse::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json($th, JsonResponse::HTTP_NOT_FOUND);
        }
    }

    /**
     * @OA\Delete(
     *     path="/Municipios/{idMunicipio}",
     *     description="Elimina el municipio elegido",
     *     tags={"Municipios"},
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
     *         name="idMunicipio",
     *         in="path",
     *         description="id del municipio a eliminar",
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
            $municipio = Municipio::where('CODMU', $id)->delete();
            return response()->json(JsonResponse::HTTP_OK);
        } catch (\Throwable $th) {
             return response()->json($th, JsonResponse::HTTP_NOT_FOUND);
        }
    }
}
