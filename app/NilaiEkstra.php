<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NilaiEkstra extends Model
{
    protected $fillable = ['semester', 'ekstra_id', 'rombel_id', 'siswa_id', 'ket'];

    public function ekskuls()
    {
        return $this->belongsTo('App\Ekskul', 'ekstra_id', 'kode_ekskul');
    }

    public function siswas()
    {
        return $this->belongsTo('App\Siswa', 'siswa_id', 'nisn');
    }
}
