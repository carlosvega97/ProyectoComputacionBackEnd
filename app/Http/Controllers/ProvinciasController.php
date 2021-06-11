<?php

namespace App\Http\Controllers;

use App\Models\Provincia;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\JsonResponse;

class ProvinciasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provincias = Provincia::all();
        return response()->json($provincias, JsonResponse::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $provincia)
    {
        return Municipio::create([
            'CODPROV' => $provincia->CODPROV,
            'NOMBRE' => $provincia->NOMBRE,
            'CODAUTO' => $provincia->CODAUTO
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
        $provincia = Provincia::where('CODPROV', $id)->firstOrFail();
        return response()->json($provincia, JsonResponse::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showFromComunidad($id)
    {
        $provincia = Provincia::where('CODAUTO', $id)->get();
        return response()->json($provincia, JsonResponse::HTTP_OK);
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
            $updateProvincia = Municipio::where('CODPROV', $id)->update($request->all());
            return response()->json($updateProvincia, JsonResponse::HTTP_OK);
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
            $provincia = Municipio::where('CODPROV', $id)->delete();
            return response()->json(JsonResponse::HTTP_OK);
        } catch (\Throwable $th) {
             return response()->json($th, JsonResponse::HTTP_NOT_FOUND);
        }
    }
}
