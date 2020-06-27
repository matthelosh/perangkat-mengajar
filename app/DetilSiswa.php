<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetilSiswa extends Model
{
    protected $fillable = ['siswa_id', 'semester', 'tb', 'bb', 'pendengaran', 'penglihatan', 'gigi', 'fisik_lain'];

    public function siswas()
    {
       return $this->belongsTo('App\Siswa', 'siswa_id', 'nisn');
    }
}
