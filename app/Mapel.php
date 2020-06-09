<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
  protected $fillable = ['kode_mapel', 'nama_mapel', 'label'];

  public function jadwals()
  {
    return $this->hasMany('App\Jadwal', 'mapel_id', 'kode_mapel');
  }

  public function pemetaans()
  {
      return $this->hasMany('App\Pemetaan', 'mapel_id', 'kode_mapel');
  }

  public function kds()
  {
      return $this->hasMany('App\Kd', 'mapel_id', 'kode_mapel');
  }
}
