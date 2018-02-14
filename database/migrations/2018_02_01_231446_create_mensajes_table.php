<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMensajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensajes', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('libro_id')->unsigned();
            $table->foreign('libro_id')->references('id')->on('libros');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('mensaje',500);
            
          //  $table->integer('file_id')->default(0);

            $table->integer('archivo_id')->nullable()->unsigned()->default(null);
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
        Schema::dropIfExists('mensajes');
    }
}
