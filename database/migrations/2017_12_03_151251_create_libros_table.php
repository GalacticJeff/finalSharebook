<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLibrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libros', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo')->unique();
            $table->string('descripcion');
            $table->string('autor');
            $table->integer('year');
            $table->string('portada')->null();
            $table->timestamps();
        });

        Schema::create('biblioteca', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('usuario');
            $table->string('libro');
            $table->timestamps();

            $table->foreign('usuario')->references('id')->on('users');
            $table->foreign('libro')->references('titulo')->on('libros');
        
        });

        Schema::create('generos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('genero');
            $table->string('descripcion');
            $table->timestamps();
        
        });

    

        Schema::create('libros_generos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('libro');
            $table->integer('genero');
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
        Schema::dropIfExists('libros');
        Schema::dropIfExists('biblioteca');
        Schema::dropIfExists('generos');
        Schema::dropIfExists('libros_generos');
        
        
    }
}
