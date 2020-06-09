<?php

namespace App\Exports;

use App\Rombel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\StringValueBinder;
use Illuminate\Support\Facades\Auth;

class RombelExport extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements FromCollection, WithHeadings, WithCustomValueBinder
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Rombel::where('sekolah_id', Auth::user()->sekolah_id)->select('kode_rombel', 'nama_rombel', 'guru_id')->get();
    }

    public function headings(): array
    {
        $npsn = Auth::user()->sekolah_id;
        $sekolah = 'App\Sekolah'::where('npsn', $npsn)->first();
        return [
            ['Data Rombel ' . $sekolah->nama_sekolah, '','','', date('d-m-Y')],
            ['Kode Rombel', 'Nama Rombel', 'ID Guru']
        ];
    }
}
