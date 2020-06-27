<?php

namespace App\Http\Controllers;

use App\Sekolah;
use Illuminate\Http\Request;
use App\Imports\SekolahImport;
// use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;


class SekolahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function import(Request $request)
    {
      $file = $request->file('file');
      try {
        Excel::import(new SekolahImport, $file);
        $sekolahs = Sekolah::paginate(10);
        return view('pages.admin.dashboard', ['page_title' => 'Data Sekolah', 'sekolahs' => $sekolahs])->with(['status' => 'sukses', 'msg' => 'Data Sekolah diimpor']);
      } catch (\Exception $e) {
        return back()->with(['status' => 'error', 'msg' => $e->getMessage().':'.$e->getMessage()]);
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
     * @param  \App\Sekolah  $sekolah
     * @return \Illuminate\Http\Response
     */
    public function show(Sekolah $sekolah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sekolah  $sekolah
     * @return \Illuminate\Http\Response
     */
    public function edit(Sekolah $sekolah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sekolah  $sekolah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($request->all());
        if ($request->id == '0') {
            Sekolah::create($request->all());
            return back()->with(['status' => 'sukses', 'msg' => 'Data Sekolah dibuat/diperbarui']);
        } else {
            Sekolah::find($request->id)->update($request->all());
            return back()->with(['status' => 'sukses', 'msg' => 'Data Sekolah dibuat/diperbarui']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sekolah  $sekolah
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sekolah $sekolah)
    {
        //
    }
}
