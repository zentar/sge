<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampoDetalladoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campo_detallado', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo');
            $table->string('codigo');

            $table->integer('campo_especifico')->unsigned();
            $table->foreign('campo_especifico')->references('id')->on('campo_especifico');
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
        Schema::dropIfExists('campo_detallado');
    }
}
