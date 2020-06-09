<?php

namespace App\Http\Controllers;

use App\Tema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TemaController extends Controller
{
    public function index(Request $request)
    {

        if($request->query('req')) {
            switch($request->query('req'))
            {
                case "select";
                    $rombel = 'App\Rombel'::where(['sekolah_id' => Auth::user()->sekolah_id, 'guru_id' => Auth::user()->nip])->first();
                    if($request->q != '') {
                        $temas = Tema::where([
                            ['teks_tema','LIKE', '%'.$request->q.'%'],
                            ['tingkat', '=', $rombel->tingkat]
                        ])->orderBy('kode_tema')->get();
                    } else {
                        $temas = Tema::where(['tingkat' => $rombel->tingkat])->orderBy('kode_tema')->get();
                    }

                    $datas = [];
                    foreach($temas as $tema)
                    {
                        $no = explode('-', $tema->kode_tema);
                        array_push($datas, ['id' => $tema->kode_tema, 'text' => $no[1].'. '.$tema->teks_tema]);
                    }
                    return response()->json($datas);
                break;
            }
        }
    }
}
