<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLibroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {        
        Schema::create('libros', function (Blueprint $table) {            
            $table->increments('id');
            $table->string('titulo');
   
            $table->integer('estados_id')->unsigned();
            $table->foreign('estados_id')->references('id')->on('estados');

            $table->integer('coleccion_id')->unsigned();
            $table->foreign('coleccion_id')->references('id')->on('coleccion');

            $table->integer('facultad_id')->unsigned();
            $table->foreign('facultad_id')->references('id')->on('facultad');

            $table->integer('campo_general')->unsigned();
            $table->foreign('campo_general')->references('id')->on('campo_general');

            $table->integer('campo_especifico')->unsigned();
            $table->foreign('campo_especifico')->references('id')->on('campo_especifico');

            $table->integer('campo_detallado')->unsigned();
            $table->foreign('campo_detallado')->references('id')->on('campo_detallado');  

            $table->string('ISBN');
            $table->string('IEPI');

            $table->integer('asignado');

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
        Schema::drop('libros');
    }
    
}
