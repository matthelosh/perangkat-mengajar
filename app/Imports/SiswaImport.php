<?php

namespace App\Imports;

use App\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;

class SiswaImport implements ToModel, WithHeadingRow
{
    private $password = '';
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        return new Siswa([
            'sekolah_id' => $row['sekolah_id'],
            'ortu_id' => ($row['ortu_id']) ? $row['ortu_id'] : '0',
            'rombel_id' => $row['rombel_id'],
            'nis' => $row['nis'],
            'nisn' => $row['nisn'],
            'nama_siswa' => $row['nama_siswa'],
            'jk' => $row['jk'],
            'tempat_lahir' => $row['tempat_lahir'],
            'tanggal_lahir' => $row['tanggal_lahir'],
            'alamat' => $row['alamat'],
            'desa' => $row['desa'],
            'kec' => $row['kec'],
            'kab' => $row['kab'],
            'prov' => $row['prov'],
            'kode_pos' => $row['kode_pos'],
            'hp' => ($row['hp']) ? $row['hp'] : '621234567890',
            'email' => ($row['email']) ? $row['email'] : $row['nis'].'@sekedar.com',
            'password' => $this->password,
            'level' => $row['level'],
            'role' => $row['role']
        ]);
    }

    public function __construct()
    {
         $this->password = Hash::make('abcde');
    }
}
