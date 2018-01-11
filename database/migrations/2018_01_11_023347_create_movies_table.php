<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->increments('id');
            $table->string("imdb_id")->nullable();
            $table->integer("tmdb_id")->nullable();
            $table->string("name");
            $table->string("slug");
            $table->string("orj_name")->nullable();
            $table->string("poster_url");
            $table->string("backdrop_url");
            $table->string("belongs_to_collection");
            $table->float("puan")->default(0);
            $table->integer("year");
            $table->text("overview");
            $table->string("categories")->nullable();
            $table->integer("duration")->default(0);
            $table->integer("seen")->default(0);
            $table->integer("comments")->default(0);
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
        Schema::dropIfExists('movies');
    }
}
