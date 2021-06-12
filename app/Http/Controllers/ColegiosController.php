<?php

namespace App\Http\Controllers;

use App\Models\Colegio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Http\JsonResponse;

class ColegiosController extends Controller
{
    /**
     * @OA\Get(
     *     path="/Colegios",
     *     description="Muestra todos los colegios del municipio",
     *     tags={"Colegios"},
     *     @OA\Response(
     *          response="200", description="Todos los colegios"
     *      ),
     *      @OA\Response(
     *          response="500", description="Server Error"
     *      ),
     * )
     */
    public function index()
    {
        $colegios = Colegio::select('idColegio', 'idMunicipio', 'Localidad', 'idProvincia', 'Provincia', 'Denominacion_generica', 'Denominacion_especifica', 'Naturaleza', 'Domicilio', 'C_Postal', 'Telefono')->get();
        return response()->json($colegios, JsonResponse::HTTP_OK);
    }

    /**
     * @OA\Post(
     *     path="/Colegios",
     *     tags={"Colegios"},
     *     description="Crea un nuevo colegio en la base de datos",
     *     operationId="store",
     *     @OA\Response(
     *         response=200,
     *         description="Colegio Agregado correctamente"
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
     *                     property="idColegio",
     *                     description="ID del colegio a ingresar en la base de datos",
     *                     type="integer",
     *                     format="int64"
     *                 ),
     *                 @OA\Property(
     *                     property="idMunicipio",
     *                     description="ID del municipio en el que se encuentra el colegio",
     *                     type="integer",
     *                     format="int64"
     *                 ),
     *                 @OA\Property(
     *                     property="Localidad",
     *                     description="Nombre de la localidad en la que se encuentra el colegio",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="idProvincia",
     *                     description="ID de la provincia en la que se encuentra el colegio",
     *                     type="integer",
     *                     format="int64"
     *                 ),
     *                 @OA\Property(
     *                     property="Provincia",
     *                     description="Nombre de la provincia en la que se encuentra el colegio",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="Denominacion_generica",
     *                     description="Colegio de educacion infantil, Centro privado de Secundaria, etc",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="Denominacion_especifica",
     *                     description="Nombre del centro",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="Naturaleza",
     *                     description="Centro privado o público",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="Domicilio",
     *                     description="Direccion en la que se encuentra el colegio",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="C_Postal",
     *                     description="Código postal del colegio",
     *                     type="integer",
     *                     format="int64"
     *                 ),
     *                 @OA\Property(
     *                     property="Telefono",
     *                     description="Telefono del colegio",
     *                     type="integer",
     *                     format="int64"
     *                 ),
     *             )
     *         )
     *     )
     * )
     */
    public function store(Request $colegio)
    {
        $colegio = Colegio::create([
            'idMunicipio' => $colegio->idMunicipio,
            'Localidad' => $colegio->Localidad,
            'idProvincia' => $colegio->idProvincia,
            'Provincia' => $colegio->Provincia,
            'Denominacion_generica' => $colegio->Denominacion_generica,
            'Denominacion_especifica' => $colegio->Denominacion_especifica,
            'Naturaleza' => $colegio->Naturaleza,
            'Domicilio' => $colegio->Domicilio,
            'C_Postal' => $colegio->C_Postal,
            'Telefono' => $colegio->Telefono,
        ]);

        return response() -> json($colegio, JsonResponse::HTTP_OK);
    }

    /**
     * @OA\Get(
     *     path="/Colegios/{idColegio}",
     *     description="Muestra la informacion del colegio ",
     *     tags={"Colegios"},
     *     @OA\Response(
     *          response="200", description="Todos los colegios"
     *      ),
     *      @OA\Response(
     *          response="500", description="Server Error"
     *      ),
     *      @OA\Parameter(
     *         name="idColegio",
     *         in="path",
     *         description="id del colegio en el que buscar informacion",
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
        $colegio = Colegio::where('idColegio', $id)->firstOrFail();
        if($colegio == null){
            return response()->json($colegio, JsonResponse::HTTP_NOT_FOUND);
        }
        else{
            return response()->json($colegio, JsonResponse::HTTP_OK);
        }
        
        
        
    }

    /**
     * @OA\Put(
     *     path="/Colegios/{idColegio}",
     *     tags={"Colegios"},
     *     description="Actualiza el colegio elegido en la base de datos",
     *     operationId="update",
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
     *     @OA\Parameter(
     *         name="idColegio",
     *         in="path",
     *         description="id del colegio a editar",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *      ),
     *     @OA\RequestBody(
     *         description="Datos a modificar en la base de datos",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="idColegio",
     *                     description="ID del colegio a ingresar en la base de datos",
     *                     type="integer",
     *                     format="int64"
     *                 ),
     *                 @OA\Property(
     *                     property="idMunicipio",
     *                     description="ID del municipio en el que se encuentra el colegio",
     *                     type="integer",
     *                     format="int64"
     *                 ),
     *                 @OA\Property(
     *                     property="Localidad",
     *                     description="Nombre de la localidad en la que se encuentra el colegio",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="idProvincia",
     *                     description="ID de la provincia en la que se encuentra el colegio",
     *                     type="integer",
     *                     format="int64"
     *                 ),
     *                 @OA\Property(
     *                     property="Provincia",
     *                     description="Nombre de la provincia en la que se encuentra el colegio",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="Denominacion_generica",
     *                     description="Colegio de educacion infantil, Centro privado de Secundaria, etc",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="Denominacion_especifica",
     *                     description="Nombre del centro",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="Naturaleza",
     *                     description="Centro privado o público",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="Domicilio",
     *                     description="Direccion en la que se encuentra el colegio",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="C_Postal",
     *                     description="Código postal del colegio",
     *                     type="integer",
     *                     format="int64"
     *                 ),
     *                 @OA\Property(
     *                     property="Telefono",
     *                     description="Telefono del colegio",
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
        $updateColegio = Colegio::where('idColegio', $id)->update($request->all());
        if($updateColegio == 1){
            return response()->json($updateColegio, JsonResponse::HTTP_OK);
        }

        else{
            return response()->json($updateColegio, JsonResponse::HTTP_NOT_FOUND);
        }
        
        //$updateColegio->save();
        
        
    }

    /**
     * @OA\Delete(
     *     path="/Colegios/{idColegio}",
     *     description="Elimina el colegio elegido",
     *     tags={"Colegios"},
     *     @OA\Response(
     *          response="200", description="Se ha eliminado correctamente"
     *      ),
     *      @OA\Response(
     *          response="500", description="Server Error"
     *      ),
     *      @OA\Parameter(
     *         name="idColegio",
     *         in="path",
     *         description="id del colegio a eliminar",
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
        try {
            $colegio = Colegio::where('idColegio', $id)->delete();
            return response()->json(JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
             return $e->getMessage();
        }
    }


}
