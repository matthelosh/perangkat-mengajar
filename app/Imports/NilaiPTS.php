<?php

namespace App\Imports;

use App\Nilai;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Exception;
class NilaiPTS implements ToCollection, WithHeadingRow
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
   
    public function collection(Collection $rows)
    {
        $keys = $this->headings[0];
        $kds = array_merge(array_diff_key($keys, ['0', '1']));
        // dd($keys);
        foreach($kds as $kd)
        {
            if('App\Kd'::where([['mapel_id', '=', $this->mapel],['tingkat','=',(preg_match('/^(1|2)/', $kd))?'all':$this->tingkat],['kode_kd','=',str_replace("_",".",$kd)]])->count() > 0 ) {
                foreach($rows as $row)
                {
                    Nilai::create([
                        'semester' => $this->semester,
                        'periode' => 'pts',
                        'mapel_id' => $this->mapel,
                        'kd_id' =>str_replace("_",".",$kd),
                        'tingkat' => $this->tingkat,
                        'rombel_id' => $this->rombel,
                        'siswa_id' => $row['nisn'],
                        'nilai' => ($row[$kd] != '' || $row[$kd] != null) ? $row[$kd] : 0
                    ]);
                }
            } else {
                throw new Exception("Maaf! Impor Nilai Gagal. KD ".str_replace("_",".",$kd)." tidak ada untuk mapel ".$this->mapel." di kelas ".$this->tingkat .". Mohon cek kembali file excel Anda.", 11);
            }
        }
    }
} 
