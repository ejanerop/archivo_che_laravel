<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_dates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('date_type_id');
            $table->foreign('date_type_id')->references('id')->on('date_types');
            $table->tinyInteger('dayStart')->nullable($value = true);
            $table->tinyInteger('monthStart')->nullable($value = true);
            $table->year('yearStart');
            $table->tinyInteger('dayEnd')->nullable($value = true);
            $table->tinyInteger('monthEnd')->nullable($value = true);
            $table->year('yearEnd')->nullable($value = true);
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
        Schema::dropIfExists('custom_dates');
    }
}
