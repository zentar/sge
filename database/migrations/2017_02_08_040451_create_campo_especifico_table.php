<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampoEspecificoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campo_especifico', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo');
            $table->string('codigo');

            $table->integer('campo_general')->unsigned();
            $table->foreign('campo_general')->references('id')->on('campo_general');
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
        Schema::dropIfExists('campo_especifico');
    }
}
