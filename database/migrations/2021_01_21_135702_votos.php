<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Votos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votos', function (Blueprint $table) {
            $table->increments('id')->nullable(false);
            $table->integer('eleitor_id')->unsigned()->unique();
            $table->tinyInteger('categoria_id')->unsigned()->unique();
            $table->tinyInteger('projeto_id')->unsigned();
            $table->foreign('categoria_id')->references('id')->on('categoria');
            $table->foreign('eleitor_id')->references('id')->on('eleitores');
            $table->foreign('projeto_id')->references('id')->on('projetos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('votos');
    }
}
