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
        $colegios = Colegio::all();
        return response()->json($colegios, JsonResponse::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $colegio = Colegio::where('idColegio', $id)->firstOrFail();
        return response()->json($colegio, JsonResponse::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
            $updateColegio = Colegio::where('idColegio', $id)->update([
                'idColegio' => $request->idColegio,
                'idMunicipio' => $request->idMunicipio,
                'localidad' => $request->localidad,
                'idProvincia' => $request->idProvincia,
                'provincia' => $request->provincia,
                'denomGenerica' => $request->denomGenerica,
                'denomEspesifica' => $request->denomEspesifica,
                'naturaleza' => $request->naturaleza,
                'domicilio' => $request->domicilio,
                'cPostal' => $request->cPostal,
                'telefono' => $request->telefono,
            ]);
            return response()->json(JsonResponse::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json(JsonResponse::HTTP_NOT_FOUND,);
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
        //
    }
}
