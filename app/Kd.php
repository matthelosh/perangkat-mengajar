<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kd extends Model
{
    protected $fillable = ['sekolah_id', 'tingkat', 'mapel_id', 'ki_id', 'kode_kd', 'teks_kd', 'jenjang'];

    public function kis()
    {
        return $this->belongsTo('App\Ki', 'ki_id', 'kode_ki');
    }

    public function pemetaans()
    {
        return $this->hasMany('App\Pemetaan', 'kd_id', 'kode_kd');
    }

    public function mapels()
    {
        return $this->belongsTo('App\Mapel', 'mapel_id', 'kode_mapel');
    }

    public function petas()
    {
        return $this->hasMany('App\PetaKD', 'kd_id', 'kode_kd');
    }

    public function prosems()
    {
        return $this->hasOne('App\Prosem', 'kd_id', 'kode_kd');
    }
}
