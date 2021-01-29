<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Fotos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fotos', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->tinyInteger('subprojeto_id')->unsigned();
            $table->string('foto');
            $table->foreign('subprojeto_id')->references('id')->on('subProjetos');
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
        Schema::dropIfExists('fotos');
    }
}
