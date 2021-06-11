<?php

namespace App\Http\Controllers;

use App\Models\Municipio;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\JsonResponse;

class MunicipiosController extends Controller
{
    /**
     * devuelve todos los municipios ordenados de forma acendente
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $municipios = Municipio::select('CODMU', 'MUNICIPIO', 'CODPROV')->orderBy('MUNICIPIO', 'asc')->get();
        return response()->json($municipios, JsonResponse::HTTP_OK);
    }

     /**
     * devuelve el nombre de todos los municipios
     *
     * @return \Illuminate\Http\Response
     */
    public function getMunicipiosNombre()
    {
        $municipios = Municipio::select('MUNICIPIO')->get();
        return response()->json($municipios, JsonResponse::HTTP_OK);
    }

    /**
     * crea un nuevo municipio
     *
     * @return \Illuminate\Http\Response
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showFromProvincia($id)
    {
        $municipio = Municipio::where('CODPROV', $id)->get();
        return response()->json($municipio, JsonResponse::HTTP_OK);
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
            $updateMunicipio = Municipio::where('CODMU', $id)->update($request->all());
            return response()->json($updateMunicipio, JsonResponse::HTTP_OK);
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
            $municipio = Municipio::where('CODMU', $id)->delete();
            return response()->json(JsonResponse::HTTP_OK);
        } catch (\Throwable $th) {
             return response()->json($th, JsonResponse::HTTP_NOT_FOUND);
        }
    }
}
