<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersProyectos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_proyectos', function(Blueprint $table)
        {
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')
                    ->on('users')->onDelete('cascade');

            $table->integer('proyecto_id')->unsigned()->nullable();
            $table->foreign('proyecto_id')->references('id')
                    ->on('proyectos')->onDelete('cascade');

            $table->dateTime('fecha_registro');
            $table->string('rol',10);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::drop('users_proyectos');
    }
}
