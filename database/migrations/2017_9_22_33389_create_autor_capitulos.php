<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAutorCapitulos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('autorcapitulos', function(Blueprint $table) {
            $table->increments('id'); 
            $table->integer('capitulos_id')->unsigned();
            $table->foreign('capitulos_id')->references('id')->on('capitulos');
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
        Schema::table('autorcapitulos', function(Blueprint $table) {
            
        });
    }
}
