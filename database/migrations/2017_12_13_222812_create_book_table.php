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
            $table->string('revision_pares');
            $table->string('contrato');
            $table->string('isbn');
            $table->string('pi');
            $table->string('paginas');
            $table->integer('estados_id');
            $table->integer('coleccion_id');

            $table->integer('facultad_id')->unsigned();
      

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
