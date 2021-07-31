<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnotacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anotaciones', function (Blueprint $table) {
            $table->id();
            $table->string('valor');
            $table->string('empresa_id',10);
            $table->string('propiedad_id',10);
            $table->foreign('empresa_id')->references('empresa_id')->on('empresas');
            $table->foreign('propiedad_id')->references('propiedad_id')->on('propiedades');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anotaciones');
    }
}
