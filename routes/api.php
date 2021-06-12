<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ColegiosController;
use App\Http\Controllers\ComunidadesController;
use App\Http\Controllers\EventosController;
use App\Http\Controllers\HospitalesController;
use App\Http\Controllers\MunicipiosController;
use App\Http\Controllers\ProvinciasController;
use App\Http\Controllers\RestaurantesController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\ViviendasController;
use App\Http\Controllers\PythonController;
use App\Http\Controllers\BusquedasController;


/**
* @OA\Info(title="API VIDA", version="1.0")
*
* @OA\Server(url="http://localhost:8000")
*/

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//Route::resource('Viviendas', ViviendasController::class, ['only' =>['index', 'show']]);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//*****************     colegios     ******************/

Route::resource('Colegios', ColegiosController::class);
Route::put('Colegios/editar/{id}', [ColegiosController::class, 'editar']);

//*****************     Comunidad     ******************/

Route::resource('Comunidades', ComunidadesController::class);
Route::post('Comunidades/createComunidad', [ComunidadesController::class, 'createComunidad']);

//*****************     Hospitales     ******************/

Route::resource('Hospitales', HospitalesController::class);

//*****************     Municipios     ******************/

Route::resource('Municipios', MunicipiosController::class);
Route::get('Municipios/showFromProvincia/{id}', [MunicipiosController::class, 'showFromProvincia']);
Route::get('Municipios/getNombreMunicipios', [MunicipiosController::class, 'getMunicipiosNombre']);

//*****************     Provincias     ******************/

Route::resource('Provincias', ProvinciasController::class);
Route::get('Provincias/showFromComunidad/{id}', [ProvinciasController::class, 'showFromComunidad']);

//*****************     Usuarios     ******************/

Route::resource('Usuarios', UsuariosController::class);
Route::get('Usuarios/existeUsuario/{usuario}', [UsuariosController::class, 'existeUsuario']);
Route::get('Usuarios/checkPassword/{usuario}/{password}', [UsuariosController::class, 'checkPassword']);
Route::get('Usuarios/isAdmin/{usuario}', [UsuariosController::class, 'isAdmin']);
Route::post('Usuarios/createUser', [UsuariosController::class, 'createUser']);
Route::get('Usuarios/getIdFromCorreo/{correo}', [UsuariosController::class, 'getIdFromCorreo']);

//*****************     Python     ******************/

Route::get('Python/processData', [PythonController::class, 'processData']);
Route::get('Python/processDataSymfony', [PythonController::class, 'processDataSymfony']);

//*****************     Busqueda     ******************/

Route::get('Busqueda/filtrarHospitalesFromMunicipio/{id}', [BusquedasController::class, 'filtrarHopitalesMunicipio']);
Route::get('Busqueda/filtrarHospitalesFromProvincia/{id}', [BusquedasController::class, 'filtrarHopitalesProvincia']);
Route::get('Busqueda/filtrarViviendasFromMunicipio/{id}', [BusquedasController::class, 'filtrarViviendasMunicipio']);
Route::get('Busqueda/filtrarColegiosFromMunicipio/{id}', [BusquedasController::class, 'filtrarColegiosFromMunicipio']);
route::get('Buqueda/filtrarProvinciaFromMunicipio/{id}', [BusquedasController::class, 'filtrarProvinciaFromMunicipio']);
route::get('Busqueda/filtrarMunicipiosFromProvincia/{id}', [BusquedasController::class, 'filtrarMunicipiosFromProvincia']);