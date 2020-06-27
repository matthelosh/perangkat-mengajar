<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ekskul extends Model
{
    protected $fillable = ['kode_ekskul', 'nama_ekskul', 'ket'];

    public function siswas()
    {
        return $this->belongsTo('App\Siswa', 'siswa_id', 'nisn');
    }

    public function ektras()
    {
        return $this->hasMany('App\NilaiEkstra', 'ekstra_id', 'kode_ekskul');
    }
}
