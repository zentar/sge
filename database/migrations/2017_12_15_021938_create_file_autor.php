<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileAutor extends Migration
{
  /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fileautor', function(Blueprint $table) {
            $table->increments('id');

            $table->integer('file_id')->unsigned();
            $table->foreign('file_id')->references('id')->on('file');

            $table->integer('autor_id')->unsigned();
            $table->foreign('autor_id')->references('id')->on('autors');

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
         Schema::table('fileautor', function(Blueprint $table) {
            
        });
    }
}
