<?php

namespace App\Http\Controllers;

use App\Models\Comunidad;
use App\Models\Municipio;
use App\Models\Provincia;
use App\Models\Hospital;
use App\Models\Vivienda;
use App\Models\Colegio;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BusquedasController extends Controller
{

    
    /**
     * @OA\Get(
     *     path="/Busqueda/filtrarColegiosFromMunicipio/{idMunicipio}",
     *     description="Muestra todos los colegios del municipio",
     *     tags={"Busqueda"},
     *     @OA\Response(
     *          response="200", description="Todos los colegios del municipio"
     *      ),
     *     @OA\Response(
     *          response="404", description="No se han enocntrado colegios para el municipio dado"
     *      ),
     * 
     *      @OA\Parameter(
     *         name="idMunicipio",
     *         in="path",
     *         description="id del municipio en el que buscar colegios",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *      )
     * )
     */
    public function filtrarColegiosFromMunicipio($id)
    {
        $colegios = Colegio::select('idColegio', 'idMunicipio', 'Localidad', 'idProvincia', 'Provincia', 'Denominacion_generica', 'Denominacion_especifica', 'Naturaleza', 'Domicilio', 'C_Postal', 'Telefono')->where('idMunicipio', $id)->get();

        if(count($colegios) == 0){
            return response()->json($colegios, JsonResponse::HTTP_NOT_FOUND);
        }
        else{
            return response()->json($colegios, JsonResponse::HTTP_OK);
        }
            
    }
    
    
    /**
     * @OA\Get(
     *     path="/Busqueda/filtrarHospitalesFromMunicipio/{idMunicipio}",
     *     description="Muestra todos los hospitales del municipio",
     *     tags={"Busqueda"},
     *     @OA\Response(
     *          response="200", description="Todos los hospitales del municipio"
     *      ),
     *     @OA\Response(
     *          response="404", description="No se han enocntrado hospitales para el municipio dado"
     *      ),
     * 
     *      @OA\Parameter(
     *         name="idMunicipio",
     *         in="path",
     *         description="id del municipio en el que buscar hospitales",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *      )
     * )
     */
    public function filtrarHopitalesMunicipio($id)
    {
        $hospitales = Hospital::select('CODCNH', 'Nombre_Centro', 'Tipo_Via', 'Nombre_Via', 'Numero_Via', 'Clase_de_Centro', 'Dependencia_Funcional')->where('Cod_Municipio', $id)->get();
        return response()->json($hospitales, JsonResponse::HTTP_OK);
    }

    /**
     * filtra todos los hopitales de la provincia
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function filtrarHopitalesProvincia($id)
    {
        $hospitales = Hospital::select('CODCNH', 'Nombre_Centro', 'Tipo_Via', 'Nombre_Via', 'Numero_Via', 'Clase_de_Centro', 'Dependencia_Funcional')->where('Cod_Provincia', $id)->get();
        return response()->json($hospitales, JsonResponse::HTTP_OK);
    }

    /**
     * filtra las viviendas en alquiler de un municipio
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function filtrarViviendasMunicipio($id)
    {
        $viviendas = Vivienda::where('idMunicipio', $id)->get();
        return response()->json($viviendas, JsonResponse::HTTP_OK);
    }

}
