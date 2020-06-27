<?php

namespace App\Http\Controllers;

use App\Exports\FormatNilaiExport;
use App\Nilai;
use Illuminate\Http\Request;
use App\Imports\NilaiImport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;
use App\Traits\TraitNilai;
use App\Traits\Tanggal;
class NilaiController extends Controller
{
    use TraitNilai;
    use Tanggal;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->query('req')) {
            switch($request->query('req'))
            {
                case "view":
                    try {
                        $siswas = 'App\Siswa'::where('rombel_id', $request->session()->get('rombel')->kode_rombel)->get();
                        $nilais = Nilai::where([
                            ['semester','=',$request->semester],
                            ['periode', '=', $request->periode],
                            ['mapel_id','=', $request->mapel],
                            ['kd_id','=', $request->kd],
                            ['rombel_id', '=', $request->session()->get('rombel')->kode_rombel],
                            ['tingkat','=',$request->session()->get('rombel')->tingkat]
                            // ['semester','=',$request->semester],
                            // ['periode', '=', $request->periode],
                            // ['mapel_id','=', $request->mapel],
                            // ['kd_id','=', $request->kd],
                            // ['rombel_id', '=', $request->session()->get('rombel')->kode_rombel],
                            // ['tingkat','=',$request->session()->get('rombel')->tingkat]
                        ])->get();
                        // $nilais = Nilai::all();
                        // dd($nilais);
                        $datas = [];
                        foreach($siswas as $siswa)
                        {
                            // $nilai_default = (preg_match('/(^1|2)/', $request->kd)) ? 80 : 0;
                            array_push($datas, ['nisn' => $siswa->nisn, 'nama_siswa' => $siswa->nama_siswa, 'nilai' => 0, 'id_nilai' => null]);
                        }
                        if($nilais->count() > 1) {
                           for($i=0;$i < count($datas); $i++)
                           {
                               foreach($nilais as $nilai)
                               {
                                   if($nilai->siswa_id == $datas[$i]['nisn']) {
                                       $datas[$i]['nilai'] = $nilai->nilai;
                                       $datas[$i]['id_nilai'] = $nilai->id;
                                   }
                               }
                           }
                        }

                        // dd($nilais);

                        return response()->json(['status' => 'sukses', 'msg' => 'Nilai Siswa', 'data' => $datas]);
                    } catch(\Exception $e)
                    {
                        return response()->json(['status' => 'Error', 'msg' => $e->getCode().':'.$e->getMessage()]);
                    }


                break;
            }
        }
    }

    public function impor(Request $request)
    {
        $file = $request->file('file_nilai');
        $namaFile = explode(".",$file->getClientOriginalName());
        // dd($namaFile);
        $rombel = $request->session()->get('rombel');
        $kode_rombel = $rombel->kode_rombel;
        $tingkat = $rombel->tingkat;
        $semester = substr($request->tapel, 2,2).substr($request->tapel, 7,2).$request->semester;
        $mapel = ($request->mapel != "0") ? $request->mapel : $namaFile[1];
        // dd($file);
        // 2019/2020
        try {
            // Excel::import(new NilaiImport, $file);
            // return back()->with(['status' => 'sukses', 'msg' => 'Data Nilai diimpor']); Sukses

            $headings = (new HeadingRowImport)->toArray($file);

            // $h="Halo";
            // dd(strlen($h));
            // $headings = ['31', '32', '33', '34'];
            // dd($headings);
            Excel::import(new NilaiImport($headings, $kode_rombel, $tingkat, $semester, $mapel), $file);
            return back()->with(['status' => 'sukses', 'msg' => 'Data Nilai diimpor']);
            
        } catch (\Exception $e) {
            // dd($e);
            return back()->with(['status' => 'error', 'msg' => $e->getCode().':'.$e->getMessage()]);
        }
    }

    public function downloadFormat(Request $request)
    {
        return Excel::download(new FormatNilaiExport($request->mapel, $request->session()->get('rombel')->kode_rombel,$request->session()->get('rombel')->tingkat, $request->kompetensi), 'FormatNilai.xlsx');
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $nilais = $request->nilai;
        try {
            foreach($nilais as $nisn => $nilai)
            {
                Nilai::create([
                    'semester' => $request->semester,
                    'mapel_id' => $request->mapel,
                    'periode' => $request->periode,
                    'rombel_id' => $request->session()->get('rombel')->kode_rombel,
                    'tingkat' => $request->session()->get('rombel')->tingkat,
                    'siswa_id' => $nisn,
                    'kd_id' => $request->kd,
                    'nilai' => $nilai
                ]);
            }
            return response()->json(['status' => 'sukses', 'msg' => 'Nilai disimpan']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'msg' => $e->getCode().':'.$e->getMessage()]);
        }
            
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
     * @param  \App\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function show(Nilai $nilai)
    {
        //
    }

    public function inputSaran(Request $request)
    {
        parse_str($request->input('saran'), $saran);
        parse_str($request->input('prestasi'), $prestasi);
        parse_str($request->input('detil'), $detil);
        parse_str($request->input('absensi'), $absensi);
        // dd($prestasi);
        try {
            DB::table('sarans')->updateOrInsert(
                [
                    'semester' => $saran['semester'],
                    'siswa_id' => $saran['siswa_id']
                ],
                [
                    'teks_saran' => $saran['saran']
                ]
            );

            DB::table('detil_siswas')->updateOrInsert(
                [
                    'semester' => $saran['semester'],
                    'siswa_id' => $saran['siswa_id']
                ],
                [
                    'tb' => $detil['tb'],
                    'bb' => $detil['bb'],
                    'pendengaran' => $detil['pendengaran'],
                    'penglihatan' => $detil['penglihatan'],
                    'gigi' => $detil['gigi'],
                    'fisik_lain' => $detil['fisik_lain'],
                ]
            );
            $jml = count($prestasi['tingkat']);
            for($i=0;$i < $jml; $i++) {
                DB::table('prestasis')->updateOrInsert(
                    [
                        'semester' => $saran['semester'],
                        'siswa_id' => $saran['siswa_id'],
                        'tingkat' => $prestasi['tingkat'][$i]
                    ],
                    [
                        
                        'jenis_prestasi' => $prestasi['jenis_prestasi'][$i],
                        'ket' => $prestasi['ket'][$i]
                    ]
                );
            }

            DB::table('presensis')->updateOrInsert(
                [
                    'semester' => $saran['semester'],
                    'siswa_id' => $saran['siswa_id']
                ],
                [
                    'sakit' => $absensi['sakit'],
                    'izin' => $absensi['izin'],
                    'alpa' => $absensi['alpa'],
                ]);
            return response()->json(['status' => 'sukses', 'msg' => 'Saran telah disimpan']);
        } catch( \Exception $e)
        {
            return response()->json(['status' => 'error', 'msg' => $e->getCode().':'.$e->getMessage()]);
        }
    }

    public function getOneSaran(Request $request)
    {
        
        $saran = DB::table('sarans')->where([['siswa_id','=', $request->query('nisn')],['semester','=', $request->session()->get('semester')]])->first();
       

        $detil = 'App\DetilSiswa'::where([
            ['siswa_id','=' , $request->query('nisn')],
            ['semester','=', $request->session()->get('semester')]
        ])->first();

        $prestasi = 'App\Prestasi'::where([
            ['siswa_id','=' , $request->query('nisn')],
            ['semester','=', $request->session()->get('semester')]
        ])->get();
        $absensi = 'App\Presensi'::where([
            ['siswa_id','=' , $request->query('nisn')],
            ['semester','=', $request->session()->get('semester')]
        ])->first();
        // dd($prestasi);
        $data = [
            'saran' => ($saran) ? ($saran->teks_saran) : '0',
            'detil' => ($detil) ?$detil :  '0',
            'prestasi' => ($prestasi->count() > 0) ? $prestasi : '0',
            'absensi' => ($absensi) ? $absensi : '0'
            
        ];
        return response()->json(['status' => 'sukses', 'msg' => 'Data Saran', 'data' => $data]);
    }

    public function cetakRapor(Request $request)
    {
        $siswa = 'App\Siswa'::where('nisn', $request->query('nisn'))->first();
        $semester = $request->query('semester');
        $rombel = $request->session()->get('rombel');
        $sekolah = 'App\Sekolah'::with('kepsek')->first();
        $tanggal_rapor = DB::table('setting-raport')->select('tanggal_rapor')->where('semester', $semester)->first();
        $tgl = explode('-',$tanggal_rapor->tanggal_rapor);
        $nilais = $this->nilaiRapor($request->query('nisn'), $semester, $rombel);
        $sikaps = $this->nilaiSikap($request->query('nisn'), $semester, $rombel);
        $ekstras = $this->nilaiEkstra($request->query('nisn'), $semester, $rombel); 
        $saran = DB::table('sarans')->where([['siswa_id','=', $request->query('nisn')], ['semester' ,'=', $request->query('semester')]])->first();
        $detil = 'App\DetilSiswa'::where([
            ['siswa_id','=', $request->query('nisn')],
            ['semester','=', $semester]
        ])->first();
        $prestasis = 'App\Prestasi'::where([
            ['siswa_id','=', $request->query('nisn')],
            ['semester','=', $semester]
        ])->get();
        $absensi = 'App\Presensi'::where([
            ['siswa_id','=', $request->query('nisn')],
            ['semester','=', $semester]
        ])->first();
        return view('home.dashboard', [
           'page_title' => 'Cetak Rapor', 
           'siswa' => $siswa, 
           'nilais' => $nilais, 
           'sekolah' => $sekolah, 
           'tanggal_rapor' => $this->tanggalRapor($request), 
           'sikaps' => $sikaps, 
           'ekstras' => $ekstras,
           'saran' => $saran,
           'detil' => $detil,
           'prestasis' => $prestasis,
           'absensi' => $absensi
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function edit(Nilai $nilai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            Nilai::findOrFail($id)->update(['nilai' => $request->nilai]);
            return response()->json(['status' => 'sukses', 'msg' => 'Nilai diperbarui']);
        } catch (\Exception $e)
        {
            return response()->json(['status' => 'error', 'msg' => $e->getCode().':'.$e->getMessage(0)]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nilai $nilai)
    {
        //
    }


}
