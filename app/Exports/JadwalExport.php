<?php

namespace App\Exports;

use App\Jadwal;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Cell\StringValueBinder;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Illuminate\Support\Facades\DB;

class JadwalExport extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements FromArray, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array() : array
    {
        $npsn = Auth::user()->sekolah_id;
        $jadwals = DB::select("SELECT jadwals.kode_jadwal, jadwals.hari, jadwals.mapel_id, mapels.nama_mapel, jadwals.rombel_id, rombels.nama_rombel, CONCAT(' ', jadwals.guru_id), users.fullname, jadwals.jamke, jadwals.ket, jadwals.status FROM jadwals LEFT JOIN users ON jadwals.guru_id = users.nip LEFT JOIN mapels ON jadwals.mapel_id = mapels.kode_mapel LEFT JOIN rombels ON jadwals.rombel_id = rombels.kode_rombel WHERE jadwals.sekolah_id = $npsn");

        return $jadwals;
    }

    public function headings() : array
    {
        $sekolah = 'App\Sekolah'::where('npsn', Auth::user()->sekolah_id)->first();
        return [
            ['Jadwal Pembelajaran ' . $sekolah->nama_sekolah ],
            ['kode Jadwal', 'Hari', 'Kode Mapel', 'Mapel', 'Kode Rombel', 'Rombel', 'ID Guru', 'Nama Guru', 'Jamke', 'Keterangan', 'Status']
        ];
    }
}
