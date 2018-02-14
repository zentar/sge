<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserLibro extends Migration
{
  /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userlibro', function(Blueprint $table) {
            $table->increments('id');

            $table->integer('libro_id')->unsigned();
            $table->foreign('libro_id')->references('id')->on('libros');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('tipo');

            $table->integer('estado');

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
        Schema::table('userlibro', function(Blueprint $table) {
            
        });
    }
}
