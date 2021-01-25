<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswerTextsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_texts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('answer_id');
            $table->unsignedBigInteger('lang_id');
            $table->text('text');
            $table->timestamps();

            $table->foreign('answer_id')->references('id')->on('answers')->onDelete('cascade');
            $table->foreign('lang_id')->references('id')->on('languages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answer_texts');
    }
}
