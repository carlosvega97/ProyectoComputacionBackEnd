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
     * filtra todos los colegios del municipio
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function filtrarColegiosFromMunicipio($id)
    {
        try {
            $colegios = Colegio::select('idColegio', 'idMunicipio', 'Localidad', 'idProvincia', 'Provincia', 'Denominacion_generica', 'Denominacion_especifica', 'Naturaleza', 'Domicilio', 'C_Postal', 'Telefono')->where('idMunicipio', $id)->get();
            return response()->json($colegios, JsonResponse::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json($th, JsonResponse::HTTP_NOT_FOUND);
        }
    }
    /**
     * filtra todos los hopitales de la municipio
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function filtrarProvinciaFromMunicipio($id)
    {
        $provincias = Provincia::select('CODPROV', 'NOMBRE', 'CODAUTO')->where('CODAUTO', $id)->get();
        return response()->json($provincias, JsonResponse::HTTP_OK);
    }
    /**
     * filtra todos los hopitales de la municipio
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function filtrarMunicipiosFromProvincia($id)
    {
        $municipios = Municipio::select('CODMU', 'MUNICIPIO', 'CODPROV')->where('CODPROV', $id)->get();
        return response()->json($municipios, JsonResponse::HTTP_OK);
    }

    /**
     * filtra todos los hopitales de la municipio
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function filtrarHopitalesMunicipio($id)
    {
        $hospitales = Hospital::select('CODCNH', 'Nombre_Centro', 'Tipo_Via', 'Nombre_Via', 'Numero_Via', 'Clase_de_Centro', 'Dependencia_Funcional')->where('Cód_Municipio', $id)->get();
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
        $hospitales = Hospital::select('CODCNH', 'Nombre_Centro', 'Tipo_Via', 'Nombre_Via', 'Numero_Via', 'Clase_de_Centro', 'Dependencia_Funcional')->where('Cód_Provincia', $id)->get();
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
