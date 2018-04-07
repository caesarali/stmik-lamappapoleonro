<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeasiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beasiswa', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->integer('jenis_beasiswa_id')->unsigned();
            $table->string('sumber')->nullable();
            $table->text('syarat')->nullable();
            $table->integer('tahun_id')->unsigned();
            $table->timestamps();

            $table->foreign('jenis_beasiswa_id')->references('id')->on('jenis_beasiswa')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tahun_id')->references('id')->on('tahun')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beasiswa');
    }
}
