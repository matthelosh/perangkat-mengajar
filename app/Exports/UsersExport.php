<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\StringValueBinder;
class UsersExport extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements FromCollection, WithHeadings, WithCustomValueBinder
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if(Auth::user()->level == 'superadmin') {
            return User::select('sekolah_id', 'nip', 'username', 'email', 'fullname', 'hp', 'level', 'role')->get();
        } else {
            $npsn = AUth::user()->sekolah_id;
            return User::where([['sekolah_id', '=', $npsn],['level', '!=', 'admin']])->select('sekolah_id', 'nip', 'username', 'email', 'fullname', 'hp', 'level', 'role')->get();
        }
    }

    public function headings() : array
    {
        return [
            'ID Sekolah', 'Nip', 'Username', 'Email', 'Nama Lengkap', 'HP', 'Level', 'Role'
        ];
    }

    // public function columnFormats() : array
    // {
    //     # code...
    // }
}
