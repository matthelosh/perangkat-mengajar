<?php

namespace App\Http\Controllers;

use App\Jadwal;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\JadwalImport;
use App\Exports\JadwalExport;
use Illuminate\Support\Facades\DB;

class JadwalController extends Controller
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
            case "dt":
                $jadwals = Jadwal::where(['sekolah_id' => Auth::user()->sekolah_id])->with('gurus', 'mapels', 'rombels')->get();
                // dd($jadwals);
                return DataTables::of($jadwals)->addIndexColumn()->make(true);
            break;
            case "cetak":
                $sekolah = 'App\Sekolah'::where('npsn', Auth::user()->sekolah_id)->first();
                $jadwals = Jadwal::where(['sekolah_id' => Auth::user()->sekolah_id])->with('gurus', 'mapels', 'rombels')->orderBy('guru_id')->get();
                return response()->json(['status' => 'sukses', 'msg' => 'Data Jadwal', 'jadwals' => $jadwals, 'sekolah' => $sekolah]);
        }
    }

    public function export(Request $request)
    {
       return Excel::download(new JadwalExport, 'jadwal.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //KOde JAdwal har_mapelId_rombelId_jamke
        $kode = substr($request->hari, 0, 3).'_'.$request->mapel_id.'_'.$request->rombel_id.'_'.$request->mulai.'-'.$request->selesai;
        $cek = DB::select('select jadwals.*, users.nip, users.fullname from jadwals LEFT JOIN users ON jadwals.guru_id = users.nip where jadwals.sekolah_id = ? AND jadwals.hari = ? AND SUBSTRING(jadwals.jamke,1,1) <= ? AND SUBSTRING(jadwals.jamke, 3,1) >= ? AND jadwals.rombel_id = ? ', [Auth::user()->sekolah_id, $request->hari, $request->mulai, $request->mulai, $request->rombel_id]);


        if ($cek) {
            return response()->json(['status' => 'error', 'msg' => 'Jadwal tersebut sudah diambil Bpk/Ibu '.$cek[0]->fullname]);
        }
        try {
            Jadwal::create([
                'kode_jadwal' => $kode,
                'sekolah_id' => Auth::user()->sekolah_id,
                'status' => 'aktif',
                'hari' => $request->hari,
                'mapel_id' => $request->mapel_id,
                'rombel_id' => $request->rombel_id,
                'guru_id' => $request->guru_id,
                'jamke' => $request->mulai.'-'.$request->selesai,
                'ket' => $request->ket
            ]);

            return response()->json(['status' => 'sukses', 'msg' => 'Jadwal Baru Disimpan,'], 201);
        } catch ( \Exception $e )
        {
            return response()->json(['status' => 'gagal', 'msg' => $e->getCode().':'.$e->getMessage()],422);
        }
    }

    public function import(Request $request)
    {
        $file = $request->file('file');
        try {
            Excel::import(new JadwalImport, $file);
            return redirect('/admin/jadwal')->with(['status' => 'sukses', 'msg' => 'Data Jadwal Diimpor.']);
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
     * @param  \App\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function show(Jadwal $jadwal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function edit(Jadwal $jadwal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //KOde JAdwal har_mapelId_rombelId_jamke
        $kode = substr($request->hari, 0, 3).'_'.$request->mapel_id.'_'.$request->rombel_id.'_'.$request->mulai.'-'.$request->selesai;
        $cek = DB::select('select jadwals.*, users.nip, users.fullname from jadwals LEFT JOIN users ON jadwals.guru_id = users.nip where jadwals.sekolah_id = ? AND jadwals.hari = ? AND SUBSTRING(jadwals.jamke,1,1) <= ? AND SUBSTRING(jadwals.jamke, 3,1) >= ? AND jadwals.rombel_id = ?', [Auth::user()->sekolah_id, $request->hari, $request->mulai, $request->mulai, $request->rombel_id]);

        if(!$request->query('tukar')) {
            if ($cek) {
                return response()->json(['status' => 'error', 'msg' => 'Jadwal tersebut sudah diambil Bpk/Ibu '.$cek[0]->fullname, 'id' => $id]);
            }
            try {
                $request['kode_jadwal'] = $kode;
                Jadwal::findOrFail($id)->update($request->all());
                return response()->json(['status' => 'sukses', 'msg' => 'Jadwal diperbarui']);
            } catch (\Exception $e)
            {
                return response()->json(['status' => 'sukses', 'msg' => $e->getCode().':'.$e->getMessage()], 412);
            }
        } else {
            $data7 = Jadwal::findOrFail($cek[0]->id)->first();
            $data1 = Jadwal::find($id)->first();
            try {
                Jadwal::findOrFail($id)->update($request->all());
                Jadwal::findOrFail($data1->id)->update((array) $data7);
                return response()->json(['status' => 'sukses', 'msg' => 'Jadwal ditukar']);

            } catch (\Exception $e )
            {
                return response()->json(['status' => 'error', 'msg' => $e->getCode().':'.$e->getMessage()]);
            }
        }


    }

    public function jadwalGuru(Request $request)
    {
        try {
            $jadwals = Jadwal::where(['sekolah_id' => Auth::user()->sekolah_id, 'guru_id' => Auth::user()->nip])->with('rombels', 'mapels')->orderBy('hari', 'desc')->paginate(3);
            // dd($jadwals);
            return view ('pages.guru.dashboard', ['status' => 'sukses', 'msg' => 'Jadwal Guru', 'jadwals' => $jadwals, 'page_title' => 'jadwalku']);
        } catch (\Exception $e)
        {
            return back()->with(['status' => 'error', 'msg' => $e->getCode().':'.$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $reques, $id)
    {
        try {
            Jadwal::findOrFail($id)->delete();
            return response()->json(['status' => 'sukses', 'msg' => 'Jadwal dihapus.']);
        } catch ( \Exception $e )
        {
            return response()->json(['status' => 'error', 'msg' => $e->getCode().';'.$e->getMessage()], 412);
        }
    }
}
