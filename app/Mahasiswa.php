<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function getRouteKeyName()
	{
	    return 'stambuk';
	}

    public function tahun() {
    	return $this->belongsTo('App\Tahun');
    }

    public function jurusan() {
    	return $this->belongsTo('App\Jurusan');
    }

    public function alumni()
    {
        return $this->hasOne('App\Alumni');
    }
}
