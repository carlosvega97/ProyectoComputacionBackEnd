<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\JsonResponse;

class HospitalesController extends Controller
{
   
    /**
     * @OA\Get(
     *     path="/Hospitales",
     *     description="Muestra todos los hospitales",
     *     tags={"Hospitales"},
     *     operationId="index",
     *     @OA\Response(
     *          response="200", description="Todos los hospitales"
     *      ),
     *      @OA\Response(
     *          response="500", description="Server Error"
     *      )
     * )
     */
    public function index()
    {
        $hospitales = Hospital::select('CCN', 'CODCNH', 'Nombre_Centro', 'Tipo_Via', 'Nombre_Via', 'Numero_Via', 'Telefono_Principal', 'Cod_Municipio', 'Municipio', 'Cod_Provincia', 'Provincia', 'Cod_CCAA', 'CCAA', 'Codigo_Postal', 'CAMAS', 'Cod_Clase_de_Centro', 'Clase_de_Centro', 'Cod_Dep_Funcional', 'Dependencia_Funcional', 'Forma_parte_Complejo', 'CODIDCOM', 'Nombre_del_Complejo', 'ALTA', 'Email')->get();
        return response()->json($hospitales, JsonResponse::HTTP_OK);
    }

    /**
     * @OA\Post(
     *     path="/Hospitales",
     *     description="Crea un nuevo hospital en la base de datos",
     *     tags={"Hospitales"},
     *     operationId="store",
     *     @OA\Response(
     *         response=200,
     *         description="Hospital agregado correctamente"
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
     *                     property="CCN",
     *                     description="Segundo id del hospital a ingresar en la base de datos",
     *                     type="integer",
     *                     format="int64"
     *                 ),
     *                 @OA\Property(
     *                     property="CODCNH",
     *                     description="ID del hospital a ingresar en la base de datos",
     *                     type="integer",
     *                     format="int64"
     *                 ),
     *                 @OA\Property(
     *                     property="Nombre_Centro",
     *                     description="Nombre del hospital",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="Tipo_Via",
     *                     description="Tipo de via en la que se encuentra el hospital: calle, avenida, paseo, etc",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="Nombre_Via",
     *                     description="Nombre de la via en la que se encuentra el hospital",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="Numero_Via",
     *                     description="Numero de la via en la que se encuentra el hospital",
     *                     type="integer",
     *                     format="int64"
     *                 ),
     *                 @OA\Property(
     *                     property="Telefono_Principal",
     *                     description="Numero de telefono del hospital",
     *                     type="integer",
     *                     format="int64"
     *                 ),
     *                 @OA\Property(
     *                     property="Cod_Municipio",
     *                     description="Codigo del municipio en el que se encuentra el hospital",
     *                     type="integer",
     *                     format="int64"
     *                 ),
     *                 @OA\Property(
     *                     property="Municipio",
     *                     description="Nombre del municipio en el que se encuentra el hospital",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="Cod_Provincia",
     *                     description="codigo de la provincia en la que se encuentra el hospital",
     *                     type="integer",
     *                     format="int64"
     *                 ),
     *                 @OA\Property(
     *                     property="Provincia",
     *                     description="Nombre de la provincia en la que se encuentra el hospital",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="Cod_CCAA",
     *                     description="codigo de la comunidad autonoma en la que se encuentra el hospital",
     *                     type="integer",
     *                     format="int64"
     *                 ),
     *                 @OA\Property(
     *                     property="CCAA",
     *                     description="Nombre de la comunidad autonoma en la que se encuentra el hospital",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="Codigo_Postal",
     *                     description="Codigo postal del hospital",
     *                     type="integer",
     *                     format="int64"
     *                 ),
     *                 @OA\Property(
     *                     property="CAMAS",
     *                     description="Numero de camas de las que dispone el hospital",
     *                     type="integer",
     *                     format="int64"
     *                 ),
     *                 @OA\Property(
     *                     property="Cod_Clase_de_Centro",
     *                     description="Código clase de hospital",
     *                     type="integer",
     *                     format="int64"
     *                 ),
     *                 @OA\Property(
     *                     property="Clase_de_Centro",
     *                     description="Clase de hospital",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="Cod_Dep_Funcional",
     *                     description="Codigo de la dependencia funcional del hospital",
     *                     type="integer",
     *                     format="int64"
     *                 ),
     *                 @OA\Property(
     *                     property="Dependencia_Funcional",
     *                     description="Dependencia funcional del hospital",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="Forma_parte_Complejo",
     *                     description="Forma parte de un complejo: S o N",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="CODIDCOM",
     *                     description="ID del complejo en el que se encuentra el hospital",
     *                     type="integer",
     *                     format="int64"
     *                 ),
     *                 @OA\Property(
     *                     property="Nombre_del_Complejo",
     *                     description="Nombre del complejo en el que se encuentra el hospital",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="ALTA",
     *                     description="ALTA",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="Email",
     *                     description="Direccion de correo electronico del colegio",
     *                     type="string"
     *                 ),
     *             )
     *         )
     *     )
     * )
     */
    public function store(Request $hospital)
    {
        return Hospital::create([
            'CCN' => $hospital->CCN,
            'Nombre_Centro' => $hospital->Nombre_Centro,
            'Tipo_Via' => $hospital->Tipo_Via,
            'Nombre_Via' => $hospital->Nombre_Via,
            'Numero_Via' => $hospital->Numero_Via,
            'Telefono_Principal' => $hospital->Telefono_Principal,
            'Cod_Municipio' => $hospital->Cod_Municipio,
            'Municipio' => $hospital->Municipio,
            'Cod_Provincia' => $hospital->Cod_Provincia,
            'Provincia' => $hospital->Provincia,
            'Cod_CCAA' => $hospital->Cod_CCAA,
            'CCAA' => $hospital->CCAA,
            'Codigo_Postal' => $hospital->Codigo_Postal,
            'CAMAS' => $hospital->CAMAS,
            'Cod_Clase_de_Centro' => $hospital->Cod_Clase_de_Centro,
            'Clase_de_Centro' => $hospital->Clase_de_Centro,
            'Cod_Dep_Funcional' => $hospital->Cod_Dep_Funcional,
            'Dependencia_Funcional' => $hospital->Dependencia_Funcional,
            'Forma_parte_Complejo' => $hospital->Forma_parte_Complejo,
            'CODIDCOM' => $hospital->CODIDCOM,
            'Nombre_del_Complejo' => $hospital->Nombre_del_Complejo,
            'ALTA' => $hospital->ALTA,
            'Email' => $hospital->Email
        ]);
    }

    /**
     * @OA\Get(
     *     path="/Hospitales/{idHospital}",
     *     description="Muestra la informacion del hospital ",
     *     tags={"Hospitales"},
     *     @OA\Response(
     *          response="200", description="Muestra informacion del hospital"
     *      ),
     *     @OA\Response(
     *          response="404", description="No se ha encontrado el hospital"
     *      ),
     *      @OA\Response(
     *          response="500", description="Server Error"
     *      ),
     *      @OA\Parameter(
     *         name="idHospital",
     *         in="path",
     *         description="ID del hospital en el que buscar informacion",
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
            $hospital = Hospital::where('CODCNH', $id)->firstOrFail();;
        } catch (\Throwable $th) {
            return false;
        }
        return response()->json($hospital, JsonResponse::HTTP_OK);
    }

    /**
     * @OA\Put(
     *     path="/Hospitales/{idHospital}",
     *     tags={"Hospitales"},
     *     description="Modifica un hospital en la base de datos",
     *     operationId="store",
     *     @OA\Response(
     *         response=200,
     *         description="Hospital modificado correctamente"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Ha ingresado uno o varios campos erroneamente o hay un problema con el servidor"
     *     ),
     *     @OA\Parameter(
     *         name="idHospital",
     *         in="path",
     *         description="ID del hospital a modificar",
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
     *                     property="CCN",
     *                     description="Segundo id del hospital a ingresar en la base de datos",
     *                     type="integer",
     *                     format="int64"
     *                 ),
     *                 @OA\Property(
     *                     property="CODCNH",
     *                     description="ID del hospital a ingresar en la base de datos",
     *                     type="integer",
     *                     format="int64"
     *                 ),
     *                 @OA\Property(
     *                     property="Nombre_Centro",
     *                     description="Nombre del hospital",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="Tipo_Via",
     *                     description="Tipo de via en la que se encuentra el hospital: calle, avenida, paseo, etc",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="Nombre_Via",
     *                     description="Nombre de la via en la que se encuentra el hospital",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="Numero_Via",
     *                     description="Numero de la via en la que se encuentra el hospital",
     *                     type="integer",
     *                     format="int64"
     *                 ),
     *                 @OA\Property(
     *                     property="Telefono_Principal",
     *                     description="Numero de telefono del hospital",
     *                     type="integer",
     *                     format="int64"
     *                 ),
     *                 @OA\Property(
     *                     property="Cod_Municipio",
     *                     description="Codigo del municipio en el que se encuentra el hospital",
     *                     type="integer",
     *                     format="int64"
     *                 ),
     *                 @OA\Property(
     *                     property="Municipio",
     *                     description="Nombre del municipio en el que se encuentra el hospital",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="Cod_Provincia",
     *                     description="codigo de la provincia en la que se encuentra el hospital",
     *                     type="integer",
     *                     format="int64"
     *                 ),
     *                 @OA\Property(
     *                     property="Provincia",
     *                     description="Nombre de la provincia en la que se encuentra el hospital",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="Cod_CCAA",
     *                     description="codigo de la comunidad autonoma en la que se encuentra el hospital",
     *                     type="integer",
     *                     format="int64"
     *                 ),
     *                 @OA\Property(
     *                     property="CCAA",
     *                     description="Nombre de la comunidad autonoma en la que se encuentra el hospital",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="Codigo_Postal",
     *                     description="Codigo postal del hospital",
     *                     type="integer",
     *                     format="int64"
     *                 ),
     *                 @OA\Property(
     *                     property="CAMAS",
     *                     description="Numero de camas de las que dispone el hospital",
     *                     type="integer",
     *                     format="int64"
     *                 ),
     *                 @OA\Property(
     *                     property="Cod_Clase_de_Centro",
     *                     description="Código clase de hospital",
     *                     type="integer",
     *                     format="int64"
     *                 ),
     *                 @OA\Property(
     *                     property="Clase_de_Centro",
     *                     description="Clase de hospital",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="Cod_Dep_Funcional",
     *                     description="Codigo de la dependencia funcional del hospital",
     *                     type="integer",
     *                     format="int64"
     *                 ),
     *                 @OA\Property(
     *                     property="Dependencia_Funcional",
     *                     description="Dependencia funcional del hospital",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="Forma_parte_Complejo",
     *                     description="Forma parte de un complejo: S o N",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="CODIDCOM",
     *                     description="ID del complejo en el que se encuentra el hospital",
     *                     type="integer",
     *                     format="int64"
     *                 ),
     *                 @OA\Property(
     *                     property="Nombre_del_Complejo",
     *                     description="Nombre del complejo en el que se encuentra el hospital",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="ALTA",
     *                     description="ALTA",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="Email",
     *                     description="Direccion de correo electronico del colegio",
     *                     type="string"
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        try {
            $updateHospital = Hospital::where('CODCNH', $id)->update($request->all());
            return response()->json($updateHospital, JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return $e -> getMessage();
            
        }
    }

    /**
     * @OA\Delete(
     *     path="/Hospitales/{idHospital}",
     *     description="Elimina el hospital elegido",
     *     tags={"Hospitales"},
     *     @OA\Response(
     *          response="200", description="Se ha eliminado correctamente"
     *      ),
     *      @OA\Response(
     *          response="500", description="Server Error"
     *      ),
     *      @OA\Parameter(
     *         name="idHospital",
     *         in="path",
     *         description="id del hospital a eliminar",
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
            $hospital = Hospital::where('CODCNH', $id)->delete();
            return response()->json(JsonResponse::HTTP_OK);
        } catch (\Throwable $th) {
             return response()->json($th, JsonResponse::HTTP_NOT_FOUND);
        }
    }
}
