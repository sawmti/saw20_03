<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propiedad extends Model
{
    use HasFactory;

    protected $table = 'propiedades';
    protected $primaryKey = 'propiedad_id';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = true;

    public function anotaciones(){
        return $this->hasMany(Anotacion::class,'propiedad_id','propiedad_id');
    }
}
