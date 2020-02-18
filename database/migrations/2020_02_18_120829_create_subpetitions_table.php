<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubpetitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subpetitions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('petition_id');
            $table->foreign('petition_id')->references('id')->on('petitions');
            $table->unsignedBigInteger('petition_type_id');
            $table->foreign('petition_type_id')->references('id')->on('petition_types');
            $table->integer('object_id');
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
        Schema::dropIfExists('subpetitions');
    }
}
