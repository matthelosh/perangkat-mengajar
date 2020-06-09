<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subtema extends Model
{
    protected $fillable = ['sekolah_id', 'tema_id', 'tingkat', 'kode_subtema', 'teks_subtema', 'jenjang'];

    public function temas()
    {
        return $this->hasMany('App\Subtema', 'tema_id', 'kode_tema');
    }

}
