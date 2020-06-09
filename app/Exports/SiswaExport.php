<?php

namespace App\Exports;

use App\Siswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Auth;
// use Maatwebsite\Excel\Concerns\WithDrawings;
// use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\StringValueBinder;

class SiswaExport extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements FromCollection, WithHeadings, WithCustomValueBinder
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $npsn = Auth::user()->sekolah_id;
        return Siswa::where('sekolah_id', $npsn)->select('nis', 'nisn', 'nama_siswa', 'jk', 'hp', 'email', 'rombel_id', 'alamat')->get();
    }

    public function headings() : array
    {
        $npsn = Auth::user()->sekolah_id;
        $sekolah = 'App\Sekolah'::where('npsn', $npsn)->first();
        return [
            ['Data Siswa ' . $sekolah->nama_sekolah, '','','', date('d-m-Y')],
            ['NIS', 'NISN', 'Nama', 'JK', 'HP', 'Email', 'Kelas', 'Alamat']
        ];
    }

    // public function drawings()
    // {
    //     $drawing = new Drawing();
    //     $drawing->setName('Logo');
    //     $drawing->setDescription('This is my logo');
    //     $drawing->setPath(public_path('/images/faces/face1.jpg'));
    //     $drawing->setHeight(90);
    //     $drawing->setCoordinates('A1');

    //     return $drawing;
    // }
}
