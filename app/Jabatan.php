<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $table = 'jabatan';

    protected $fillable = ['name'];

    public function alumni()
    {
    	return $this->hasMany('App\Alumni');
    }
}
