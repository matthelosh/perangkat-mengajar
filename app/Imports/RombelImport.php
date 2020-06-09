<?php

namespace App\Imports;

use App\Rombel;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RombelImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Rombel([
            'sekolah_id' => Auth::user()->sekolah_id,
            'kode_rombel' => $row['kode_rombel'],
            'nama_rombel' => $row['nama_rombel'],
            'guru_id' => ($row['guru_id']) ? $row['guru_id'] : '0',
            'tingkat' => $row['tingkat'],
            'status' => ($row['status']) ? $row['status'] : 'aktif'
        ]);
    }
}
