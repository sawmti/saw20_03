<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LoadEmpresasData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('empresas')->insert([
            ['empresa_id' => 'Q11463'],
            ['empresa_id' => 'Q173395'],
            ['empresa_id' => 'Q182477'],
            ['empresa_id' => 'Q19900'],
            ['empresa_id' => 'Q2283'],
            ['empresa_id' => 'Q248'],
            ['empresa_id' => 'Q312'],
            ['empresa_id' => 'Q355'],
            ['empresa_id' => 'Q37156'],
            ['empresa_id' => 'Q3884'],
            ['empresa_id' => 'Q430745'],
            ['empresa_id' => 'Q544847'],
            ['empresa_id' => 'Q918'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
