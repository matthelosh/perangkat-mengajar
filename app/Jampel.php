<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jampel extends Model
{
    protected $fillable = ['jam', 'awal', 'akhir', 'sekolah_id'];
}
