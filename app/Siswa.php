<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Notification;
// use Laravel\Passport\HasApiTokens;

class Siswa extends Authenticatable
{
  use Notifiable;

  protected $guard = 'siswa';

    protected $fillable = ['sekolah_id', 'ortu_id', 'rombel_id', 'nis', 'nisn', 'nama_siswa', 'jk','agama', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'desa', 'kec', 'kab', 'prov', 'kode_pos', 'hp', 'email', 'password', 'level', 'role'];

    protected $hidden = ['password', 'remember_token'];

    public function rombels()
    {
        return $this->belongsTo('App\Rombel', 'rombel_id', 'kode_rombel');
    }

    public function details()
    {
        $this->hasMany('App\DetilSiswa', 'siswa_id', 'nisn');
    }

    public function nilais()
    {
        return $this->hasMany('App\Nilai', 'siswa_id', 'nisn');
    }

    public function ekstras()
    {
       return $this->hasMany('App\NilaiEkstra', 'siswa_id', 'nisn');
    }

    public function prestasis()
    {
        return $this->hasMany('App\Prestasi', 'siswa_id', 'nisn');
    }

    public function presensis()
    {
        return $this->hasMany('App\Presensi', 'siswa_id', 'nisn');
    }
}
