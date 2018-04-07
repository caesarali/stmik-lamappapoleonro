<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisBeasiswa extends Model
{
    protected $table = 'jenis_beasiswa';

    protected $fillable = ['name'];
}
