<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description')->nullable($value = true);
            $table->string('author');
            $table->date('date');
            $table->unsignedBigInteger('document_type_id');
            $table->unsignedBigInteger('access_level_id');
            $table->foreign('document_type_id')->references('id')->on('document_type');
            $table->foreign('access_level_id')->references('id')->on('access_levels');
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
        Schema::dropIfExists('documents');
    }
}
