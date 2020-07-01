<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ortu extends Model
{
    protected $fillable = ['siswa_id', 'nama_ayah', 'nama_ibu', 'job_ayah', 'job_ibu', 'nama_wali', 'job_wali', 'alamat_wali', 'hp_ortu'];

    public function siswas()
    {
        return $this->belongsTo('App\Siswa', 'siswa_id', 'nisn');
    }
}
