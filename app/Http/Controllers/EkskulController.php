<?php

namespace App\Http\Controllers;

use App\Ekskul;
use App\NilaiEkstra;
use Illuminate\Http\Request;

class EkskulController extends Controller
{
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
                case "select":
                    if ($request->q == '') {
                        $ekstras = Ekskul::all();
                    } else {
                        $ekstras = Ekskul::where([['nama_ekskul', 'LIKE', '%'.$request->q.'%']])->get();
                    }
                    $datas = [];
                    foreach($ekstras as $eks)
                    {
                        array_push($datas, ['id' => $eks->kode_ekskul, 'text' => $eks->nama_ekskul]);
                        
                    }

                    return response()->json($datas);
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
        //
    }

    public function viewNilai(Request $request)
    {
        $datas = [];
        $siswas = 'App\Siswa'::where('rombel_id', $request->session()->get('rombel')->kode_rombel)->get();
        foreach($siswas as $siswa)
        {
            array_push($datas, ['nisn' => $siswa->nisn, 'nama_siswa' => $siswa->nama_siswa, 'nilai' => '0', 'id_nilai' => null]);
        }

        $nilais = NilaiEkstra::where([
            ['semester','=', $request->semester],
            ['ekstra_id','=', $request->ekstra_id],
            ['rombel_id','=', $request->session()->get('rombel')->kode_rombel]
        ])->get();

        if ($nilais->count() > 1) {
            for($i=0;$i < count($datas); $i++)
            {
                foreach($nilais as $nilai)
                {
                    if($nilai->siswa_id == $datas[$i]['nisn']) {
                        $datas[$i]['nilai'] = $nilai->ket;
                        $datas[$i]['id_nilai'] = $nilai->id;
                    }
                }
            }
         }

        return response()->json(['status' => 'sukses', 'msg' => 'Nilai Ekskul', 'data' => $datas]);
    }
    public function entri(Request $request)
    {
        $nilais = $request->nilai_ekstra;
        // dd($nilais);
        try {
            foreach($nilais as $nisn => $nilai)
            {
                NilaiEkstra::create([
                    'semester' => $request->semester,
                    'ekstra_id' => $request->ekstra_id,
                    'rombel_id' => $request->session()->get('rombel')->kode_rombel,
                    'siswa_id' => $nisn,
                    'ket' => $nilai
                ]);
            }
            return response()->json(['status' => 'sukses', 'msg' => 'Nilai disimpan']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'msg' => $e->getCode().':'.$e->getMessage()]);
        }
    }


    public function gantiNilai(Request $request, $id)
    {
        try {
            NilaiEkstra::find($id)->update(['ket' => $request->nilai]);

            return response()->json(['status' => 'sukses', 'msg' => 'Nilai Diperbarui']);
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
     * @param  \App\Ekskul  $ekskul
     * @return \Illuminate\Http\Response
     */
    public function show(Ekskul $ekskul)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ekskul  $ekskul
     * @return \Illuminate\Http\Response
     */
    public function edit(Ekskul $ekskul)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ekskul  $ekskul
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ekskul $ekskul)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ekskul  $ekskul
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ekskul $ekskul)
    {
        //
    }
}
