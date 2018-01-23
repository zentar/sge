<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {        
        Schema::create('books', function (Blueprint $table) {            
            $table->increments('id');
            $table->string('titulo');
   
            $table->integer('estados_id')->unsigned();
            $table->foreign('estados_id')->references('id')->on('estados');

            $table->integer('coleccion_id')->unsigned();
            $table->foreign('coleccion_id')->references('id')->on('coleccion');

            $table->integer('facultad_id')->unsigned();
            $table->foreign('facultad_id')->references('id')->on('facultad');

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
        Schema::drop('books');
    }
    
}
