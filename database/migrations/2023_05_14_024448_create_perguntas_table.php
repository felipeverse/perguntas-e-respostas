<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerguntasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perguntas', function (Blueprint $table) {
            $table->id();
            $table->text('enunciado');
            $table->enum('tipo', ['DISCURSIVA', 'OBJETIVA']);

            $table->unsignedBigInteger('nivel_id');
            $table->foreign('nivel_id')->references('id')->on('niveis');

            $table->unsignedBigInteger('tema_id');
            $table->foreign('tema_id')->references('id')->on('temas');


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
        Schema::dropIfExists('perguntas');
    }
}
