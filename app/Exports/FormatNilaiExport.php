<?php

namespace App\Exports;

use App\Siswa;
// use Maatwebsite\Excel\Concerns\FromCollection;
// use Maatwebsite\Excel\Concerns\WithHeadings;
// use Maatwebsite\Excel\Concerns\FromArray;
// use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class FormatNilaiExport implements WithMultipleSheets, ShouldAutoSize
{
    protected $mapel;
    protected $rombel;
    protected $tingkat;
    protected $kompetensi;

    public function __construct($mapel, $rombel, $tingkat, $kompetensi)
    {
        $this->mapel = $mapel;
        $this->rombel = $rombel;
        $this->tingkat = $tingkat;
        $this->kompetensi = $kompetensi;
    }

    public function sheets(): array
    {
        $sheets = [];
        $periode = ['UH', 'PTS', 'PAS'];
        for($i=0;$i<count($periode);$i++) {
            $sheets[] = new FormatNilai($this->rombel, $this->tingkat, $this->mapel, $periode[$i], $this->kompetensi);   
        }

        return $sheets;

    }

}
