<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaracteristicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caracteristicas', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('libro_id')->unsigned()->unique();
            $table->foreign('libro_id')->references('id')->on('libros');
            
            $table->integer('tipopapel_id')->unsigned();
            $table->foreign('tipopapel_id')->references('id')->on('tipopapel');
            
            $table->integer('tamano')->unsigned();
            $table->foreign('tamano')->references('id')->on('tamanopapel');

            $table->integer('colorpapel_id')->unsigned();
            $table->foreign('colorpapel_id')->references('id')->on('colorpapel');

            $table->integer('n_paginas');
            $table->string('cubierta'); 
            $table->string('solapas'); 
            $table->string('observaciones'); 
            $table->softDeletes();
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
        Schema::dropIfExists('caracteristicas');
    }
}
