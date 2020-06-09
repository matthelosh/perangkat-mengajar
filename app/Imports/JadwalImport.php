<?php

namespace App\Imports;

use App\Jadwal;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Auth;

class JadwalImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Jadwal([
            'sekolah_id' => Auth::user()->sekolah_id,
            'kode_jadwal' => $row['kode_jadwal'],
            'hari' => $row['hari'],
            'mapel_id' => $row['mapel_id'],
            'rombel_id' => $row['rombel_id'],
            'guru_id' => $row['guru_id'],
            'jamke' => $row['jamke'],
            'ket' => $row['ket'],
            'status' => $row['status']
        ]);
    }
}
