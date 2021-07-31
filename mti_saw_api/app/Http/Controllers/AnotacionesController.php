<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anotacion;

class AnotacionesController extends Controller
{
    /**
     * Ingresa a BD una nueva anotacion.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $anotacion = new Anotacion();

        // $anotacion->atributo = $request->atributo;
        $anotacion->valor = $request->valor;
        $anotacion->empresa_id = $request->empresa;
        $anotacion->propiedad_id = $request->propiedad;

        $anotacion->save();
        return $anotacion;
    }

    /**
     * Borra una anotación
     *
     * @param  \App\Models\Anotacion  $anotacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Anotacion $anotacion){
        $anotacion->delete();
    }
}
