<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ki extends Model
{
    protected $fillable = ['sekolah_id', 'tingkat', 'mapel_id', 'kode_ki', 'teks_ki', 'jenjang'];

    public function kds()
    {
        return $this->hasMany('App\Kd', 'ki_id', 'kode_ki');
    }
}
