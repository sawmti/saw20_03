<?php
namespace App\Models;

use Http;

class ListaWD{
    private $apiUri = 'https://www.wikidata.org/w/api.php?action=wbgetentities&format=json&languages=es';

    public function getListaEmpresas($lista_ids){
        $uri = $this->apiUri.'&props=labels|descriptions&ids='.$lista_ids;
        $idsArr = explode('|',$lista_ids);
        $res = Http::get($uri);
        $data = $res->json()['entities'];
        $empresasArr = [];
        foreach($data as $empresa){
            array_push($empresasArr,[
                'empresa_id' => $empresa['id'],
                'nombre' => $empresa['labels']['es']['value'],
                'descripcion' => ucfirst(isset($empresa['descriptions']['es'])?$empresa['descriptions']['es']['value']:'Sin descripción'),
            ]);
        }
        $empresasArr = collect($empresasArr);
        return $empresasArr->sortBy('nombre')->values()->toArray();
    }
}