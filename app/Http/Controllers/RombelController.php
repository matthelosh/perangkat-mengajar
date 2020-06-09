<?php

namespace App\Http\Controllers;

use App\Rombel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Imports\RombelImport;
use App\Exports\RombelExport;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class RombelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        switch($request->query('req'))
        {
            case "select":
                if($request->q != '') {
                    $rombels = Rombel::where([
                        ['nama_rombel','LIKE', '%'.$request->q.'%']
                    ])->get();
                } else {
                    $rombels = Rombel::all();
                }

                $datas = [];
                foreach($rombels as $rombel)
                {
                    array_push($datas, ['id' => $rombel->kode_rombel, 'text' => $rombel->nama_rombel]);
                }
                return response()->json($datas);
            break;
            case "dt":
                $rombels = Rombel::with('gurus', 'siswas')->get();
                return DataTables::of($rombels)->addIndexColumn()->make(true);
            break;
            case "cetak":
                $sekolah = 'App\Sekolah'::where('npsn', Auth::user()->sekolah_id)->first();
                $rombels = Rombel::where('sekolah_id', Auth::user()->sekolah_id)->with('gurus', 'siswas')->get();

                return response()->json(['status' => 'sukses', 'msg' => 'Data Rombel '.$sekolah->nama_sekolah, 'rombels' => $rombels, 'sekolah' => $sekolah]);
            break;

        }
    }

    // Import ROmbel
    public function import(Request $request)
    {
        try {
            $file = $request->file('file');
            Excel::import(new RombelImport, $file);

            return redirect('/admin/rombel')->with(['status' => 'sukses', 'msg' => 'Data Rombel diimpor']);
        } catch(\Exception $e)
        {
            return back()->with(['status' => 'error', 'msg' => $e->getCode().':'. $e->getMessage()]);
        }
    }

    public function export(Request $request)
    {
        // $file = $request->file('file');
        try {
            return Excel::download(new RombelExport, 'data-rombel.xlsx');
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'msg' => $e->getCode().':'.$e->getMessage()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            Rombel::create([
                'sekolah_id' => Auth::user()->sekolah_id,
                'kode_rombel' => $request->kode_rombel,
                'nama_rombel' => $request->nama_rombel,
                'guru_id' => $request->guru_id,
                'tingkat' => $request->tingkat,
                'status' => 'aktif'
            ]);

            return redirect('/admin/rombel')->with(['status' => 'sukses', 'msg' => 'Data Rombel Disimpan.']);
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
     * @param  \App\Rombel  $rombel
     * @return \Illuminate\Http\Response
     */
    public function show(Rombel $rombel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rombel  $rombel
     * @return \Illuminate\Http\Response
     */
    public function edit(Rombel $rombel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rombel  $rombel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            Rombel::findOrFail($id)->update($request->all());

            return redirect('/admin/rombel')->with(['status' => 'sukses', 'msg' => 'Data Rombel telah diperbarui.']);
        } catch (\Exception $e)
        {
            return back()->with(['status' => 'error', 'msg' => $e->getCode().':'.$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rombel  $rombel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try {
            Rombel::findOrFail($id)->delete();
            return response()->json(['status' => 'sukses', 'msg' => 'Rombel dihapus.']);
        } catch (\Exception $e)
        {
            return response()->json(['status' => 'error', 'msg' => $e->getCode().':'.$e->getMessage()],412);
        }
    }
}
