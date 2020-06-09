<?php

namespace App\Http\Controllers;

use App\Subtema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubtemaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $data = [];
        // array_push($data, ['id' => 1, 'text' => 'Satu'], ['id' => 2, 'text' => 'Dua']);
        // return response()->json($data);
        $sekolah = 'App\Sekolah'::where('npsn', Auth::user()->sekolah_id)->first();
        $rombel = 'App\Rombel'::where('guru_id', Auth::user()->nip)->first();
        if (!$request->query('req')) {

            $subtemas = Subtema::where('jenjang', $sekolah->jenjang)->get();

        } else {
            switch($request->query('req'))
            {
                case "select":
                    if($request->query('tema_id') == '0') {
                        $subtemas = Subtema::where(['jenjang' => $sekolah->jenjang])->get();
                    } else {
                        $subtemas = Subtema::where(['jenjang' => $sekolah->jenjang, 'tema_id' => $request->query('tema_id')])->get();
                    }
                    // $subtemas = Subtema::all();
                    $datas = [];
                    foreach($subtemas as $subtema) {
                        $no = explode('-', $subtema->kode_subtema);
                        array_push($datas, ['id' => $subtema->kode_subtema, 'text'=> $no[2].'. '.$subtema->teks_subtema]);
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
     * @param  \App\Subtema  $subtema
     * @return \Illuminate\Http\Response
     */
    public function show(Subtema $subtema)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subtema  $subtema
     * @return \Illuminate\Http\Response
     */
    public function edit(Subtema $subtema)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subtema  $subtema
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subtema $subtema)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subtema  $subtema
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subtema $subtema)
    {
        //
    }
}
