<?php

namespace App\Imports;

use App\Pemetaan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PemetaanImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Pemetaan([
            'tingkat' => $row['tingkat'],
            'mapel_id' => $row['mapel_id'],
            'subtema_id' => $row['subtema_id'],
            'kd_id' => $row['kd_id'],
            'semester_id' => $row['semester_id'],
            'keyword' => $row['keyword'],
            'sekolah_id' => $row['sekolah_id']
        ]);
    }
}
