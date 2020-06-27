<?php

namespace App\Imports;

use App\Kd;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class KdImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Kd([
            'ki_id' => $row['ki_id'],
            'kode_kd' => $row['kode_kd'],
            'mapel_id' => $row['mapel_id'],
            'tingkat' => $row['tingkat'],
            'teks_kd' => $row['teks_kd'],
            'sekolah_id' => '0'
        ]);
    }
}
