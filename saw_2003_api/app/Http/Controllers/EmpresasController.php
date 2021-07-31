<?php

namespace App\Http\Controllers;

use App\Models\{Anotacion,Empresa,EmpresaWD, ListaWD};
use Illuminate\Http\Request;
use Http;
use Carbon\Carbon;

class EmpresasController extends Controller
{
    private $apiUri = 'https://www.wikidata.org/w/api.php?action=wbgetentities&format=json&languages=es&props=labels|descriptions|aliases|claims&ids=';

    /**
     * Muestra listado de empresas.
     * De cada empresa muestra su empresa_id (código de entidad de wikidata), nombre y descripcion
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $empresas = Empresa::all();
        $lista_ids = '';
        foreach($empresas as $empresa){
            $lista_ids.=$empresa['empresa_id'].'|';
        }
        // dd(substr($lista_ids,0,strlen($lista_ids)-1));
        return (new ListaWD())->getListaEmpresas(substr($lista_ids,0,strlen($lista_ids)-1));
    }

    /**
     * Muestra la información de una empresa según su código de entidad de wikidata.
     *
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function show($empresa){
        return (new EmpresaWD($empresa))->getEmpresa();
    }

    /**
     * Muestra la información RESUMIDA de una empresa según su código de entidad de wikidata.
     * Retorna empresa_id, nombre y descripcion
     *
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function showResumen($empresa){
        return (new EmpresaWD($empresa))->getEmpresaResumen();
    }

    /**
     * Muestra las anotaciones de una empresa de una empresa según su código de entidad de wikidata.
     *
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function anotaciones(Empresa $empresa){
        $anotaciones = [];
        foreach($empresa->anotaciones as $anotacion){
            array_push($anotaciones,[
                'id'=>$anotacion->id,
                'valor'=>$anotacion->valor,
                'empresa_id'=>$empresa->empresa_id,
                'propiedad'=>[
                    'propiedad_id'=>$anotacion->propiedad_id,
                    'nombre'=>$anotacion->propiedad->nombre,
                ]
            ]);
        }
        $anotaciones = collect($anotaciones);
        return $anotaciones->sortBy('propiedad.nombre')->values()->toArray();
    }

}
