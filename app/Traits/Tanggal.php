<?php

namespace App\Traits;
use Illuminate\Support\Facades\DB;
date_default_timezone_set("Asia/Jakarta");

use Illuminate\Http\Request;

/**
 *
 */
trait Tanggal
{
    public function tanggalRapor(Request $request)
    {
        $bulans = [1 => 'Januari', 'Pebruari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'Nopember', 'Desember'];
        $tanggal = DB::table('setting-raport')
                        ->select('tanggal_rapor')
                        ->where('semester', $request->session()->get('semester'))
                        ->first();
        $tgl = explode('-', $tanggal->tanggal_rapor);
        $bulan = $bulans[(int) $tgl[1]];
        return $tgl[2].' '.$bulan.' '.$tgl[0];
    }
    public function tanggal($tanggal)
    {
        $haris = ['Minggu','Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $bulans = [1 => 'Januari', 'Pebruari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'Nopember', 'Desember'];

        $tanggal = explode('-',$tanggal);
        // return $haris[date('w', $tanggal)].', '.('d').' '.$bulans[$tanggal('m')].' '.$tanggal('Y');
        return date('t');
    }

    public function jmlHari($bulan=null, $tahun=null)
    {
        $month = ($bulan != null) ? $bulan : date('m');
        $year = ($tahun != null) ? $tahun : date('Y');
        $haris = ['Minggu','Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $bulans = [1 => 'Januari', 'Pebruari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'Nopember', 'Desember'];
        $minggu=0;$senin=0;$selasa=0;$rabu=0;$kamis=0;$jumat=0;$sabtu=0;

        $mulai = 0;
        $akhir = date('t');
        while ($mulai < $akhir) {
            $mulai++;
            $hari = date("w", mktime(0,0,0,date('m'), $mulai, date('Y')));
            switch($hari) {
                case "0":
                    $minggu++;
                break;
                case "1":
                    $senin++;
                break;
                case "2";
                    $selasa++;
                break;
                case "3":
                    $rabu++;
                break;
                case "4":
                    $kamis++;
                break;
                case "5":
                    $jumat++;
                break;
                case "6":
                    $sabtu++;
                break;
            }
        }

        echo "Pada Bulan ".$bulans[(int) $month]." ada: <hr />";
        echo "Minggu = ".$minggu."<br />";
        echo "Senin = ".$senin."<br />";
        echo "Selasa = ".$selasa."<br />";
        echo "Rabu = ".$rabu."<br />";
        echo "Kamis = ".$kamis."<br />";
        echo "Jumat = ".$jumat."<br />";
        echo "Sabtu = ".$sabtu."<br />";
        echo "jumlah = ".$mulai;

    }
}

