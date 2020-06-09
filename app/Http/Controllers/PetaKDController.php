<?php

namespace App\Http\Controllers;

use App\PetaKD;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PetaKDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $req = $request->query('req');
        if($req) {
            switch($req)
            {
                case "dt":
                    $tingkat = $request->query('tingkat');
                    // dd($tingkat);
                    $petas = PetaKD::where('tingkat', $tingkat)->with('kds')->get();
                    return DataTables::of($petas)->addIndexColumn()->make(true);
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
     * @param  \App\PetaKD  $petaKD
     * @return \Illuminate\Http\Response
     */
    public function show(PetaKD $petaKD)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PetaKD  $petaKD
     * @return \Illuminate\Http\Response
     */
    public function edit(PetaKD $petaKD)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PetaKD  $petaKD
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PetaKD $petaKD)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PetaKD  $petaKD
     * @return \Illuminate\Http\Response
     */
    public function destroy(PetaKD $petaKD)
    {
        //
    }
}
