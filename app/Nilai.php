<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $fillable = ['semester', 'rombel_id', 'periode', 'mapel_id', 'siswa_id', 'nilai', 'tingkat', 'kd_id'];

    public function siswas()
    {
        $this->belongsTo('App\Siswa', 'siswa_id', 'nisn');
    }
}
