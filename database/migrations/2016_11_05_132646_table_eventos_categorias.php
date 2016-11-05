<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableEventosCategorias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos_categorias', function (Blueprint $table) {
            $table->integer('evento_id')->unsigned()->nullable();
            $table->foreign('evento_id')->references('id')
                    ->on('eventos')->onDelete('cascade');

            $table->integer('categoria_id')->unsigned()->nullable();
            $table->foreign('categoria_id')->references('id')
                    ->on('categorias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::drop('eventos_categorias');
    }
}
