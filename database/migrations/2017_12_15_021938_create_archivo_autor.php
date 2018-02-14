<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchivoAutor extends Migration
{
  /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archivoautor', function(Blueprint $table) {
            $table->increments('id');

            $table->integer('archivo_id')->unsigned();
            $table->foreign('archivo_id')->references('id')->on('archivos');

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
         Schema::table('archivoautor', function(Blueprint $table) {
            
        });
    }
}
