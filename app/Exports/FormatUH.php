<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class FormatUH implements FrommArray, WithHeadings
{
    use Exportable;

    protected $mapel;
    protected $rombel;
    protected $tingkat;

    public function __construct($rombel, $tingkat, $mapel)
    {
        $this->mapel = $mapel;
        $this->rombel = $rombel;
        $this->tingkat = $tingkat;
    }

    public function columnFormats(): array
    {
        return [
            'D' => '@'
        ];
    }

    public function array(): array
    {
        $data = [];
        $siswas = Siswa::where('rombel_id', $this->rombel)->get();

        foreach($siswas as $siswa)
        {
            array_push($data,[
                $siswa->nisn,
                $siswa->nama_siswa
            ]);
        }
        return $data;
    }

    function headings(): array
    {
        $headings = ['nisn', 'nama_siswa'];

        $kds = 'App\Kd'::where([
            ['tingkat', '=', $this->tingkat],
            ['mapel_id', '=', $this->mapel]
        ])
        ->select('kode_kd')
        ->get();
            foreach($kds as $kd)
            {
                array_push($headings, substr($kd->kode_kd, 0,1)."_".substr($kd->kode_kd, 2,1)); 
            }
        return $headings;
    }
}