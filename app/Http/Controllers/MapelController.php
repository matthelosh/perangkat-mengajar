<?php

namespace App\Http\Controllers;

use App\Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Imports\MapelImport;
use App\Exports\MapelExport;
use Maatwebsite\Excel\Facades\Excel;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sekolah = 'App\Sekolah'::where('npsn', Auth::user()->sekolah_id)->first();
        switch($request->query('req'))
        {
            case "dt":
                $mapels = Mapel::where('sekolah_id', Auth::user()->sekolah_id)->get();
                // dd($mapels);
                return DataTables::of($mapels)->addIndexColumn()->make(true);
            break;
            case "cetak":
                $mapels = Mapel::where('sekolah_id', Auth::user()->sekolah_id)->get();
                return response()->json(['status' => 'sukses', 'mapels' => $mapels, 'sekolah' => $sekolah]);
            break;
            case "select":
                if($request->q != '') {
                    $mapels = Mapel::where([['nama_mapel', 'LIKE', '%'. $request->q.'%']])->get();
                } else {
                   
                    if(Auth::user()->role == 'wali' && (int) $request->session()->get('rombel')->tingkat < 4) {
                        $mapels = Mapel::where('tingkat', '!=', 'besar')->get();
                    } elseif(Auth::user()->role == 'wali' && (int) $request->session()->get('rombel')->tingkat > 3) {
                        $mapels = Mapel::all();
                    } elseif(Auth::user()->role == 'gpai') {
                        $mapels = Mapel::where('kode_mapel', 'pabp')->get();
                    } elseif(Auth::user()->role == 'gor') {
                        $mapels = Mapel::where('kode_mapel', 'pjok')->get();
                    } elseif(Auth::user()->role == 'gbig') {
                        $mapels = Mapel::where('kode_mapel', 'big')->get();
                    }
                }


                $raw = [];
                foreach($mapels as $mapel)
                {
                    array_push($raw,['id' => $mapel->kode_mapel, 'text' => $mapel->label]);
                }

                $json = json_decode(json_encode($raw));
                return response()->json(['status' => 'sukses', 'msg' => 'Select Mapel', 'mapels' => $json]);
            break;
        }
    }

    public function export()
    {
        return  Excel::download(new MapelExport, 'Data Mapel.xlsx');

    }

    public function import(Request $request)
    {
        try {
            $file = $request->file('file');
            Excel::import(new MapelImport, $file);

            return redirect('/admin/mapel')->with(['status' => 'sukses', 'msg' => 'Data Mapel Diimpor']);
        } catch (\Exception $e) {
            return back()->with(['status' => 'error', 'msg' => $e->getCode().':'.$e->getMessage()]);
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
            Mapel::create([
                'sekolah_id' => Auth::user()->sekolah_id,
                'kode_mapel' => $request->kode_mapel,
                'nama_mapel' => $request->nama_mapel,
            ]);

            return redirect('/admin/mapel')->with(['status' => 'sukses', 'msg' => 'Data Mapel '.$request->nama_mapel.' ditambahkan'], 201);
        } catch (\Exception $e) {
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
     * @param  \App\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function show(Mapel $mapel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function edit(Mapel $mapel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            Mapel::findOrFail($id)->update($request->all());
            return redirect('/admin/mapel')->with(['status' => 'sukses', 'msg' => 'Data Mapel dipebarui.']);
        } catch (\Exception $e)
        {
            return back()->with(['status' => 'error', 'msg' => $e->getCode().':'.$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Mapel::findOrFail($id)->delete();
            return response()->json(['status' => 'sukses', 'msg' => 'Data Mapel dihapus']);
        } catch (\Exception $e)
        {
            return response()->json(['status' => 'error', 'msg' => $e->getCode().':'.$e->getMessage()], 412);
        }
    }
}
