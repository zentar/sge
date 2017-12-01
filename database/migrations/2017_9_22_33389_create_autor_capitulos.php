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
            $table->integer('capitulos_id');
            $table->integer('autor_id');
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
