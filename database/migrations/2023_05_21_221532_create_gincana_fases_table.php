<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGincanaFasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gincana_fases', function (Blueprint $table) {
            $table->id();
            $table->integer('ordem');
            $table->integer('pontuacao_erro');
            $table->integer('pontuacao_parcial');
            $table->integer('pontuacao_acerto');
            $table->integer('perguntas_por_grupo');
            $table->boolean('selecionar_tema_manualmente');
            $table->enum('tipo', ['DISCURSIVA', 'OBJETIVA']);

            $table->unsignedBigInteger('gincana_id');
            $table->foreign('gincana_id')->references('id')->on('gincanas');

            $table->unsignedBigInteger('nivel_id');
            $table->foreign('nivel_id')->references('id')->on('niveis');

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
        Schema::dropIfExists('gincana_fases');
    }
}
