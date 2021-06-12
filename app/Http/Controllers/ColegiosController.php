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
     *         response=405,
     *         description="Invalid input"
     *     ),
     *     @OA\RequestBody(
     *         description="Datos a ingresar en la base de datos",
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="name",
     *                     description="Updated name of the pet",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="status",
     *                     description="Updated status of the pet",
     *                     type="string"
     *                 )
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

        if($colegio == 1){
            return response() -> json($colegio, JsonResponse::HTTP_OK);
        }
        else{
            return response() -> json($colegio, JsonResponse::HTTP_ERROR);
        }
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
        if(count($colegio) == 0){
            return response()->json($colegio, JsonResponse::HTTP_NOT_FOUND);
        }
        else{
            return response()->json($colegio, JsonResponse::HTTP_OK);
        }
        
        
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $updateColegio = Colegio::where('idColegio', $id)->update($request->all());
            //$updateColegio->save();
            return response()->json($updateColegio, JsonResponse::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json($th, JsonResponse::HTTP_NOT_FOUND);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
