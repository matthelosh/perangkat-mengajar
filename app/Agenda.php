<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $fillable = ['tapel', 'tanggal', 'mulai', 'selesai', 'lokasi', 'acara', 'uraian'];
}
