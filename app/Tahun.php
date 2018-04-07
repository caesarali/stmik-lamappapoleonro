<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tahun extends Model
{
    protected $table = 'tahun';

    protected $fillable = ['tahun'];

    public function mahasiswa()
    {
    	return $this->hasMany('App\Mahasiswa');
    }

    public function jurusan()
    {
    	return $this->hasMany('App\Jurusan');
    }
}
