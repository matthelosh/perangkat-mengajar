<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tema extends Model
{
    protected $fillable = ['tingkat', 'kode_tema', 'teks_tema'];

    public function subtemas()
    {
        return $this->hasMany('App\Subtema', 'tema_id', 'kode_tema');
    }
}
