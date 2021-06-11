<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\JsonResponse;

class HospitalesController extends Controller
{
   
    /**
     * devuelve todos los hospitales.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hospitales = Hospital::select('CCN', 'CODCNH', 'Nombre_Centro', 'Tipo_Via', 'Nombre_Via', 'Numero_Via', 'Telefono_Principal', 'Cod_Municipio', 'Municipio', 'Cod_Provincia', 'Provincia', 'Cod_CCAA', 'CCAA', 'Codigo_Postal', 'CAMAS', 'Cod_Clase_de_Centro', 'Clase_de_Centro', 'Cod_Dep_Funcional', 'Dependencia_Funcional', 'Forma_parte_Complejo', 'CODIDCOM', 'Nombre_del_Complejo', 'ALTA', 'Email')->get();
        return response()->json($hospitales, JsonResponse::HTTP_OK);
    }

    /**
     * Crea nuevos hospitales
     *
     * @return \Illuminate\Http\Response
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        dd($request);
        try {
            $updateHospital = Hospital::where('CODCNH', $id)->update($request->all());
            return response()->json($updateHospital, JsonResponse::HTTP_OK);
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
        try{
            $hospital = Hospital::where('CODCNH', $id)->delete();
            return response()->json(JsonResponse::HTTP_OK);
        } catch (\Throwable $th) {
             return response()->json($th, JsonResponse::HTTP_NOT_FOUND);
        }
    }
}
