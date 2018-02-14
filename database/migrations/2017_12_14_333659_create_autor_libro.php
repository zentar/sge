<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAutorLibro extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('autorlibro', function(Blueprint $table) {
            $table->increments('id');

            $table->integer('libro_id')->unsigned();
            $table->foreign('libro_id')->references('id')->on('libros');

            $table->integer('autor_id')->unsigned();
            $table->foreign('autor_id')->references('id')->on('autores');

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
        Schema::table('autorlibro', function(Blueprint $table) {
            
        });
    }
}
