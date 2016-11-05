<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->increments('idEvento');
            $table->string('nombre');
            $table->string('organizador');
            $table->date('fecha');
            $table->string('lugar');
            $table->string('tipo');
            $table->string('ciudad');
            $table->string('horario');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('eventos');
    }
}
