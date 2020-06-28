<?php

namespace App\Http\Controllers;

use App\Siswa;
use Illuminate\Http\Request;
use App\Imports\SiswaImport;
use App\Exports\SiswaExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        if ($request->query('req')) {
            switch($request->query('req'))
            {
                case "dt":
                    if($request->query('rombel')) {
                        $siswas = Siswa::where('rombel_id', $request->query('rombel'))->with('rombels')->get();
                    } else {
                        $siswas = Siswa::with('rombels')->get();
                    }
                    return DataTables::of($siswas)->addIndexColumn()->toJson();
                break;
                case "non-member":
                    // $siswas = Siswa::where(['sekolah_id' => Auth::user()->sekolah_id, 'rombel_id' => '0'])->get();
                    $siswas = Siswa::where('rombel_id', '0')->get();
                    // dd($siswas);
                    return DataTables::of($siswas)->addIndexColumn()->make(true);
                break;
                case "member":
                    $siswas = Siswa::where('rombel_id', $request->query('rombel_id'))->get();
                    // dd($siswas);
                    return DataTables::of($siswas)->addIndexColumn()->make(true);
                break;
                case "select":
                    if($request->q !='') {
                        $datas = Siswa::where([
                            ['nama_siswa','LIKE', '%'.$request->q.'%'],
                            ['rombel_id', '=', $request->query('rombel')]
                        ])->get();
                    } else {
                        $datas = Siswa::where([
                            ['rombel_id', '=', $request->query('rombel')]
                        ])->get();
                    }
                    
                    $siswas = [];
                    foreach($datas as $siswa)
                    {
                        array_push($siswas, ['id' => $siswa->nisn, 'text' => $siswa->nama_siswa]);
                        
                    }
                    return response()->json($siswas);
                break;
            }

        } else {
            // $sekolah = 'App\Sekolah'::where('npsn', $npsn)->first();
            $siswas = 'App\Siswas'::all();
            return response()->json(['status' => 'sukses', 'msg' => 'Data Siswa', 'siswas' => $siswas]);
        }
    }

    public function keluarRombel(Request $request)
    {
        // dd($request->ids);
        $ids = $request->ids;
        try {
            foreach($ids as $id)
            {
                'App\Siswa'::findOrFail($id)->update(['rombel_id' => '0']);
            }

            return response()->json(['status' => 'sukses', 'msg' => 'Siswa telah dikeluarkan dari rombel.']);
        } catch (\Exception $e)
        {
            return response()->json(['status' => 'error', 'msg' => $e->getCode().':'.$e->getMessage()]);
        }


    }

    public function resetPassword(Request $request)
    {
        try {
            $password = Hash::make('abcde');
            Siswa::where('sekolah_id', Auth::user()->sekolah_id)->update([
                'password' => $password
            ]);

            return response()->json(['status' => 'sukses', 'msg' => 'Password siswa direset.']);
        } catch ( \Exception $e)
        {
            return response()->json(['status' => 'error', 'msg' => $e->getCode().':'.$e->getMessage()]);
        }
    }

    public function pindahRombel(Request $request)
    {
        $ids = $request->ids;
        $rombelasal = $request->rombelasal;
        $rombel7 = $request->rombel7;
        try {
            foreach($ids as $id)
            {
                Siswa::findOrFail($id)->update(['rombel_id' => $rombel7]);
            }

            return response()->json(['status' => 'sukses', 'msg' => 'Siswa berhasil dipindah-rombel kan']);
        } catch ( \Exception $e )
        {
            return response()->json(['status' => 'error', 'msg' => $e->getCode().':'.$e->getMessage()]);
        }
    }

    public function masukRombel(Request $request)
    {
        $ids = $request->ids;
        $rombel = $request->rombel;
        try {
            foreach($ids as $id)
            {
                'App\Siswa'::findOrFail($id)->update(['rombel_id' => $rombel]);

            }
            return response()->json(['status' => 'sukses', 'msg' => 'Siswa dimasukkan ke rombel.']);
        } catch ( \Exception $e)
        {
            return response()->json(['status' => 'error', 'msg' => $e->getCode().':'.$e->getMessage()]);
        }
    }

    public function import(Request $request)
    {
        $file = $request->file('file');
        try {
            Excel::import(new SiswaImport, $file);
            return redirect('/admin/siswa')->with(['status' => 'sukses', 'msg' => 'Data Siswa diimpor. :)']);
        } catch (\Exception $e) {
            return back()->with(['status' => 'error', 'msg' => $e->getCode().':'.$e->getMessage()]);
        }
    }

    public function export(Request $request)
    {
        return Excel::download(new SiswaExport, 'users.xlsx');
    }

    public function addFoto(Request $request)
    {
        $file = $request->file('foto');
        $siswa = Siswa::where('nisn', $request->nisn)->first();
        // dd($file);
        // dd($siswa->id);
        // if(!$siswa->nis) {
        //     return response()->json(['status' => 'error', 'msg' => 'Siswa belum memiliki NIS'], 412);
        // }
        try {
            $filename = $request->nisn.'.jpg';
            $file->move('images/siswas', $filename);
            return response()->json(['status' => 'sukses', 'msg' => 'Foto Siswa Disimpan', 'url' => '/images/siswas/'.$filename]);
        } catch (\Exception $e)
        {
            return response()->json(['status' => 'error', 'msg' => $e->getCode().':'.$e->getMessage()]);
        }
    }

    // public function print(Request $request)
    // {
    //     $siswas =
    // }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            Siswa::create([
                'sekolah_id' => Auth::user()->sekolah_id,
                'ortu_id' => '0',
                'rombel_id' => $request->rombel_id,
                'nis' => $request->nis,
                'nisn' => $request->nisn,
                'nama_siswa' => $request->nama_siswa,
                'jk' => $request->jk,
                'agama' => $request->agama,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat' => $request->alamat,
                'desa' => $request->desa,
                'kec' => $request->kec,
                'kab' => $request->kab,
                'prov' => $request->prov,
                'kode_pos' => $request->kode_pos,
                'hp' => $request->hp,
                'email' => $request->email,
                'password' => Hash::make('abcde'),
                'level' => 'siswa',
                'role' => 'siswa'
            ]);
            return redirect('/admin/siswa')->with(['status' => 'sukses', 'msg' => 'Data Siswa Disimpan']);
        } catch (\Exception $e) {
            return back()->with(['status'=>'error', 'msg' => $e->getCode().':'.$e->getMessage()]);
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
     * @param  \App\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Siswa $siswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $id = $request->id_siswa;
            Siswa::findOrFail($id)->update($request->all());
            // return redirect('/siswa')->with(['status' => 'sukses', 'msg' => 'Data Siswa diperbarui.']);
            return response()->json(['status' => 'sukses', 'msg' => 'Data Siswa diperbarui.']);
        } catch (\Exception $e)
        {
            return response()->json(['status' => 'error', 'msg' => $e->getCode().':'.$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try {
            Siswa::findOrFail($id)->delete();
            return response()->json(['status' => 'sukses', 'msg' => 'Data Siswa dihapus']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'msg' => $e->getCode().':'.$e->getMessage()]);
        }
    }
}
