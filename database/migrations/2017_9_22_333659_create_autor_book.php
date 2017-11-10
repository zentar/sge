<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAutorBook extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('autorbook', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('book_id');
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
        Schema::table('autorbook', function(Blueprint $table) {
            
        });
    }
}
