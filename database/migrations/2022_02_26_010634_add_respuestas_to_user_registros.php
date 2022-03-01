<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRespuestasToUserRegistros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_registros', function (Blueprint $table) {
            $table->string('respuesta_1')->nullable();
            $table->string('respuesta_2')->nullable();
            $table->string('respuesta_3')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_registros', function (Blueprint $table) {
            //
        });
    }
}
