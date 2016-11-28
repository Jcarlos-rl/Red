<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MofificacionDeLaBaseDeDatos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('Archivos', function (Blueprint $table) {
        $table->increments('id');
         $table->string('nombre', 100);
         $table->string('ubicacion', 100);
         $table->integer('id_proyecto')->unsigned();
         $table->foreign('id_proyecto')->references('id')->on('proyectos');
       });
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
