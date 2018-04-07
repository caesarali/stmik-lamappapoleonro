<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlumniTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumni', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mahasiswa_id')->unsigned();
            $table->string('nama_inst')->nullable();
            $table->text('alamat_inst')->nullable();
            $table->integer('jabatan_id')->unsigned()->nullable();
            $table->integer('tahun_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('mahasiswa_id')->references('id')->on('mahasiswa')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('jabatan_id')->references('id')->on('jabatan')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('alumni');
    }
}
