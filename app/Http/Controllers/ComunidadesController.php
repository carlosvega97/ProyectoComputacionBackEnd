<?php

namespace App\Http\Controllers;

use App\Models\Comunidad;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class ComunidadesController extends Controller
{
    /**
     * devuelve todos las comunidades existentes de la data base
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comunidades = Comunidad::select('CODAUTO', 'AUTONOMIA', 'TEXTO_AUTONOMIA')->get();
        return response()->json($comunidades, JsonResponse::HTTP_OK);
    }
    /**
     * crea una nueva comunidad
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $comunidad)
    {
        return Comunidad::create([
            'CODAUTO' => $comunidad->CODAUTO,
            'AUTONOMIA' => $comunidad->AUTONOMIA,
            'TEXTO_AUTONOMIA' => $comunidad->TEXTO_AUTONOMIA
        ]);
    }

    /**
     * devuelve solo una comunidad en espesifico
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $comunidad = Comunidad::where('CODAUTO', $id)->firstOrFail();;
        } catch (\Throwable $th) {
            return false;
        }
        return response()->json($comunidad, JsonResponse::HTTP_OK);
    }

    /**
     * Modifica un objeto en espesifico y lo actualiza en la base de datos
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $updateComunidad = Comunidad::where('CODAUTO', $id)->update($request->all());
            return response()->json($updateComunidad, JsonResponse::HTTP_OK);
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
            $comunidad = Comunidad::where('CODAUTO', $id)->delete();
            return response()->json(JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
             return $e->getMessage();
        }
    }
}
