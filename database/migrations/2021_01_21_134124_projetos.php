<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Projetos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projetos', function (Blueprint $table) {
            $table->tinyIncrements('id')->nullable(false);
            $table->tinyInteger('categoria_id')->unsigned()->nullable(false);
            $table->string('nome')->nullable(false);
            $table->text('participantes')->nullable(false);
            $table->string('secretaria')->nullable(false);
            $table->foreign('categoria_id')->references('id')->on('categoria');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projetos');
    }
}
