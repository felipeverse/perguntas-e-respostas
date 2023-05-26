<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartidaJogadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partida_jogadas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('partida_id');
            $table->foreign('partida_id')->references('id')->on('partidas');

            $table->unsignedBigInteger('fase_id');
            $table->foreign('fase_id')->references('id')->on('gincana_fases');

            $table->unsignedBigInteger('grupo_id');
            $table->foreign('grupo_id')->references('id')->on('gincana_grupos');

            $table->unsignedBigInteger('pergunta_id');
            $table->foreign('pergunta_id')->references('id')->on('perguntas');

            $table->unsignedBigInteger('resposta_id');
            $table->foreign('resposta_id')->references('id')->on('respostas');

            $table->enum('correta', ['E', 'P', 'C']);
            $table->integer('pergunta_ordem');
            $table->integer('pontuacao');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partida_jogadas');
    }
}
