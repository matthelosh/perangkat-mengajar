<?php

namespace App\Http\Controllers;

use App\Kd;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KdController extends Controller
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
                case "bymupels":
                    $mupels = $request->mupels;
                    $datas = [];
                    foreach($mupels as $mupel)
                    {
                        $kds = Kd::where('mapel_id', $mupel)->get();
                        array_push($datas, $kds);
                    }
                    dd($datas);
                break;
                case "dt":
                    $kds = Kd::orderBy('tingkat')->orderBy('mapel_id')->orderBy('kode_kd')->with('mapels')->get();
                    return DataTables::of($kds)->addIndexColumn()->make(true);
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
     * @param  \App\Kd  $kd
     * @return \Illuminate\Http\Response
     */
    public function show(Kd $kd)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kd  $kd
     * @return \Illuminate\Http\Response
     */
    public function edit(Kd $kd)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kd  $kd
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kd $kd)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kd  $kd
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kd $kd)
    {
        //
    }
}
