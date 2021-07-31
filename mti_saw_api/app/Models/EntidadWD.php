<?php
namespace App\Models;

use Http;

class EntidadWD{
    private $wikidata_id;
    private $apiUri = 'https://www.wikidata.org/w/api.php?action=wbgetentities&format=json&languages=es';

    function __construct($wikidata_id){
        $this->wikidata_id = $wikidata_id;
    }

    public function getNombreEntidad(){
        $uri = $this->apiUri.'&props=labels|descriptions&ids='.$this->wikidata_id;
        $res = Http::get($uri);
        $res = $res->json()['entities'][$this->wikidata_id];
        return [
            'nombre'=>ucwords($res['labels']['es']['value']),
            'descripcion'=>ucfirst(isset($res['descriptions']['es']['value'])?$res['descriptions']['es']['value']:'Sin descripción')
        ];
    }

    public function getFundador(){
        $uri = 'https://www.wikidata.org/w/api.php?action=wbgetclaims&format=json&property=P18&entity='.$this->wikidata_id;
        $res = Http::get($uri);
        $data = $res->json();

        $imagen = isset($data['claims']['P18'])?$data['claims']['P18'][0]['mainsnak']['datavalue']['value']:'';
        $fundador = $this->getNombreEntidad($this->wikidata_id);
        return [
            'wikidata_id'=>$this->wikidata_id,
            'nombre'=>$fundador['nombre'],
            'descripcion'=>$fundador['descripcion'],
            'imagen'=>$this->getImagenURI($imagen),
        ];
    }

    private function getImagenURI($nombreArchivo){
        if($nombreArchivo==""){
            return "";
        }
        return 'https://commons.wikimedia.org/w/index.php?title=Special:Redirect/file/'.$nombreArchivo.'&width=60';
    }
}