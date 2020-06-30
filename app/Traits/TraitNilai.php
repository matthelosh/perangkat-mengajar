<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
trait TraitNilai
{
    public function rekap34(Request $request)
    {
        $nilaiK3 = DB::table('nilais')
                        ->select(DB::raw('nilais.siswa_id,  AVG(CASE WHEN nilais.mapel_id = "pabp" AND nilais.periode ="uh" THEN nilais.nilai END) as "k3_pabp_uh", 
                                                            AVG(CASE WHEN nilais.mapel_id = "pabp" AND nilais.periode = "pts" THEN nilais.nilai END) AS "k3_pabp_pts",
                                                            AVG(CASE WHEN nilais.mapel_id = "pabp" AND nilais.periode = "pas" THEN nilais.nilai END) AS "k3_pabp_pas",
                                                            AVG(CASE WHEN nilais.mapel_id = "pkn" AND nilais.periode = "uh" THEN nilais.nilai END) AS "k3_pkn_uh",
                                                            AVG(CASE WHEN nilais.mapel_id = "pkn" AND nilais.periode = "pts" THEN nilais.nilai END) AS "k3_pkn_pts",
                                                            AVG(CASE WHEN nilais.mapel_id = "pkn" AND nilais.periode = "pas" THEN nilais.nilai END) AS "k3_pkn_pas",
                                                            AVG(CASE WHEN nilais.mapel_id = "bid" AND nilais.periode = "uh" THEN nilais.nilai END) AS "k3_bid_uh",
                                                            AVG(CASE WHEN nilais.mapel_id = "bid" AND nilais.periode = "pts" THEN nilais.nilai END) AS "k3_bid_pts",
                                                            AVG(CASE WHEN nilais.mapel_id = "bid" AND nilais.periode = "pas" THEN nilais.nilai END) AS "k3_bid_pas",
                                                            AVG(CASE WHEN nilais.mapel_id = "mtk" AND nilais.periode = "uh" THEN nilais.nilai END) as "k3_mtk_uh",
                                                            AVG(CASE WHEN nilais.mapel_id = "mtk" AND nilais.periode = "pts" THEN nilais.nilai END) AS "k3_mtk_pts",
                                                            AVG(CASE WHEN nilais.mapel_id = "mtk" AND nilais.periode = "pas" THEN nilais.nilai END) AS "k3_mtk_pas",
                                                            AVG(CASE WHEN nilais.mapel_id = "ipa" AND nilais.periode = "uh" THEN nilais.nilai END) AS "k3_ipa_uh",
                                                            AVG(CASE WHEN nilais.mapel_id = "ipa" AND nilais.periode = "pts" THEN nilais.nilai END) AS "k3_ipa_pts",
                                                            AVG(CASE WHEN nilais.mapel_id = "ipa" AND nilais.periode = "pas" THEN nilais.nilai END) as "k3_ipa_pas",
                                                            AVG(CASE WHEN nilais.mapel_id = "ips" AND nilais.periode = "uh" THEN nilais.nilai END) as "k3_ips_uh",
                                                            AVG(CASE WHEN nilais.mapel_id = "ips" AND nilais.periode = "pts" THEN nilais.nilai END) as "k3_ips_pts",
                                                            AVG(CASE WHEN nilais.mapel_id = "ips" AND nilais.periode = "pas" THEN nilais.nilai END) AS "k3_ips_pas",
                                                            AVG(CASE WHEN nilais.mapel_id = "sbdp" AND nilais.periode = "uh" THEN nilais.nilai END) AS "k3_sbdp_uh",
                                                            AVG(CASE WHEN nilais.mapel_id = "sbdp" AND nilais.periode = "pts" THEN nilais.nilai END) AS "k3_sbdp_pts",
                                                            AVG(CASE WHEN nilais.mapel_id = "sbdp" AND nilais.periode = "pas" THEN nilais.nilai END) AS "k3_sbdp_pas",
                                                            AVG(CASE WHEN nilais.mapel_id = "pjok" AND nilais.periode = "uh" THEN nilais.nilai END) AS "k3_pjok_uh",
                                                            AVG(CASE WHEN nilais.mapel_id = "pjok" AND nilais.periode = "pts" THEN nilais.nilai END) AS "k3_pjok_pts",
                                                            AVG(CASE WHEN nilais.mapel_id = "pjok" AND nilais.periode = "pas" THEN nilais.nilai END) AS "k3_pjok_pas",
                                                            AVG(CASE WHEN nilais.mapel_id = "big" AND nilais.periode = "uh" THEN nilais.nilai END) AS "k3_big_uh",
                                                            AVG(CASE WHEN nilais.mapel_id = "big" AND nilais.periode = "pts" THEN nilais.nilai END) AS "k3_big_pts",
                                                            AVG(CASE WHEN nilais.mapel_id = "big" AND nilais.periode = "pas" THEN nilais.nilai END) AS "k3_big_pas",
                                                            AVG(CASE WHEN nilais.mapel_id = "bd" AND nilais.periode = "uh" THEN nilais.nilai END) AS "k3_bd_uh",
                                                            AVG(CASE WHEN nilais.mapel_id = "bd" AND nilais.periode = "pts" THEN nilais.nilai END) AS "k3_bd_pts",
                                                            AVG(CASE WHEN nilais.mapel_id = "bd" AND nilais.periode = "pas" THEN nilais.nilai END) AS "k3_bd_pas"
                                    ')
                                )
                        ->groupBy('nilais.siswa_id')
                        ->where('semester', '=', $request->session()->get('semester'))
                        ->where('nilais.kd_id', 'LIKE', '3.%')
                        ->where('nilais.rombel_id', '=', $request->session()->get('rombel')->kode_rombel);

        $nilaiK4 = DB::table('nilais')
                        ->select(DB::raw('nilais.siswa_id, AVG(CASE WHEN nilais.mapel_id = "pabp" AND nilais.periode ="uh" THEN nilais.nilai END) as "k4_pabp_uh", 
                                                            AVG(CASE WHEN nilais.mapel_id = "pabp" AND nilais.periode = "pts" THEN nilais.nilai END) AS "k4_pabp_pts",
                                                            AVG(CASE WHEN nilais.mapel_id = "pabp" AND nilais.periode = "pas" THEN nilais.nilai END) AS "k4_pabp_pas",
                                                            AVG(CASE WHEN nilais.mapel_id = "pkn" AND nilais.periode = "uh" THEN nilais.nilai END) AS "k4_pkn_uh",
                                                            AVG(CASE WHEN nilais.mapel_id = "pkn" AND nilais.periode = "pts" THEN nilais.nilai END) AS "k4_pkn_pts",
                                                            AVG(CASE WHEN nilais.mapel_id = "pkn" AND nilais.periode = "pas" THEN nilais.nilai END) AS "k4_pkn_pas",
                                                            AVG(CASE WHEN nilais.mapel_id = "bid" AND nilais.periode = "uh" THEN nilais.nilai END) AS "k4_bid_uh",
                                                            AVG(CASE WHEN nilais.mapel_id = "bid" AND nilais.periode = "pts" THEN nilais.nilai END) AS "k4_bid_pts",
                                                            AVG(CASE WHEN nilais.mapel_id = "bid" AND nilais.periode = "pas" THEN nilais.nilai END) AS "k4_bid_pas",
                                                            AVG(CASE WHEN nilais.mapel_id = "mtk" AND nilais.periode = "uh" THEN nilais.nilai END) as "k4_mtk_uh",
                                                            AVG(CASE WHEN nilais.mapel_id = "mtk" AND nilais.periode = "pts" THEN nilais.nilai END) AS "k4_mtk_pts",
                                                            AVG(CASE WHEN nilais.mapel_id = "mtk" AND nilais.periode = "pas" THEN nilais.nilai END) AS "k4_mtk_pas",
                                                            AVG(CASE WHEN nilais.mapel_id = "ipa" AND nilais.periode = "uh" THEN nilais.nilai END) AS "k4_ipa_uh",
                                                            AVG(CASE WHEN nilais.mapel_id = "ipa" AND nilais.periode = "pts" THEN nilais.nilai END) AS "k4_ipa_pts",
                                                            AVG(CASE WHEN nilais.mapel_id = "ipa" AND nilais.periode = "pas" THEN nilais.nilai END) as "k4_ipa_pas",
                                                            AVG(CASE WHEN nilais.mapel_id = "ips" AND nilais.periode = "uh" THEN nilais.nilai END) as "k4_ips_uh",
                                                            AVG(CASE WHEN nilais.mapel_id = "ips" AND nilais.periode = "pts" THEN nilais.nilai END) as "k4_ips_pts",
                                                            AVG(CASE WHEN nilais.mapel_id = "ips" AND nilais.periode = "pas" THEN nilais.nilai END) AS "k4_ips_pas",
                                                            AVG(CASE WHEN nilais.mapel_id = "sbdp" AND nilais.periode = "uh" THEN nilais.nilai END) AS "k4_sbdp_uh",
                                                            AVG(CASE WHEN nilais.mapel_id = "sbdp" AND nilais.periode = "pts" THEN nilais.nilai END) AS "k4_sbdp_pts",
                                                            AVG(CASE WHEN nilais.mapel_id = "sbdp" AND nilais.periode = "pas" THEN nilais.nilai END) AS "k4_sbdp_pas",
                                                            AVG(CASE WHEN nilais.mapel_id = "pjok" AND nilais.periode = "uh" THEN nilais.nilai END) AS "k4_pjok_uh",
                                                            AVG(CASE WHEN nilais.mapel_id = "pjok" AND nilais.periode = "pts" THEN nilais.nilai END) AS "k4_pjok_pts",
                                                            AVG(CASE WHEN nilais.mapel_id = "pjok" AND nilais.periode = "pas" THEN nilais.nilai END) AS "k4_pjok_pas",
                                                            AVG(CASE WHEN nilais.mapel_id = "big" AND nilais.periode = "uh" THEN nilais.nilai END) AS "k4_big_uh",
                                                            AVG(CASE WHEN nilais.mapel_id = "big" AND nilais.periode = "pts" THEN nilais.nilai END) AS "k4_big_pts",
                                                            AVG(CASE WHEN nilais.mapel_id = "big" AND nilais.periode = "pas" THEN nilais.nilai END) AS "k4_big_pas",
                                                            AVG(CASE WHEN nilais.mapel_id = "bd" AND nilais.periode = "uh" THEN nilais.nilai END) AS "k4_bd_uh",
                                                            AVG(CASE WHEN nilais.mapel_id = "bd" AND nilais.periode = "pts" THEN nilais.nilai END) AS "k4_bd_pts",
                                                            AVG(CASE WHEN nilais.mapel_id = "bd" AND nilais.periode = "pas" THEN nilais.nilai END) AS "k4_bd_pas"
                                    ')
                                )
                        ->groupBy('nilais.siswa_id')
                        ->where('semester', '=', $request->session()->get('semester'))
                        ->where('nilais.kd_id', 'LIKE', '4.%')
                        ->where('nilais.rombel_id', '=', $request->session()->get('rombel')->kode_rombel);
        
        

        $nilai34 = DB::table('siswas')
                    ->joinSub($nilaiK3, 'nilai_k3', function($join) {
                        $join->on('siswas.nisn', '=', 'nilai_k3.siswa_id');
                        })
                    ->joinSub($nilaiK4, 'nilai_k4', function($join) {
                        $join->on('siswas.nisn', '=', 'nilai_k4.siswa_id');
                        })
                    ->paginate(10);
        
        // dd($nilai34);
        return $nilai34;
        // dd($siswas);
    }


    public function rekap12(Request $request)
    {
        $nilaiK1 = DB::table('nilais')
                        ->select(DB::raw('nilais.siswa_id,  
                                AVG(CASE WHEN nilais.kd_id = "1.1" AND nilais.periode ="uh" THEN nilais.nilai END) as "k1_11_uh", 
                                AVG(CASE WHEN nilais.kd_id = "1.1" AND nilais.periode = "pts" THEN nilais.nilai END) AS "k1_11_pts",
                                AVG(CASE WHEN nilais.kd_id = "1.1" AND nilais.periode = "pas" THEN nilais.nilai END) AS "k1_11_pas",
                                AVG(CASE WHEN nilais.kd_id = "1.2" AND nilais.periode ="uh" THEN nilais.nilai END) as "k1_12_uh", 
                                AVG(CASE WHEN nilais.kd_id = "1.2" AND nilais.periode = "pts" THEN nilais.nilai END) AS "k1_12_pts",
                                AVG(CASE WHEN nilais.kd_id = "1.2" AND nilais.periode = "pas" THEN nilais.nilai END) AS "k1_12_pas",
                                AVG(CASE WHEN nilais.kd_id = "1.3" AND nilais.periode ="uh" THEN nilais.nilai END) as "k1_13_uh", 
                                AVG(CASE WHEN nilais.kd_id = "1.3" AND nilais.periode = "pts" THEN nilais.nilai END) AS "k1_13_pts",
                                AVG(CASE WHEN nilais.kd_id = "1.3" AND nilais.periode = "pas" THEN nilais.nilai END) AS "k1_13_pas",
                                AVG(CASE WHEN nilais.kd_id = "1.4" AND nilais.periode ="uh" THEN nilais.nilai END) as "k1_14_uh", 
                                AVG(CASE WHEN nilais.kd_id = "1.4" AND nilais.periode = "pts" THEN nilais.nilai END) AS "k1_14_pts",
                                AVG(CASE WHEN nilais.kd_id = "1.4" AND nilais.periode = "pas" THEN nilais.nilai END) AS "k1_14_pas"
                            ')
                        )
                        ->groupBy('nilais.siswa_id')
                        ->where('nilais.kd_id', 'LIKE', '1.%')
                        ->where('semester', '=', $request->session()->get('semester'))
                        ->where('nilais.rombel_id', '=', $request->session()->get('rombel')->kode_rombel);

        $nilaiK2 = DB::table('nilais')
                        ->select(DB::raw('nilais.siswa_id,  
                                AVG(CASE WHEN nilais.kd_id = "2.1" AND nilais.periode ="uh" THEN nilais.nilai END) as "k2_21_uh", 
                                AVG(CASE WHEN nilais.kd_id = "2.1" AND nilais.periode = "pts" THEN nilais.nilai END) AS "k2_21_pts",
                                AVG(CASE WHEN nilais.kd_id = "2.1" AND nilais.periode = "pas" THEN nilais.nilai END) AS "k2_21_pas",
                                AVG(CASE WHEN nilais.kd_id = "2.2" AND nilais.periode ="uh" THEN nilais.nilai END) as "k2_22_uh", 
                                AVG(CASE WHEN nilais.kd_id = "2.2" AND nilais.periode = "pts" THEN nilais.nilai END) AS "k2_22_pts",
                                AVG(CASE WHEN nilais.kd_id = "2.2" AND nilais.periode = "pas" THEN nilais.nilai END) AS "k2_22_pas",
                                AVG(CASE WHEN nilais.kd_id = "2.3" AND nilais.periode ="uh" THEN nilais.nilai END) as "k2_23_uh", 
                                AVG(CASE WHEN nilais.kd_id = "2.3" AND nilais.periode = "pts" THEN nilais.nilai END) AS "k2_23_pts",
                                AVG(CASE WHEN nilais.kd_id = "2.3" AND nilais.periode = "pas" THEN nilais.nilai END) AS "k2_23_pas",
                                AVG(CASE WHEN nilais.kd_id = "2.4" AND nilais.periode ="uh" THEN nilais.nilai END) as "k2_24_uh", 
                                AVG(CASE WHEN nilais.kd_id = "2.4" AND nilais.periode = "pts" THEN nilais.nilai END) AS "k2_24_pts",
                                AVG(CASE WHEN nilais.kd_id = "2.4" AND nilais.periode = "pas" THEN nilais.nilai END) AS "k2_24_pas",
                                AVG(CASE WHEN nilais.kd_id = "2.5" AND nilais.periode ="uh" THEN nilais.nilai END) as "k2_25_uh", 
                                AVG(CASE WHEN nilais.kd_id = "2.5" AND nilais.periode = "pts" THEN nilais.nilai END) AS "k2_25_pts",
                                AVG(CASE WHEN nilais.kd_id = "2.5" AND nilais.periode = "pas" THEN nilais.nilai END) AS "k2_25_pas",
                                AVG(CASE WHEN nilais.kd_id = "2.6" AND nilais.periode ="uh" THEN nilais.nilai END) as "k2_26_uh", 
                                AVG(CASE WHEN nilais.kd_id = "2.6" AND nilais.periode = "pts" THEN nilais.nilai END) AS "k2_26_pts",
                                AVG(CASE WHEN nilais.kd_id = "2.6" AND nilais.periode = "pas" THEN nilais.nilai END) AS "k2_26_pas"
                            ')
                        )
                        ->groupBy('nilais.siswa_id')
                        ->where('nilais.kd_id', 'LIKE', '2.%')
                        ->where('semester', '=', $request->session()->get('semester'))
                        ->where('nilais.rombel_id', '=', $request->session()->get('rombel')->kode_rombel);


        $nilai12 = DB::table('siswas')
                    ->joinSub($nilaiK1, 'nilai_k1', function($join) {
                        $join->on('siswas.nisn', '=', 'nilai_k1.siswa_id');
                        })
                    ->joinSub($nilaiK2, 'nilai_k2', function($join) {
                        $join->on('siswas.nisn', '=', 'nilai_k2.siswa_id');
                        })
                    ->paginate(10);
        // $nilai12->withPath('sikap');
        
        // dd($nilai12);
        return $nilai12;
        // dd($siswas);
    }

    public function nilaiSikap($nisn, $semester, $rombel)
    {
        $datas = [];
            // KD 1
        $n1 = DB::table("nilais")->select(DB::raw('
            kd_id,
            AVG(nilai) AS rt1
        '))
        ->where([
            ['siswa_id','=', $nisn],
            ['semester','=', $semester],
            ['rombel_id','=', $rombel->kode_rombel],
            ['kd_id', 'LIKE', '1.%'],
            ['mapel_id', '=', 'pabp']
        ])
        ->groupBy('kd_id')
        ->get();

        foreach($n1 as $n)
        {
            $kd = 'App\Kd'::where('kode_kd','=', $n->kd_id)->where('mapel_id','pabp')->first();
            $datas['k1'][$n->kd_id] = $this->kata_op1($n->rt1).$kd->teks_kd;
        }

        // dd($n1);
        // End KD 1
        // KD 2
        $n2 = DB::table("nilais")->select(DB::raw('
                kd_id,
                AVG(nilai) AS rt2
            '))
            ->where([
            ['siswa_id','=', $nisn],
            ['semester','=', $semester],
            ['rombel_id','=', $rombel->kode_rombel],
            ['kd_id', 'LIKE', '2.%'],
            ['mapel_id', '=', 'pkn']
        ])
        ->groupBy('kd_id')
        ->get();

        foreach($n2 as $n)
        {
            $kd = 'App\Kd'::where('kode_kd','=', $n->kd_id)->where('mapel_id','pkn')->first();
            $datas['k2'][$n->kd_id] = $this->kata_op2($n->rt2).$kd->teks_kd;
        }

        // dd($n1);
        // End KD 2
        // dd($datas);
        return $datas;
    }

    public function nilaiRapor($nisn, $semester, $rombel)
    {
        $key_mapels = ($rombel->tingkat > 3) ? array('tingkat', 'LIKE', '%') : array('tingkat', '!=', 'besar');
        $mapels = 'App\Mapel'::where([$key_mapels])->get();

        $datas=[];
        foreach($mapels as $mapel)
        {
            $datas[$mapel->kode_mapel]['nama_mapel'] = $mapel->nama_mapel;
        
        
        // KD 3
            $na3 =  DB::table('nilais')->select(DB::raw('
            AVG(nilai) as na
            '))
            ->where([
                ['siswa_id','=', $nisn],
                ['semester','=', $semester],
                ['rombel_id','=', $rombel->kode_rombel],
                ['kd_id', 'LIKE', '3.%'],
                ['mapel_id', '=', $mapel->kode_mapel]
            ])
            ->first();
            $datas[$mapel->kode_mapel]['k3']['na'] = $na3->na;
            
            $rt3 = DB::table('nilais')->select(DB::raw('
                kd_id,
                AVG(nilai) as rt2
            '))
            ->where([
                ['mapel_id','=', $mapel->kode_mapel],
                ['siswa_id','=',$nisn],
                ['kd_id' ,'LIKE', '3.%']
            ])->groupBy('mapel_id','kd_id')
            ->get();
            
            foreach($rt3 as $rt)
            {
                $datas[$mapel->kode_mapel]['k3']['rt'][$rt->kd_id] = $rt->rt2;
                
            }

            $maxkd3 = (isset($datas[$mapel->kode_mapel]['k3']['rt'])) ? array_keys(($datas[$mapel->kode_mapel]['k3']['rt']),  max($datas[$mapel->kode_mapel]['k3']['rt'])): null;
            $max3 = (isset($datas[$mapel->kode_mapel]['k3']['rt'])) ? max($datas[$mapel->kode_mapel]['k3']['rt']) : null;

            
            $minkd3 = (isset($datas[$mapel->kode_mapel]['k3']['rt'])) ? array_keys(($datas[$mapel->kode_mapel]['k3']['rt']), min($datas[$mapel->kode_mapel]['k3']['rt'])): null;
            $min3 = (isset($datas[$mapel->kode_mapel]['k3']['rt'])) ? min($datas[$mapel->kode_mapel]['k3']['rt']) : null;

            
            // Ambil KD Max dan Min
            if(isset($maxkd3)) {
                // $d = [];
                foreach($maxkd3 as $m)
                {
                    $kd = 'App\Kd'::where([
                        ['kode_kd','=', $m],
                        ['mapel_id','=', $mapel->kode_mapel],
                        ['tingkat','=', $rombel->tingkat]
                    ])->first();
                    // dd($kd);
                    // array_push($d, $kd);
                    $datas[$mapel->kode_mapel]['k3']['max'][$m] = $this->kata_op($max3) ;
                }
                // dd($d);.$kd->teks_kd
            } else {
                $datas[$mapel->kode_mapel]['k3']['max'] = null;
            }
            if(isset($minkd3)) {
                foreach($minkd3 as $m)
                {
                    $kd = 'App\Kd'::where([
                        ['kode_kd','=', $m],
                        ['mapel_id','=', $mapel->kode_mapel],
                        ['tingkat','=', $rombel->tingkat]
                    ])->first();
                    $datas[$mapel->kode_mapel]['k3']['min'][$m] = $this->kata_op($min3).$kd->teks_kd;
                }
            } else {
                $datas[$mapel->kode_mapel]['k3']['min'] = null;
            }

        // End KD 3
        // Start KD 4
            $na4 =  DB::table('nilais')->select(DB::raw('
            AVG(nilai) as na
            '))
            ->where([
                ['siswa_id','=', $nisn],
                ['semester','=', $semester],
                ['rombel_id','=', $rombel->kode_rombel],
                ['kd_id', 'LIKE', '4.%'],
                ['mapel_id', '=', $mapel->kode_mapel]
            ])
            ->first();
            $datas[$mapel->kode_mapel]['k4']['na'] = $na4->na;
            
            $rt4 = DB::table('nilais')->select(DB::raw('
                kd_id,
                AVG(nilai) as rt2
            '))
            ->where([
                ['mapel_id','=', $mapel->kode_mapel],
                ['siswa_id','=',$nisn],
                ['kd_id' ,'LIKE', '4.%']
            ])->groupBy('mapel_id','kd_id')
            ->get();
            
            foreach($rt4 as $rt)
            {
                $datas[$mapel->kode_mapel]['k4']['rt'][$rt->kd_id] = $rt->rt2;
                
            }

            $maxkd4 = (isset($datas[$mapel->kode_mapel]['k4']['rt'])) ? array_keys(($datas[$mapel->kode_mapel]['k4']['rt']),  max($datas[$mapel->kode_mapel]['k4']['rt'])): null;
            $max4 = (isset($datas[$mapel->kode_mapel]['k4']['rt'])) ?max($datas[$mapel->kode_mapel]['k4']['rt']) :null;

            $minkd4 = (isset($datas[$mapel->kode_mapel]['k4']['rt'])) ? array_keys(($datas[$mapel->kode_mapel]['k4']['rt']), min($datas[$mapel->kode_mapel]['k4']['rt'])): null;
            $min4 = (isset($datas[$mapel->kode_mapel]['k4']['rt'])) ? min($datas[$mapel->kode_mapel]['k4']['rt']) :null;


            // Ambil KD Max dan Min
            if(isset($maxkd4)) {
                foreach($maxkd4 as $m)
                {
                    $kd = 'App\Kd'::where([
                        ['kode_kd','=', $m],
                        ['mapel_id','=', $mapel->kode_mapel],
                        ['tingkat','=', $rombel->tingkat]
                    ])->first();
                    $datas[$mapel->kode_mapel]['k4']['max'][$m] = $this->kata_op($max4) .$kd->teks_kd;
                }
            } else {
                $datas[$mapel->kode_mapel]['k4']['max'] = null;
            }
            if(isset($minkd4)) {
                foreach($minkd4 as $m)
                {
                    $kd = 'App\Kd'::where([
                        ['kode_kd','=', $m],
                        ['mapel_id','=', $mapel->kode_mapel],
                        ['tingkat','=', $rombel->tingkat]
                    ])->first();
                    $datas[$mapel->kode_mapel]['k4']['min'][$m] = $this->kata_op($min4).$kd->teks_kd;
                }
            } else {
                $datas[$mapel->kode_mapel]['k4']['min'] = null;
            }

        // End KD 4
            

        }

        

        // dd($datas);
        return $datas;
    }

    public function nilaiEkstra($nisn, $semester, $rombel)
    {
    //    try {
            $datas = [];
           $ekstras = 'App\Ekskul'::all();
           foreach($ekstras as $ekstra)
           {
               $datas[$ekstra->kode_ekskul]['nama_ekskul'] = $ekstra->nama_ekskul;
               $nilai = 'App\NilaiEkstra'::where([
                   ['siswa_id','=', $nisn],
                   ['semester', '=', $semester],
                   ['rombel_id','=', $rombel->kode_rombel],
                   ['ekstra_id','=', $ekstra->kode_ekskul]
               ])->first();

            //    $datas[$ekstra->kode_ekskul]['ket'] = (isset($nilai->ket)) ?? null;
            $datas[$ekstra->kode_ekskul]['ket'] = ($nilai != null) ? $nilai->ket: null;
           }
            // dd($datas);
            return $datas;
    //    } catch (\Exception $e) {
    //        return $e->getCode().':'.$e->getMessage();
    //    }
    }
    public function kata_op($nilai)
    {
        // return ((Int) $nilai >= 90) ? "Sangat baik dalam " : ((Int)$nilai >= 80) ? "Baik dalam": ((Int) $nilai >= 70) ? "Cukup dalam " : "Perlu bimbingan dalam ";
        $teks= '';
        if ($nilai >= 90) {
            return "sangat baik dalam ";
        } elseif ($nilai >= 80) {
            return "baik dalam ";
        } elseif ($nilai >= 70) {
            return "cukup dalam ";
        } else {
            return "perlu bimbingan dalam ";
        }
    }
    public function kata_op1($nilai)
    {
        // return ((Int) $nilai >= 90) ? "Sangat baik dalam " : ((Int)$nilai >= 80) ? "Baik dalam": ((Int) $nilai >= 70) ? "Cukup dalam " : "Perlu bimbingan dalam ";
        $teks= '';
        if ($nilai >= 90) {
            return "sangat ";
        } elseif ($nilai >= 80) {
            return " ";
        } elseif ($nilai >= 70) {
            return "cukup dalam ";
        } else {
            return "perlu bimbingan dalam ";
        }
    }
    public function kata_op2($nilai)
    {
        // return ((Int) $nilai >= 90) ? "Sangat baik dalam " : ((Int)$nilai >= 80) ? "Baik dalam": ((Int) $nilai >= 70) ? "Cukup dalam " : "Perlu bimbingan dalam ";
        $teks= '';
        if ($nilai >= 90) {
            return "sangat ";
        } elseif ($nilai >= 80) {
            return " ";
        } elseif ($nilai >= 70) {
            return "cukup ";
        } else {
            return "perlu bimbingan untuk ";
        }
    }

    public function nilaiPTS($nisn, $semester, $rombel)
    {
        $datas = [];
        $key_mapels = ($rombel->tingkat > 3) ? array('tingkat', 'LIKE', '%') : array('tingkat', '!=', 'besar');
        $mapels = 'App\Mapel'::where([$key_mapels])->get();
        foreach($mapels as $mapel)
        {
            $datas[$mapel->kode_mapel]['nama_mapel'] = $mapel->nama_mapel;

            $kds = 'App\Prosem'::where([
                ['semester','=', 'genap'],
                ['tingkat','=', $rombel->tingkat],
                ['mapel_id','=', $mapel->kode_mapel]
            ])->get();
            foreach($kds as $kd) 
            {
                $datas[$mapel->kode_mapel]['nilais']['pts'][$kd->kd_id] = 'App\Nilai'::where([
                    ['semester','=', $semester],
                    ['siswa_id', '=', $nisn],
                    ['rombel_id', '=', $rombel->kode_rombel],
                    ['kd_id','=', $kd->kd_id],
                    ['periode','=', 'pts']
                ])->select('nilai')->first();
                $datas[$mapel->kode_mapel]['nilais']['uh'][$kd->kd_id] = 'App\Nilai'::where([
                    ['semester','=', $semester],
                    ['siswa_id', '=', $nisn],
                    ['rombel_id', '=', $rombel->kode_rombel],
                    ['kd_id','=', $kd->kd_id],
                    ['periode','=','uh']
                ])->select('nilai')->first();

            }
        }

        // dd($datas);
        return $datas;
    }
}