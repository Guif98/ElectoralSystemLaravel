<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SubProjetos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subProjetos', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->tinyInteger('projeto_id')->unsigned();
            $table->string('titulo');
            $table->tinyInteger('categoria_id')->unsigned();
            $table->text('descricao');
            $table->text('integrantes');
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
        Schema::dropIfExists('subProjetos');
    }
}
