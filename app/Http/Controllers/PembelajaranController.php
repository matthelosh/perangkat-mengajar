<?php

namespace App\Http\Controllers;

use App\Pembelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class PembelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->query('req') && Auth::user()->level == 'admin') {
            switch($request->query('req'))
            {
                case "dt":
                    $pembelajarans = Pembelajaran::where([
                        'sekolah_id' => Auth::user()->sekolah_id,
                        'tanggal' => $this->tanggal()['tanggal']
                    ])->with('mapels', 'rombels', 'gurus')->orderBy('rombel_id')->get();
                    return DataTables::of($pembelajarans)->addIndexColumn()->make(true);
                break;
            }
        } elseif($request->query('req') && Auth::user()->level == 'guru') {
            switch($request->query('req'))
            {
                case "now":
                    $pembelajarans = Pembelajaran::where([
                        'sekolah_id' => Auth::user()->sekolah_id,
                        'tanggal' => $this->tanggal()['tanggal']
                    ])->with('mapels', 'rombels', 'gurus')->orderBy('rombel_id')->get();
                    return response()->json(['status' => 'sukses', 'data' => $pembelajarans]);
                break;
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    public function deactivate(Request $request)
    {
        try {
            Pembelajaran::where([
                ['sekolah_id', '=', Auth::user()->sekolah_id],
                ['tanggal', '=', date('Y-m-d')],
            ])->update(['status' => 'tutup']);

            return response()->json(['status' => 'sukses', 'msg' => 'Jadwal Pembelajaran ' . date('dd M Y') . ' ditutup.']);
        } catch ( \Exception $e )
        {
            return response()->json(['status' => 'error', 'msg' => $e->getCode().':'.$e->getMessage()]);
        }
    }

    public function aktifkan(Request $request)
    {
        // Cek Jadwal hari ini, jika ada buat pembelajaran hari ini. Jika ada, maka pembelajaran harian dibuat, sistemmengirimkan laporan lewat telegram, dll. JIka tidak ada sistem melaporkan bahwa hari ini tidak ada jadwal / libur
        // dd($this->tanggal()['hari']);
        $jadwals = 'App\Jadwal'::where('hari', $this->tanggal()['hari'])->where('sekolah_id', Auth::user()->sekolah_id)->get();
        if ($jadwals->count() > 0) {
            try {
            foreach($jadwals as $jadwal)
            {
                $tematik = ($jadwal->mapel_id == 'tm') ? true : false;
                $waktu = explode('-',$jadwal->jamke);
                $mulai = 'App\Jampel'::where(['jam' => $waktu[0], 'sekolah_id' => Auth::user()->sekolah_id ])->first();
                // dd($mulai);
                $selesai = 'App\Jampel'::where(['jam' => ($waktu[1]), 'sekolah_id' => Auth::user()->sekolah_id ])->first();
                // dd($selesai);
                $kode = date('Ymd').'_'.$jadwal->guru_id.'_'.$jadwal->mapel_id.'_'.$jadwal->rombel_id.'_'.$jadwal->jamke;
                DB::table('pembelajarans')->insertOrIgnore([
                    'kode_pembelajaran' => $kode,
                    'tanggal' => date('Y-m-d'),
                    'hari' => $this->tanggal()['hari'],
                    'sekolah_id' => Auth::user()->sekolah_id,
                    'rombel_id' => $jadwal->rombel_id,
                    'mapel_id' => $jadwal->mapel_id,
                    'guru_id' => $jadwal-> guru_id,
                    'jamke' => $jadwal->jamke,
                    'jml_siswa' => 0,
                    'hadir' => 0,
                    'ijin' => 0,
                    'sakit' => 0,
                    'alpa' => 0,
                    'telat' => 0,
                    'jurnal_id' => '0',
                    'mode' => 'offline',
                    'ket' => 'jamkos',
                    'status' => 'aktif',
                    'mulai' => $mulai->awal,
                    'selesai' => $selesai->akhir,
                    'tematik' => $tematik
                ]);

            }
            return response()->json(['status'=> 'sukses', 'msg' => 'Pembelajaran '. $this->tanggal()['hari'].' '.$this->tanggal()['tanggal'].' telah diaktifkan.']);
            }
            catch(\Exception $e)
            {
                return response()->json(['status' => 'gagal', 'msg' => $e->getCode().':'.$e->getMessage()]);
            }
        } else {
            return response()->json(['status' => 'gagal', 'msg' => 'Tidak ada Pembelajaran hari ini.']);
        }
    }

    public function isi(Request $request, $kode_pembelajaran)
    {
        try {
            $kode = explode('_', $kode_pembelajaran);
            $rombel = $kode[3];
            $pembelajaran = Pembelajaran::where('kode_pembelajaran', $kode_pembelajaran)->with('rombels.siswas', 'mapels', 'gurus')->first();
            return view('pages.guru.dashboard', ['status' => 'sukses', 'page_title' => 'Isi Jurnal',  'pembelajaran' => $pembelajaran]);
        } catch (\Exception $e) {
            return back()->with(['status' => 'error', 'msg' => $e->getCode().':'.$e->getMEssage()]);
        }
    }

    // Simpan Presensi
    public function insertPresensi(Request $request)
    {
        return back()->with(['status' => 'sukses', 'msg' => 'Presensi tersimpan']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pembelajaran  $pembelajaran
     * @return \Illuminate\Http\Response
     */
    public function show(Pembelajaran $pembelajaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pembelajaran  $pembelajaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Pembelajaran $pembelajaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pembelajaran  $pembelajaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->query('req')) {
            switch($request->query('req'))
            {
                case "set-mode":
                    Pembelajaran::findOrFail($id)->update(['mode' => $request->mode]);
                    return response()->json(['status' => 'sukses', 'msg' => 'Mode Pembelajaran diubah menjadi '.$request->mode ]);
                break;
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pembelajaran  $pembelajaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pembelajaran $pembelajaran)
    {
        //
    }

    public function reset(Request $request)
    {
        $tgl = date('Y-m-d');
        try {
            Pembelajaran::where([['tanggal', '=', $tgl], ['sekolah_id', '=', Auth::user()->sekolah_id]])->delete();

            return response()->json(['status' => 'sukses', 'msg' => 'Data Pembelajaran tanggal '.$tgl.' dihapus']);
        } catch (\Exception $e)
        {
            return response()->json(['status' => 'error', 'msg' => $e->getCode().':'.$e->getMessage()]);
        }
    }

    public function tanggal()
    {
        $haris = ['Minggu','Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $wday = date('w');
        $hari = $haris[$wday];
        $tanggal = date('Y-m-d');
        return ['tanggal' => $tanggal, 'hari' => $hari];
    }
}
