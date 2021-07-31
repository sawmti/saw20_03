<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $table = 'empresas';
    protected $primaryKey = 'empresa_id';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    public function anotaciones(){
        return $this->hasMany(Anotacion::class,'empresa_id','empresa_id');
    }

}
