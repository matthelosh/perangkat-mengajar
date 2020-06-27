<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    protected $fillable = ['npsn', 'kode_sekolah', 'nama_sekolah', 'alamat', 'desa', 'kec', 'kab', 'prov', 'kode_pos', 'telp', 'email', 'website', 'bujur', 'lintang', 'gps', 'kepsek_id', 'fullday', 'jml_jam', 'jenjang'];

    public function users()
    {
        return $this->hasMany('App\User', 'sekolah_id', 'npsn');
    }

    public function kepsek()
    {
        return $this->belongsTo('App\Guru', 'kepsek_id', 'nip');
    }

}
