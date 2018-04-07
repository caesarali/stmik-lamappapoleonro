<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $table = 'jurusan';

    protected $fillable = ['name', 'jenjang', 'slug'];

    public function getRouteKeyName()
	{
	    return 'slug';
	}

    public function mahasiswa()
    {
    	return $this->hasMany('App\Mahasiswa');
    }
}
