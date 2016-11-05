<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersConocimientos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('users_conocimientos', function(Blueprint $table)
        {
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')
                    ->on('users')->onDelete('cascade');

            $table->integer('conocimiento_id')->unsigned()->nullable();
            $table->foreign('conocimiento_id')->references('id')
                    ->on('conocimientos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::drop('users_conocimientos');
    }
}
