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
            $table->increments('id');
            $table->string('nombre',50);
            $table->text('descripcion');
            $table->string('lugar',150);
            $table->dateTime('inicioRegistro');
            $table->dateTime('fin_registro');
            $table->dateTime('inicio_evento');
            $table->dateTime('fin_evento');
            $table->string('categoria',30);
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
