<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersProyectos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('users_proyectos', function ($table) {
         $table->dropColumn('rol');
         $table->dropColumn('fecha_registro');
      });
      Schema::table('users_proyectos', function ($table) {
         $table->dateTime('fecha_registro')->default(DB::raw('CURRENT_TIMESTAMP'));
         $table->enum('rol',['ROLE_LEADER','ROLE_COLLABORATOR'])->default('ROLE_COLLABORATOR');
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
