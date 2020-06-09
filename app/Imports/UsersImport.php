<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
                'nip' => $row['nip'],
                'username' => $row['username'],
                'email' => $row['email'],
                'password' => Hash::make($row['password']),
                'fullname' => $row['fullname'],
                'level' => $row['level'],
                'role' => $row['role'],
                'sekolah_id' => $row['sekolah_id'],
                'hp' => $row['hp']
        ]);
    }
}
