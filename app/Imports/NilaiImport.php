<?php

namespace App\Imports;

use App\Nilai;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithMappedCells;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

// Coba
class NilaiImport implements WithMultipleSheets
{
    protected $headings;
    protected $rombel;
    protected $tingkat;
    protected $semester;
    protected $mapel;
    public function __construct($headings, $kode_rombel, $tingkat, $semester, $mapel)
    {
        $this->headings = $headings;
        $this->rombel = $kode_rombel;
        $this->tingkat = $tingkat;
        $this->semester = $semester;
        $this->mapel = $mapel;
    }
    public function sheets(): array
    {
        return [
            'UH' => new NilaiUH($this->headings[0],$this->rombel, $this->tingkat, $this->semester, $this->mapel),
            'PTS' => new NilaiPTS($this->headings[1],$this->rombel, $this->tingkat, $this->semester, $this->mapel),
            'PAS' => new NilaiPAS($this->headings[2],$this->rombel, $this->tingkat, $this->semester, $this->mapel)
        ];
    }
}


// Bisa

// class NilaiImport implements  ToCollection, WithHeadingRow
// {
//     protected $headings;
//     function __construct($headings)
//     {
//         $this->headings = $headings;
//     }
//     public function collection(Collection $rows)
//     {
//         $keys = $this->headings[0][0];
//         $kds = array_merge(array_diff_key($keys, ['0', '1']));
//         foreach($kds as $kd)
//         {
//             foreach($rows as $row)
//             {
//                 Nilai::create([
//                     'semester' => '19202',
//                     'periode' => 'pas',
//                     'mapel_id' => 'bid',
//                     'kd_id' => substr_replace($kd,".",1,0),
//                     'tingkat' => '1',
//                     'rombel_id' => 'i',
//                     'siswa_id' => $row['nisn'],
//                     'nilai' => $row[$kd]
//                 ]);
//             }
//         }
//     }

//     // /**
//     // * @param array $row
//     // *
//     // * @return \Illuminate\Database\Eloquent\Model|null
//     // */
//     // public function model(array $row)
//     // {
//     //     return new Nilai([
//     //         'semester' => $row['semester'],
//     //         'periode' => $row['periode'],
//     //         'mapel_id' => $row['mapel'],
//     //         'kd_id' => $row['kd'],
//     //         'rombel_id' => $row['rombel'],
//     //         'tingkat' => $row['tingkat'],
//     //         'siswa_id' => $row['nisn'],
//     //         'nilai' => $row['nilai']
//     //     ]);
//     // }


    
// }
