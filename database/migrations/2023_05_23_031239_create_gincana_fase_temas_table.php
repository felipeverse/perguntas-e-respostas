<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGincanaFaseTemasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gincana_fase_temas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('tema_id');
            $table->foreign('tema_id')->references('id')->on('temas');

            $table->unsignedBigInteger('gincana_fase_id');
            $table->foreign('gincana_fase_id')->references('id')->on('gincana_fases');

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
        Schema::dropIfExists('gincana_fase_temas');
    }
}
