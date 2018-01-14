<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("movie_id");
            $table->string("dil");
            $table->string("kaynak");
            $table->string("part1");
            $table->string("part2")->nullable();
            $table->string("part3")->nullable();
            $table->string("part4")->nullable();
            $table->string("part5")->nullable();
            $table->string("part6")->nullable();
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
        Schema::dropIfExists('videos');
    }
}
