<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMesajsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mesajs', function (Blueprint $table) {
            $table->increments('id');
            $table->string("ip");
            $table->string("isim");
            $table->string("konu");
            $table->string("mail");
            $table->text("mesaj");
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
        Schema::dropIfExists('mesajs');
    }
}
