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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colegios = Colegio::select('idColegio', 'idMunicipio', 'Localidad', 'idProvincia', 'Provincia', 'Denominacion_generica', 'Denominacion_especifica', 'Naturaleza', 'Domicilio', 'C_Postal', 'Telefono')->get();
        return response()->json($colegios, JsonResponse::HTTP_OK);
    }

    /**
     * crea un nuevo colegio
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $colegio)
    {
        return Colegio::create([
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
            $colegio = Colegio::where('idColegio', $id)->firstOrFail();
        } catch (\Throwable $th) {
            return false;
        }
        
        return response()->json($colegio, JsonResponse::HTTP_OK);
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
