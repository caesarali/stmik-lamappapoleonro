<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    protected $table = 'alumni';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function mahasiswa()
    {
    	return $this->belongsTo('App\Mahasiswa');
    }

    public function jabatan()
    {
    	return $this->belongsTo('App\Jabatan');
    }

    public function tahun()
    {
    	return $this->belongsTo('App\Tahun');
    }
}
