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

    public function medicals()
    {
        return $this->hasOne('App\Medical', 'siswa_id', 'id');
    }

    public function pendidikans()
    {
        return $this->hasOne('App\Pendidikan', 'siswa_id', 'id');
    }

    public function hobis()
    {
        return $this->hasOne('App\Hobi', 'siswa_id', 'id');
    }

    public function perkebangans()
    {
        return $this->hasOne('App\Perkembangan', 'siswa_id', 'id');
    }
}
