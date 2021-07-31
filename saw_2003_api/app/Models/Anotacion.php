<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anotacion extends Model
{
    use HasFactory;

    protected $table = 'anotaciones';

    public function empresa(){
        return $this->belongsTo(Empresa::class,'empresa_id','empresa_id');
    }

    public function propiedad(){
        return $this->belongsTo(Propiedad::class,'propiedad_id','propiedad_id');
    }
}
