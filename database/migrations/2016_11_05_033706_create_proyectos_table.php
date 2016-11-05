<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProyectosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyectos', function (Blueprint $table) {
            $table->increments('id');           
            $table->string('nombre',45);
            $table->string('categoria',45);
            $table->string('descripcion',45);
            
            $table->integer('idEvento')->unsigned()->nullable();
            $table->foreign('idEvento')->references('id')
                  ->on('evento')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('proyectos');
    }
}
