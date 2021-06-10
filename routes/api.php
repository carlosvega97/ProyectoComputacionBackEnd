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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('Colegios', ColegiosController::class, ['only' =>['index', 'show', 'update', 'destroy']]);
Route::put('Colegios/editar/{id}', [ColegiosController::class, 'editar']);
Route::resource('Comunidades', ComunidadesController::class, ['only' =>['index', 'show', 'destroy']]);
Route::post('Comunidades/createComunidad', [ComunidadesController::class, 'createComunidad']);

//Route::resource('Eventos', EventosController::class, ['only' =>['index', 'show']]);
Route::resource('Hospitales', HospitalesController::class, ['only' =>['index', 'show']]);
Route::resource('Municipios', MunicipiosController::class, ['only' =>['index', 'show']]);
Route::resource('Provincias', ProvinciasController::class, ['only' =>['index', 'show']]);
//Route::resource('Restaurantes', RestaurantesController::class, ['only' =>['index', 'show']]);
Route::resource('Usuarios', UsuariosController::class, ['except' => ['destroy']]);
Route::resource('Viviendas', ViviendasController::class, ['only' =>['index', 'show']]);

Route::get('Municipios/getNombreMunicipios', [MunicipiosController::class, 'getMunicipiosNombre']);
Route::get('Usuarios/existeUsuario/{usuario}', [UsuariosController::class, 'existeUsuario']);
Route::get('Usuarios/checkPassword/{usuario}/{password}', [UsuariosController::class, 'checkPassword']);
Route::get('Usuarios/isAdmin/{usuario}', [UsuariosController::class, 'isAdmin']);

Route::post('Usuarios/createUser', [UsuariosController::class, 'createUser']);
Route::get('Usuarios/getIdFromCorreo/{correo}', [UsuariosController::class, 'getIdFromCorreo']);

Route::get('Provincias/showFromComunidad/{id}', [ProvinciasController::class, 'showFromComunidad']);
Route::get('Municipios/showFromProvincia/{id}', [MunicipiosController::class, 'showFromProvincia']);
Route::get('Python/processData', [PythonController::class, 'processData']);
Route::get('Python/processDataSymfony', [PythonController::class, 'processDataSymfony']);

Route::get('Busqueda/filtrarHospitalesMunicipio/{id}', [BusquedasController::class, 'filtrarHopitalesMunicipio']);
Route::get('Busqueda/filtrarHospitalesProvincia/{id}', [BusquedasController::class, 'filtrarHopitalesProvincia']);
Route::get('Busqueda/filtrarViviendasMunicipio/{id}', [BusquedasController::class, 'filtrarViviendasMunicipio']);

route::get('Buqueda/filtrarProvinciaFromMunicipio/{id}', [BusquedasController::class, 'filtrarProvinciaFromMunicipio']);
route::get('Busqueda/filtrarMunicipiosFromProvincia/{id}', [BusquedasController::class, 'filtrarMunicipiosFromProvincia']);