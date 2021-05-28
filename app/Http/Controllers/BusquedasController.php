<?php

namespace App\Http\Controllers;

use App\Models\Comunidad;
use App\Models\Municipio;
use App\Models\Provincia;
use App\Models\Hospital;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BusquedasController extends Controller
{
    /**
     * filtra todos los hopitales de la municipio
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function filtrarHopitalesMunicipio($id)
    {
        $hospitales = Hospital::select('Nombre_Centro as titulo', 'Tipo_Vía', 'Nombre_Vía', 'Número_Vía', 'Clase_de_Centro', 'Dependencia_Funcional')->where('Cód_Municipio', $id)->get();
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
        $hospitales = Hospital::select('Nombre_Centro as titulo', 'Tipo_Vía', 'Nombre_Vía', 'Número_Vía', 'Clase_de_Centro', 'Dependencia_Funcional')->where('Cód_Provincia', $id)->get();
        return response()->json($hospitales, JsonResponse::HTTP_OK);
    }

}
