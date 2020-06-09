<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;
use App\Traits\Tanggal;

class DashController extends Controller
{
    use Tanggal;
    public function home(Request $request)
    {
        return view('home.dashboard', ['page_title' => 'home']);
    }

    public function siswa(Request $request)
    {
        return view('home.dashboard', ['page_title' => 'Siswa']);
    }

    public function nilai(Request $request)
    {
        return view('home.dashboard', ['page_title' => 'Nilai']);
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
}
