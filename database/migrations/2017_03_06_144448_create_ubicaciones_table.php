<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUbicacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ubicacion', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('idUsuario');
            $table->dateTime('timeWhen');
            $table->string('vodPostal');
            $table->decimal('long', 10, 7);
            $table->decimal('lat', 10, 7);
            $table->string('pais');
            $table->string('comunidad');
            $table->string('ciudad');
            $table->string('direccion');
            $table->string('num');
            $table->string('piso');
            $table->string('esc');
            $table->string('Puerta');
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ubicacion');
    }
}
