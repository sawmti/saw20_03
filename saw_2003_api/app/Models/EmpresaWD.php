<?php

namespace App\Models;

use Http;
use App\Models\EntidadWD;

class EmpresaWD
{

    private $wikidata_id;
    private $apiUri = 'https://www.wikidata.org/w/api.php?action=wbgetentities&format=json&languages=es';

    function __construct($wikidata_id){
        $this->wikidata_id = $wikidata_id;
    }

    /*
    Retorna datos de empresa.
    Solo muestra nombre y descripcion de empresa
    Se utiliza para mostrar en conjunto con otras empresas en una vista general
    */
    public function getEmpresaResumen(){
        $uri = $this->apiUri.'&props=labels|descriptions&ids='.$this->wikidata_id;
        $res = Http::get($uri);
        $res = $res->json()['entities'][$this->wikidata_id];
        return [
            'empresa_id' => $this->wikidata_id,
            'nombre'=> $res['labels']['es']['value'],
            'descripcion'=> ucfirst(isset($res['descriptions']['es'])?$res['descriptions']['es']['value']:'Sin descripción'),          
            // 'logo'=>$this->getLogo($res),
        ];
    }

    /*
    Retorna datos de empresa.
    Muestra toda la data de la empresa (la que se decidió mostrar, no toda la que tiene Wikidata).
    Se utiliza para vista de detalle de la empresa
    */
    public function getEmpresa(){
        $uri = $this->apiUri.'&props=labels|descriptions|aliases|claims&ids='.$this->wikidata_id;
        $res = Http::get($uri);
        $res = $res->json()['entities'][$this->wikidata_id];
        return [
            'empresa_id' => $this->wikidata_id,
            'nombre'=> isset($res['labels']['es']['value'])?$res['labels']['es']['value']:'Sin nombre',
            'descripcion'=> ucfirst(isset($res['descriptions']['es']['value'])?$res['descriptions']['es']['value']:'Sin descripción'),          
            'logo'=>$this->getLogo($res),
            // 'imagen'=>$this->getImagen($res),
            // 'pais'=>$this->getPais($res),
            'creacion'=>$this->getCreacion($res),
            // 'ciudad_creacion'=>$this->getCiudadCreacion($res),
            'fundadores'=>$this->getFundadores($res),
            'aliases'=> $this->getAliases($res),
            // 'industrias'=>$this->getIndustrias($res),
        ];
    }

    /*
    FUNCIONES PRIVADAS
    Utilizadas para obtener los datos que se mostrarán de la empresa
    Nombre singular: retorna string
    Nombre plural: retorna array de strings
    */

    /*
    Retorna un array con diferentes formas en que se le llama a la empresa
    */
    private function getAliases($res){
        $aliasesArr = [];
        if(!isset($res['aliases']['es'])){
            return [];
        }
        $data = $res['aliases']['es'];
        foreach($data as $alias){
            array_push($aliasesArr,ucfirst($alias['value']));
        }
        return $aliasesArr;
    }

    /*
    Retorna URI logo de la empresa.
    Wikidata en algunos casos tiene más de uno. Este método
    retorna el último de la lista, ya que tiende a ser el más actual.
    */
    private function getLogo($res){
        $indice = count($res['claims']['P154'])-1;
        return $this->getImagenURI($res['claims']['P154'][$indice]['mainsnak']['datavalue']['value']);
    }

    private function getImagenURI($nombreArchivo){
        return 'https://commons.wikimedia.org/w/index.php?title=Special:Redirect/file/'.$nombreArchivo.'&width=640';
        // return 'https://commons.wikimedia.org/w/index.php?title=Special:Redirect/file/'.$nombreArchivo.'&width=640';
    }

    /*
    Retorna URI de imagen de la empresa. Típicamente es una
    imagen del edificio corporativo.
    Wikidata en algunos casos tiene más de una imagen. Este método
    retorna la primera de ellas.
    */
    private function getImagen($res){
        $base = 'https://www.wikidata.org/wiki/'.$this->wikidata_id.'#/media/File:';
        return $base.$res['claims']['P18'][0]['mainsnak']['datavalue']['value'];
    }

    /*
    Retorna array con IDs de Wikidata que apuntan a fundadores
    */
    private function getFundadores($res){
        $fundadoresArr = [];
        if(!isset($res['claims']['P112'])){
            return [];
        }
        $data = $res['claims']['P112'];
        foreach($data as $fundador){
            $fundador_id = $fundador['mainsnak']['datavalue']['value']['id'];
            array_push($fundadoresArr,(new EntidadWD($fundador_id))->getFundador());
        }
        return $fundadoresArr;
    }

    /*
    Retorna fecha de creación de la empresa
    Formato: Día/Mes/Año
    */
    private function getCreacion($res){  
        $fecha = explode('-',$res['claims']['P571'][0]['mainsnak']['datavalue']['value']['time']);
        $anio = substr($fecha[0],1);
        $mes = $fecha[1];
        $dia = substr($fecha[2],0,2);

        $creacion = $anio;
        if($mes>0)
            $creacion = $mes.'/'.$creacion;
        if($dia>0)
            $creacion = $dia.'/'.$creacion;

        return $creacion;
    }

    /*
    Retorna ID de Wikidata que apunta a la ciudad de creación de la empresa
    */
    private function getCiudadCreacion($res){
        $ciudad_id = $res['claims']['P740'][0]['mainsnak']['datavalue']['value']['id'];
        return [
            'wikidata_id' => $ciudad_id,
            'nombre'=> (new EntidadWD($ciudad_id))->getNombreEntidad()['nombre'],
        ];
    }

    /*
    Retorna ID de Wikidata que apunta al país de origen de la empresa
    */
    private function getPais($res){
        $pais_id = $res['claims']['P17'][0]['mainsnak']['datavalue']['value']['id'];
        return [
                'wikidata_id' => $pais_id,
                'nombre'=> (new EntidadWD($pais_id))->getNombreEntidad()['nombre'],
            ];
    }

    /*
    Retorna array con IDs de Wikidata que apuntan a tipos de industrias a
    las que pertenece la empresa
    */
    private function getIndustrias($res){
        $industriesArr = [];
        $data = $res['claims']['P452'];
        foreach($data as $industry){
            $industria_id = $industry['mainsnak']['datavalue']['value']['id'];
            array_push($industriesArr,[
                'wikidata_id' => $industria_id,
                'nombre' => (new EntidadWD($industria_id))->getNombreEntidad()['nombre'],
            ]);
        }
        return $industriesArr;
    }
}
