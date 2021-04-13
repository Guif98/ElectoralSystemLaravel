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
            $table->increments('id');
            $table->bigInteger('cpf')->nullable('false');
            $table->string('nome')->nullable('false');
            $table->string('sobrenome')->nullable('false');
            $table->tinyInteger('subProjeto_id')->unsigned();
            $table->tinyInteger('categoria_id')->unsigned();
            $table->tinyInteger('projeto_id')->unsigned()->nullable('false');
            $table->foreign('subProjeto_id')->references('id')->on('subProjetos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('projeto_id')->references('id')->on('projetos')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('votos');
    }
}
