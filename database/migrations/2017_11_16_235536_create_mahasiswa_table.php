<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMahasiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('stambuk', 20);
            $table->boolean('jk');
            $table->integer('jurusan_id')->unsigned();
            $table->integer('tahun_id')->unsigned();
            $table->tinyInteger('status')->unsigned()->default(0);
            $table->timestamps();

            $table->foreign('jurusan_id')->references('id')->on('jurusan')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('mahasiswa');
    }
}
