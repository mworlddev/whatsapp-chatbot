<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswerMappersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_mappers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('answer_id');
            $table->unsignedBigInteger('child_id');
            $table->string('input');
            $table->timestamps();

            $table->foreign('answer_id')->references('id')->on('answers')->onDelete('cascade');
            $table->foreign('child_id')->references('id')->on('answers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answer_mappers');
    }
}
