<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{EmpresasController,AnotacionesController,PropiedadesController};

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/empresas',[EmpresasController::class,'index']);
Route::get('/empresas/{empresa}',[EmpresasController::class,'show']);
Route::get('/empresas/{empresa}/resumen',[EmpresasController::class,'showResumen']);

Route::get('/empresas/{empresa}/anotaciones',[EmpresasController::class,'anotaciones']);

// Route::post('/empresas/{empresa}/anotaciones',[AnotacionesController::class,'store']);
Route::post('/anotaciones',[AnotacionesController::class,'store']);
Route::delete('/anotaciones/{anotacion}',[AnotacionesController::class,'destroy']);

Route::apiResource('/propiedades',PropiedadesController::class)->parameters(['propiedades'=>'propiedad']);

