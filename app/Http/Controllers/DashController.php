<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;
use App\Traits\Tanggal;
use App\Traits\TraitNilai;
use Illuminate\Support\Facades\DB;
class DashController extends Controller
{
    use TraitNilai;
    use Tanggal;
    public function home(Request $request)
    {
        
        $rombel = 'App\Rombel'::where('guru_id', Auth::user()->nip)->first();
        $isWali = $rombel ? 1 : 0;

        $y=date('y');
        $m=date('m');

        $semester = ($m <= 6 ) ? ($y - 1).$y.'2' : $y.($y+1).'1';

        session(['wali' => $isWali, 'rombel' => ($rombel != null) ? $rombel : '0', 'semester' => $semester ]);
        return view('home.dashboard', ['page_title' => 'home']);
    }

    public function siswa(Request $request)
    {
        
        return view('home.dashboard', ['page_title' => 'Siswa']);
    }

    public function nilai(Request $request)
    {
        
        $rekap12 = $this->rekap12($request);
        // $siswas = 'App\Siswa'::where('rombel_id', $request->session()->get('rombel')->kode_rombel)->get();
        $rekap34 = $this->rekap34($request);

        return view('home.dashboard', ['page_title' => 'Nilai', 'nilaik12' => $rekap12, 'nilaik34' => $rekap34]);
    }

    public function rombel(Request $request)
    {
        return view('home.dashboard', ['page_title' => 'Rombel']);
    }

    public function kompetensi(Request $request)
    {
        return view('home.dashboard', ['page_title' => 'Kompetensi']);
    }

    public function pemetaan(Request $request)
    {
        return view('home.dashboard', ['page_title' => 'Pemetaan KD']);
    }

    public function kaldik(Request $request)
    {

        return view('home.dashboard', ['page_title' => 'Kaldik']);
        // return $this->jmlHari();
    }

    public function rapor(Request $request)
    {
        return view('home.dashboard', ['page_title' => 'Rapor']);
    }

    public function entriNilai(Request $request)
    {
        return view('home.dashboard', ['page_title' => 'Entri Nilai']);
    }
    
    public function entriNilaiEkstra(Request $request)
    {
        return view('home.dashboard', ['page_title' => 'Entri Nilai Ekskul']);
    }

    public function pengguna(Request $request)
    {
        return view('home.dashboard', ['page_title' => 'Pengguna']);
    }

    public function sekolah(Request $request)
    {
        $sekolah = 'App\Sekolah'::first();
        // dd($sekolah);
        return view('home.dashboard', ['page_title' => 'Sekolah', 'sekolah' => $sekolah]);
    }

    public function siswaku(Request $request)
    {
        $rombel = 'App\Rombel'::where('guru_id', Auth::user()->nip)->first();
        $siswaku = 'App\Siswa'::where('rombel_id', $rombel->kode_rombel)->get();
        return view('home.dashboard', ['page_title' => 'Siswaku']);
    }

    public function cetakRapor(Request $request)
    {
        return view('home.dashboard', ['page_title' => 'Rapor']);
    }
}
