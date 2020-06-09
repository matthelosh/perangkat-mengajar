<?php

namespace App\Imports;

use App\Sekolah;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SekolahImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Sekolah([
          'npsn' => $row['npsn'],
          'kode_sekolah' => $row['kode_sekolah'],
          'nama_sekolah' => $row['nama_sekolah'],
          'alamat' => $row['alamat'],
          'desa' => $row['desa'],
          'kec' => $row['kec'],
          'kab' => $row['kab'],
          'prov' => $row['prov'],
          'kode_pos' => $row['kode_pos'],
          'telp' => $row['telp'],
          'email' => $row['email'],
          'website' => $row['website'],
          'bujur' => $row['bujur'],
          'lintang' => $row['lintang'],
          'jml_jam' => $row['jml_jam'],
          'jenjang' => $row['jenjang'],
          'gps' => $row['gps'],
          'kepsek_id' => $row['kepsek_id'],
          'fullday' => $row['fullday']
        ]);
    }
}
