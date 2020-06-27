<?php
namespace App\Exports;

use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class FormatNilai implements FromArray, WithTitle, WithHeadings, ShouldAutoSize
{
    private $rombel;
    private $tingkat;
    private $mapel;
    private $nilai;
    private $kompetensi;
    protected $kondisi;
    private $jml_kd = 0;

    public function __construct($rombel, $tingkat, $mapel, $nilai, $kompetensi)
    {
       $this->rombel = $rombel;
    //    $this->tingkat = $tingkat;
       $this->mapel = $mapel;
       $this->nilai = $nilai;
       $this->kompetensi = $kompetensi;
       $this->tingkat = ($kompetensi == 1 || $kompetensi == 2) ? 'all' : $tingkat;

    //    dd($kompetensi);
    }

    /**
     * @return Builder
     */
    public function array(): array
    {
        $data = [];
        $siswas = 'App\Siswa'::where('rombel_id', $this->rombel)->get();

        foreach($siswas as $siswa)
        {
            array_push($data,[
                $siswa->nisn,
                $siswa->nama_siswa
            ]);
        }
        // dd($this->tingkat);
        return $data;
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return $this->nilai;
    }

    function headings(): array
    {
        $headings = ['nisn', 'nama_siswa'];

        $kds = 'App\Kd'::where([
            ['tingkat', '=', $this->tingkat],
            ['mapel_id', '=', $this->mapel],
            ['ki_id','=', $this->kompetensi]
        ])
        ->select('kode_kd')
        ->get();
            foreach($kds as $kd)
            {
                
                array_push($headings, str_replace(".", "_",$kd->kode_kd)); 
            }
        return $headings;
    }

    public function columnFormats(): array
    {
        $col = ['A' => '@'];
        $abj = ['A', 'B', 'C', 'D', 'E', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U','V', 'X', 'Z'];
        
        for($i=2;$i<count($this->headings);$i++){
            array_push($col, $abj[$i]);
        }
        // return [
        //     'A' => '@'
        // ];
        return $col;
    }
}