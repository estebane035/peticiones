<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeticionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peticiones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->references('id')->on('users');
            $table->foreign('user_id')->references('id')->on('users')->onDelete("cascade");
            $table->float("latitud");
            $table->float("longitud");
            $table->enum("tipo", ["Seguridad Publica", "Asistencia Medica", "Proteccion Civil"]);
            $table->enum("estatus", ["Atendida", "No Atendida", "En Proceso"])->default("No Atendida");
            $table->string("comentarios")->nullable();
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
        Schema::dropIfExists('peticiones');
    }
}
