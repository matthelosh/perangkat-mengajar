<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Pemetaan extends Model
{
    use Uuid;
    protected $fillable = [
        // $table->string('tingkat', 3);
        //     $table->string('mapel_id', 10);
        //     $table->string('subtema_id', 10);
        //     $table->string('kd_id', 10);
        //     $table->string('semester_id', 10)->nullable();
        //     $table->string('keyword', 60);
        //     $table->string('sekolah_id', 30);
        'tingkat','mapel_id', 'subtema_id', 'kd_id', 'semester_id', 'keyword', 'sekolah_id'
    ];
}
