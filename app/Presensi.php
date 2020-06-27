<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    protected $fillable = ['semester', 'siswa_id', 'rombel_id', 'sakit', 'izin', 'alpa'];

    public function siswas()
    {
        return $this->belongsTo('App\Siswa', 'siswa_id', 'nisn');
    }
}
