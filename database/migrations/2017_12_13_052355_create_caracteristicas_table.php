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

            $table->integer('book_id')->unsigned()->unique();
            $table->foreign('book_id')->references('id')->on('books');

            $table->string('tipo_papel'); 
            
            $table->integer('tamano')->unsigned();
            $table->foreign('tamano')->references('id')->on('tamanopapel');

            $table->integer('n_paginas');
            $table->integer('color');
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
