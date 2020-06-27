<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rombel extends Model
{
    protected $table='rombels';
    protected $fillable = ['kode_rombel', 'nama_rombel', 'tingkat', 'status', 'guru_id'];

    public function sekolahs()
    {
    	return $this->belongsTo('App\Sekolah', 'sekolah_id', 'npsn');
    }

    public function gurus()
    {
        return $this->belongsTo('App\Guru', 'guru_id', 'nip');
    }

    public function siswas()
    {
    	return $this->hasMany('App\Siswa', 'rombel_id', 'kode_rombel');
    }
}
