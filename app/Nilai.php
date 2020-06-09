<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $fillable = ['semester', 'rombel_id', 'periode', 'tema_id', 'subtema_id', 'mapel_id', 'pembelajaran_id', 'siswa_id', 'nilai'];

    public function siswas()
    {
        $this->belongsTo('App\Siswa', 'siswa_id', 'nisn');
    }
}
