<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMensajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensajes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('remite_id')->unsigned()->nullable();
            $table->foreign('remite_id')->references('id')
                    ->on('users')->onDelete('cascade');

            $table->integer('recibe_id')->unsigned()->nullable();
            $table->foreign('recibe_id')->references('id')
                    ->on('users')->onDelete('cascade');
            
            $table->enum('status',['no_leido','leido','guardado','importante'])->default('no_leido');
            $table->text('cuerpo');
            $table->timestamp('fecha_envio')->nullable();
            $table->timestamp('fecha_leido')->nullable();
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
        Schema::drop('mensajes');
    }
}
