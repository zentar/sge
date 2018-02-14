<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCotizacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotizaciones', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('libro_id')->unsigned();
            $table->foreign('libro_id')->references('id')->on('libros');

            $table->integer('archivo_id')->unsigned();
            $table->foreign('archivo_id')->references('id')->on('archivos');

            $table->string('imprenta');
            $table->string('tiraje');

            $table->double('valor');
            $table->integer('iva');
            $table->double('total');
            
            $table->string('estado');

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
        Schema::dropIfExists('cotizaciones');
    }
}
