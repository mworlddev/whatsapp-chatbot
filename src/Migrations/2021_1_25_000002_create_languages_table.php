<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->nullable();
            $table->timestamps();
        });

        // MAKE lang_id in users a foreign key.
        Schema::table('users', function(Blueprint $table) {
            $table->foreign('lang_id')->references('id')->on('languages')->onDelete('cascade');
        });

        \DB::table('languages')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'English',
                'code' => 'en',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Arabic',
                'code' => 'ar',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('languages');
    }
}
