<?php

namespace App\Http\Controllers;

use App\Nilai;
use Illuminate\Http\Request;

class NilaiController extends Controller
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
                case "view":
                    try {
                        $siswas = 'App\Siswa'::where('rombel_id', $request->rombel)->get();
                        $nilais = Nilai::where([
                            ['format','=',$request->format],
                            ['kompetensi','=',$request->kompetensi],
                            ['kompetensi','=',$request->kompetensi],
                        ])->get();

                        $datas = [];
                        if ($nilais->count() < 1) {
                            $datas = $siswas;
                        } else {
                            foreach($siswas as $siswa)
                            {
                                foreach($nilais as $nilai)
                                {
                                    if($nilai->siswa_id == $siswa->nisn) {
                                        array_push($datas, ['nisn' => $siswa->nisn, 'nama_siswa' => $siswa->nama_siswa, 'nilai' => $nilai->nilai]);
                                    }
                                }
                            }
                        }

                        return response()->json(['status' => 'sukses', 'msg' => 'Nilai Siswa', 'data' => $datas]);
                    } catch(\Exception $e)
                    {
                        return response()->json(['status' => 'Error', 'msg' => $e->getCode().':'.$e->getMessage()]);
                    }


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
    public function update(Request $request, Nilai $nilai)
    {
        //
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
