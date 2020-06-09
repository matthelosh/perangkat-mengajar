<?php

namespace App\Exports;

use App\Mapel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Cell\StringValueBinder;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Illuminate\Support\Facades\Auth;

class MapelExport extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $mapels = Mapel::where('sekolah_id', Auth::user()->sekolah_id)->select('id', 'kode_mapel', 'nama_mapel')->get();
        return $mapels;
    }

    public function headings() : array
    {
        $sekolah = 'App\Sekolah'::where('npsn', Auth::user()->sekolah_id)->first();
        return [
            ['Data Mapel ' . $sekolah->nama_sekolah],
            ['ID', 'Kode Mapel', 'Nama Mapel']
        ];
    }
}
