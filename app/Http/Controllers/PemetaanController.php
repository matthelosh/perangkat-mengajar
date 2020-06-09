<?php

namespace App\Http\Controllers;

use App\Pemetaan;
use App\Imports\PemetaanImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PemetaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $npsn = Auth::user()->sekolah_id;
        $pemetaans = Pemetaan::where(['sekolah_id' => $npsn])->get();
        if ($request->query('req')) {
            switch($request->query('req'))
            {
                case "dt":
                    return DataTables::of($pemetaans)->addIndexColumn()->toJson();
                break;
                case "select":
                    $tingkat = substr($request->query('subtema_id'),0,1);
                    $pemetaans = DB::table('pemetaans')
                                ->select('pemetaans.*', 'mapels.kode_mapel', 'mapels.nama_mapel', 'kds.kode_kd', 'kds.teks_kd')
                                ->leftJoin('mapels', function($join) {
                                    $join->on('pemetaans.mapel_id', '=', 'mapels.kode_mapel');
                                })->leftJoin('kds', function($join) {
                                    $join->on('pemetaans.kd_id', '=', 'kds.kode_kd')
                                    ->on('kds.mapel_id', '=', 'pemetaans.mapel_id');
                                })->where('subtema_id', $request->query('subtema_id'))
                                ->get();


                    return response()->json(['status' => 'sukses', 'msg' => 'Data Pemetaan', 'pemetaans' => $pemetaans]);
                break;
            }

        } elseif($request->query) {

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

    public function import(Request $request)
    {
        $file = $request->file('file');
        try {
            Excel::import(new PemetaanImport, $file);
            return redirect('/admin/pemetaan')->with(['status' => 'sukses', 'msg' => 'Pemetaan diimpor']);
        } catch (\Exception $e)
        {
            return back()->with(['status' => 'error', 'msg' => $e->getCode().':'.$e->getMessage()]);
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
     * @param  \App\Pemetaan  $pemetaan
     * @return \Illuminate\Http\Response
     */
    public function show(Pemetaan $pemetaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pemetaan  $pemetaan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pemetaan $pemetaan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pemetaan  $pemetaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pemetaan $pemetaan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pemetaan  $pemetaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pemetaan $pemetaan)
    {
        //
    }
}
