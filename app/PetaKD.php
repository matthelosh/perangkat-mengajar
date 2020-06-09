<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PetaKD extends Model
{
    protected $fillable = ['tingkat', 'mapel_id','bab_id', 'ki_id', 'kd_id'];
    protected $table = 'peta_kds';

    public function kds()
    {
        return $this->belongsTo('App\Kd', 'kd_id', 'kode_kd');
    }
}
