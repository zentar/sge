<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchivoLibro extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archivolibro', function(Blueprint $table) {
            $table->increments('id');

            $table->integer('libro_id')->unsigned();
            $table->foreign('libro_id')->references('id')->on('libros');

            $table->integer('archivo_id')->unsigned();
            $table->foreign('archivo_id')->references('id')->on('archivos');

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
         Schema::table('archivolibro', function(Blueprint $table) {
            
        });
    }
}
