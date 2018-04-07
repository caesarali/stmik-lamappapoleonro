<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Beasiswa extends Model
{
    protected $table = 'beasiswa';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function jenisBeasiswa()
    {
    	return $this->belongsTo('App\JenisBeasiswa');
    }

    public function tahun()
    {
    	return $this->belongsTo('App\Tahun');
    }
}
