<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointLivraisonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('point_livraisons', function (Blueprint $table) {
            $table->id();
            $table->string('nom_point');
            $table->string('description');
            $table->integer('prix');
            $table->integer('ville')->unsigned();
            $table->foreign('ville')->references('id')->on('villes');
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
        Schema::dropIfExists('point_livraisons');
    }
}
