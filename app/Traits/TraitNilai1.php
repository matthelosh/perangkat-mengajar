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
        
        return $nilai34;
        // dd($siswas);
    }


    public function rekap12(Request $request)
    {
        $nilaiK1 = DB::table('nilais')
                        ->select(DB::raw('nilais.siswa_id,  AVG(CASE WHEN nilais.mapel_id = "pabp" AND nilais.periode ="uh" THEN nilais.nilai END) as "k1_pabp_uh", 
                                                            AVG(CASE WHEN nilais.mapel_id = "pabp" AND nilais.periode = "pts" THEN nilais.nilai END) AS "k1_pabp_pts",
                                                            AVG(CASE WHEN nilais.mapel_id = "pabp" AND nilais.periode = "pas" THEN nilais.nilai END) AS "k1_pabp_pas",
                                                            AVG(CASE WHEN nilais.mapel_id = "pkn" AND nilais.periode = "uh" THEN nilais.nilai END) AS "k1_pkn_uh",
                                                            AVG(CASE WHEN nilais.mapel_id = "pkn" AND nilais.periode = "pts" THEN nilais.nilai END) AS "k1_pkn_pts",
                                                            AVG(CASE WHEN nilais.mapel_id = "pkn" AND nilais.periode = "pas" THEN nilais.nilai END) AS "k1_pkn_pas",
                                                            AVG(CASE WHEN nilais.mapel_id = "bid" AND nilais.periode = "uh" THEN nilais.nilai END) AS "k1_bid_uh",
                                                            AVG(CASE WHEN nilais.mapel_id = "bid" AND nilais.periode = "pts" THEN nilais.nilai END) AS "k1_bid_pts",
                                                            AVG(CASE WHEN nilais.mapel_id = "bid" AND nilais.periode = "pas" THEN nilais.nilai END) AS "k1_bid_pas",
                                                            AVG(CASE WHEN nilais.mapel_id = "mtk" AND nilais.periode = "uh" THEN nilais.nilai END) as "k1_mtk_uh",
                                                            AVG(CASE WHEN nilais.mapel_id = "mtk" AND nilais.periode = "pts" THEN nilais.nilai END) AS "k1_mtk_pts",
                                                            AVG(CASE WHEN nilais.mapel_id = "mtk" AND nilais.periode = "pas" THEN nilais.nilai END) AS "k1_mtk_pas",
                                                            AVG(CASE WHEN nilais.mapel_id = "ipa" AND nilais.periode = "uh" THEN nilais.nilai END) AS "k1_ipa_uh",
                                                            AVG(CASE WHEN nilais.mapel_id = "ipa" AND nilais.periode = "pts" THEN nilais.nilai END) AS "k1_ipa_pts",
                                                            AVG(CASE WHEN nilais.mapel_id = "ipa" AND nilais.periode = "pas" THEN nilais.nilai END) as "k1_ipa_pas",
                                                            AVG(CASE WHEN nilais.mapel_id = "ips" AND nilais.periode = "uh" THEN nilais.nilai END) as "k1_ips_uh",
                                                            AVG(CASE WHEN nilais.mapel_id = "ips" AND nilais.periode = "pts" THEN nilais.nilai END) as "k1_ips_pts",
                                                            AVG(CASE WHEN nilais.mapel_id = "ips" AND nilais.periode = "pas" THEN nilais.nilai END) AS "k1_ips_pas",
                                                            AVG(CASE WHEN nilais.mapel_id = "sbdp" AND nilais.periode = "uh" THEN nilais.nilai END) AS "k1_sbdp_uh",
                                                            AVG(CASE WHEN nilais.mapel_id = "sbdp" AND nilais.periode = "pts" THEN nilais.nilai END) AS "k1_sbdp_pts",
                                                            AVG(CASE WHEN nilais.mapel_id = "sbdp" AND nilais.periode = "pas" THEN nilais.nilai END) AS "k1_sbdp_pas",
                                                            AVG(CASE WHEN nilais.mapel_id = "pjok" AND nilais.periode = "uh" THEN nilais.nilai END) AS "k1_pjok_uh",
                                                            AVG(CASE WHEN nilais.mapel_id = "pjok" AND nilais.periode = "pts" THEN nilais.nilai END) AS "k1_pjok_pts",
                                                            AVG(CASE WHEN nilais.mapel_id = "pjok" AND nilais.periode = "pas" THEN nilais.nilai END) AS "k1_pjok_pas",
                                                            AVG(CASE WHEN nilais.mapel_id = "big" AND nilais.periode = "uh" THEN nilais.nilai END) AS "k1_big_uh",
                                                            AVG(CASE WHEN nilais.mapel_id = "big" AND nilais.periode = "pts" THEN nilais.nilai END) AS "k1_big_pts",
                                                            AVG(CASE WHEN nilais.mapel_id = "big" AND nilais.periode = "pas" THEN nilais.nilai END) AS "k1_big_pas",
                                                            AVG(CASE WHEN nilais.mapel_id = "bd" AND nilais.periode = "uh" THEN nilais.nilai END) AS "k1_bd_uh",
                                                            AVG(CASE WHEN nilais.mapel_id = "bd" AND nilais.periode = "pts" THEN nilais.nilai END) AS "k1_bd_pts",
                                                            AVG(CASE WHEN nilais.mapel_id = "bd" AND nilais.periode = "pas" THEN nilais.nilai END) AS "k1_bd_pas"
                                    ')
                                )
                        ->groupBy('nilais.siswa_id')
                        ->where('nilais.kd_id', 'LIKE', '1.%')
                        ->where('semester', '=', $request->session()->get('semester'))
                        ->where('nilais.rombel_id', '=', $request->session()->get('rombel')->kode_rombel);

        $nilaiK2 = DB::table('nilais')
                        ->select(DB::raw('nilais.siswa_id, AVG(CASE WHEN nilais.mapel_id = "pabp" AND nilais.periode ="uh" THEN nilais.nilai END) as "k2_pabp_uh", 
                                                            AVG(CASE WHEN nilais.mapel_id = "pabp" AND nilais.periode = "pts" THEN nilais.nilai END) AS "k2_pabp_pts",
                                                            AVG(CASE WHEN nilais.mapel_id = "pabp" AND nilais.periode = "pas" THEN nilais.nilai END) AS "k2_pabp_pas",
                                                            AVG(CASE WHEN nilais.mapel_id = "pkn" AND nilais.periode = "uh" THEN nilais.nilai END) AS "k2_pkn_uh",
                                                            AVG(CASE WHEN nilais.mapel_id = "pkn" AND nilais.periode = "pts" THEN nilais.nilai END) AS "k2_pkn_pts",
                                                            AVG(CASE WHEN nilais.mapel_id = "pkn" AND nilais.periode = "pas" THEN nilais.nilai END) AS "k2_pkn_pas",
                                                            AVG(CASE WHEN nilais.mapel_id = "bid" AND nilais.periode = "uh" THEN nilais.nilai END) AS "k2_bid_uh",
                                                            AVG(CASE WHEN nilais.mapel_id = "bid" AND nilais.periode = "pts" THEN nilais.nilai END) AS "k2_bid_pts",
                                                            AVG(CASE WHEN nilais.mapel_id = "bid" AND nilais.periode = "pas" THEN nilais.nilai END) AS "k2_bid_pas",
                                                            AVG(CASE WHEN nilais.mapel_id = "mtk" AND nilais.periode = "uh" THEN nilais.nilai END) as "k2_mtk_uh",
                                                            AVG(CASE WHEN nilais.mapel_id = "mtk" AND nilais.periode = "pts" THEN nilais.nilai END) AS "k2_mtk_pts",
                                                            AVG(CASE WHEN nilais.mapel_id = "mtk" AND nilais.periode = "pas" THEN nilais.nilai END) AS "k2_mtk_pas",
                                                            AVG(CASE WHEN nilais.mapel_id = "ipa" AND nilais.periode = "uh" THEN nilais.nilai END) AS "k2_ipa_uh",
                                                            AVG(CASE WHEN nilais.mapel_id = "ipa" AND nilais.periode = "pts" THEN nilais.nilai END) AS "k2_ipa_pts",
                                                            AVG(CASE WHEN nilais.mapel_id = "ipa" AND nilais.periode = "pas" THEN nilais.nilai END) as "k2_ipa_pas",
                                                            AVG(CASE WHEN nilais.mapel_id = "ips" AND nilais.periode = "uh" THEN nilais.nilai END) as "k2_ips_uh",
                                                            AVG(CASE WHEN nilais.mapel_id = "ips" AND nilais.periode = "pts" THEN nilais.nilai END) as "k2_ips_pts",
                                                            AVG(CASE WHEN nilais.mapel_id = "ips" AND nilais.periode = "pas" THEN nilais.nilai END) AS "k2_ips_pas",
                                                            AVG(CASE WHEN nilais.mapel_id = "sbdp" AND nilais.periode = "uh" THEN nilais.nilai END) AS "k2_sbdp_uh",
                                                            AVG(CASE WHEN nilais.mapel_id = "sbdp" AND nilais.periode = "pts" THEN nilais.nilai END) AS "k2_sbdp_pts",
                                                            AVG(CASE WHEN nilais.mapel_id = "sbdp" AND nilais.periode = "pas" THEN nilais.nilai END) AS "k2_sbdp_pas",
                                                            AVG(CASE WHEN nilais.mapel_id = "pjok" AND nilais.periode = "uh" THEN nilais.nilai END) AS "k2_pjok_uh",
                                                            AVG(CASE WHEN nilais.mapel_id = "pjok" AND nilais.periode = "pts" THEN nilais.nilai END) AS "k2_pjok_pts",
                                                            AVG(CASE WHEN nilais.mapel_id = "pjok" AND nilais.periode = "pas" THEN nilais.nilai END) AS "k2_pjok_pas",
                                                            AVG(CASE WHEN nilais.mapel_id = "big" AND nilais.periode = "uh" THEN nilais.nilai END) AS "k2_big_uh",
                                                            AVG(CASE WHEN nilais.mapel_id = "big" AND nilais.periode = "pts" THEN nilais.nilai END) AS "k2_big_pts",
                                                            AVG(CASE WHEN nilais.mapel_id = "big" AND nilais.periode = "pas" THEN nilais.nilai END) AS "k2_big_pas",
                                                            AVG(CASE WHEN nilais.mapel_id = "bd" AND nilais.periode = "uh" THEN nilais.nilai END) AS "k2_bd_uh",
                                                            AVG(CASE WHEN nilais.mapel_id = "bd" AND nilais.periode = "pts" THEN nilais.nilai END) AS "k2_bd_pts",
                                                            AVG(CASE WHEN nilais.mapel_id = "bd" AND nilais.periode = "pas" THEN nilais.nilai END) AS "k2_bd_pas"
                                    ')
                                )
                        ->groupBy('nilais.siswa_id')
                        ->where('semester', '=', $request->session()->get('semester'))
                        ->where('nilais.kd_id', 'LIKE', '2.%')
                        ->where('nilais.rombel_id', '=', $request->session()->get('rombel')->kode_rombel);
        
        

        $nilai12 = DB::table('siswas')
                    ->joinSub($nilaiK1, 'nilai_k1', function($join) {
                        $join->on('siswas.nisn', '=', 'nilai_k1.siswa_id');
                        })
                    ->joinSub($nilaiK2, 'nilai_k2', function($join) {
                        $join->on('siswas.nisn', '=', 'nilai_k2.siswa_id');
                        })
                    ->paginate(10);
        
        return $nilai12;
        // dd($siswas);
    }

    public function nilaiRapor($nisn, $semester, $rombel)
    {
        /**
         * $datas = [
         *      [mapel_id => pabp, nama_mapel => 'PABP', n_k3 => 70, pred_k3 => 'B', des_k3 => 'Siswa Cukup .., Kurang ..', n_k4 => 80, pred_k4 => 'A', des_k4 => 'Siswa Cukup'],
         *      [mapel_id => bid, nama_mapel => 'Bahasa Indonesia', n_k3 => 70, pred_k3 => 'B', des_k3 => 'Siswa Cukup .., Kurang ..', n_k4 => 80, pred_k4 => 'A', des_k4 => 'Siswa Cukup'],
         * ]
         * 
         */

        $datas = [];
        $nilais = DB::table('nilais')
                        // ->select(DB::raw(' nilais.mapel_id,
                        //                     AVG(CASE WHEN nilais.kd_id LIKE "1.%" THEN nilais.nilai END) AS "n_k1",
                        //                     AVG(CASE WHEN nilais.kd_id LIKE "2.%" THEN nilais.nilai END) AS "n_k2",
                        //                     AVG(CASE WHEN nilais.kd_id LIKE "3.%" THEN nilais.nilai END) AS "n_k3",
                        //                     AVG(CASE WHEN nilais.kd_id LIKE "4.%" THEN nilais.nilai END) AS "n_k4"
                                            
                        //                 ')
                        //             )
                        ->select(DB::raw(' nilais.mapel_id,
                                            AVG(CASE WHEN nilais.kd_id LIKE "3.%" AND nilais.periode="uh" THEN nilais.nilai END) AS "nuh_k3",
                                            AVG(CASE WHEN nilais.kd_id LIKE "3.%" AND nilais.periode="pts" THEN nilais.nilai END) AS "npts_k3",
                                            AVG(CASE WHEN nilais.kd_id LIKE "3.%" AND nilais.periode="pas" THEN nilais.nilai END) AS "npas_k3",
                                            AVG(CASE WHEN nilais.kd_id LIKE "4.%" AND nilais.periode="uh" THEN nilais.nilai END) AS "nuh_k4"
                                            AVG(CASE WHEN nilais.kd_id LIKE "4.%" AND nilais.periode="pts" THEN nilais.nilai END) AS "npts_k4"
                                            AVG(CASE WHEN nilais.kd_id LIKE "4.%" AND nilais.periode="pas" THEN nilais.nilai END) AS "npas_k4"
                                            
                                        ')
                                    )
                                    ->groupBy('nilais.mapel_id')
                                    ->where([
                                        // ['nilais.mapel_id', '=', 'pabp'],
                                        ['nilais.siswa_id', '=', $nisn],
                                        ['nilais.semester', '=', $semester],
                                        ['nilais.rombel_id', '=', $rombel->kode_rombel]
                                    ])
                                    ->get();
        
        
        $key_mapels = ($rombel->tingkat > 3) ? array('tingkat', 'LIKE', '%') : array('tingkat', '!=', 'besar'); 
        $mapels= DB::table('mapels')
                    ->where([
                        $key_mapels
                    ])
                    ->orderBy('id', 'asc')
                    ->get();

        $minmax = [];

        $nilais = [];
        $kds3 = [];
        $kds4 = [];

        $kd34 = 'App\Kd'::where([
            ['tingkat','=','1']

        ])->whereIn('ki_id',['3','4'])->get();
        $periodes = ['uh','pts','pas'];
        foreach($mapels as $mapel)
        {
            // for($i=0;$i < count($periodes);$i++) {
            //     $nilais[$mapel->kode_mapel][$periodes[$i]] = [];
            // }
            foreach($kd34 as $kd)
            {
                if($kd->mapel_id == $mapel->kode_mapel && $kd->ki_id == '3') {
                    $nilais[$mapel->kode_mapel]['k3'][$kd->kode_kd]=null;
                } elseif($kd->mapel_id == $mapel->kode_mapel && $kd->ki_id == '4') {
                    $nilais[$mapel->kode_mapel]['k4'][$kd->kode_kd]=null;
                }
                $nilais[$mapel->kode_mapel]['nama_mapel'] = $mapel->nama_mapel;
                // $nilais[$mapel->kode_mapel]['nama_mapel'] = $mapel->nama_mapel;
            }
        }

        $nilai3 = 'App\Nilai'::where([
            ['siswa_id','=',$nisn],
            ['rombel_id','=', $rombel->kode_rombel],
            ['semester','=',$semester],
            ['kd_id','LIKE','3.%']
        ])->select('kd_id','mapel_id', 'nilai','periode')->get();
        $nilai4 = 'App\Nilai'::where([
            ['siswa_id','=',$nisn],
            ['rombel_id','=', $rombel->kode_rombel],
            ['semester','=',$semester],
            ['kd_id','LIKE','4.%']
        ])->select('kd_id','mapel_id', 'nilai','periode')->get();

        foreach($nilais as $k=>$nilai)
        {
            foreach($nilai3 as $n3)
            {
                if($n3->mapel_id == $k) {
                    $nilais[$n3->mapel_id]['k3'][$n3->kd_id][$n3->periode] = $n3->nilai;
                }
            }
            foreach($nilai4 as $n4)
            {
                if($n4->mapel_id == $k) {
                    $nilais[$n4->mapel_id]['k4'][$n4->kd_id][$n4->periode] = $n4->nilai;
                }
            }
            // echo $k.'<br>';
        }

        // dd($nilais);

        // $cond = [
        //     // ['nilais.periode', '=', 'uh'],
        //     ['nilais.siswa_id', '=', $nisn],
        //     ['nilais.semester', '=', $semester],
        // ];
        
        // foreach($mapels as $mapel)
        // {

        //     $datas[$mapel->kode_mapel] = ['nama_mapel' => $mapel->nama_mapel, 'nilai' => (Object)['mapel_id' => $mapel->kode_mapel, 'n_k1' => null, 'n_k2' => null, 'n_k3' => null, 'n_k4' => null, ]];
        //     // $maxK1 = 'App\Nilai'::where($cond)->where('nilais.kd_id', 'LIKE', '1.%')->where('nilais.mapel_id', '=', $mapel->kode_mapel)->max('nilais.nilai');
        //     // $maxK2 = 'App\Nilai'::where($cond)->where('nilais.kd_id', 'LIKE', '2.%')->where('nilais.mapel_id', '=', $mapel->kode_mapel)->max('nilais.nilai');
        //     $maxK3 = 'App\Nilai'::where($cond)->where('nilais.kd_id', 'LIKE', '3.%')->where('nilais.mapel_id', '=', $mapel->kode_mapel)->max('nilais.nilai');
        //     $maxK4 = 'App\Nilai'::where($cond)->where('nilais.kd_id', 'LIKE', '4.%')->where('nilais.mapel_id', '=', $mapel->kode_mapel)->max('nilais.nilai');

        //     // $datas[$mapel->kode_mapel]['maxK1']= 'App\Nilai'::where($cond)->where('nilais.nilai', $maxK1)->select('nilais.nilai', 'nilais.kd_id', 'kds.kode_kd', 'kds.teks_kd', 'kds.mapel_id')
        //     //                                                 ->leftJoin('kds', function($join) use ($rombel, $mapel) {
        //     //                                                     $join->on('kds.kode_kd', '=', 'nilais.kd_id')
        //     //                                                         ->where([
        //     //                                                             ['kds.tingkat', '=', $rombel->tingkat],
        //     //                                                             ['kds.mapel_id', '=', $mapel->kode_mapel]
        //     //                                                         ]);
        //     //                                                 })->first();
        //     // $datas[$mapel->kode_mapel]['maxK2']= 'App\Nilai'::where($cond)->where('nilais.nilai', $maxK2)->select('nilais.nilai', 'nilais.kd_id', 'kds.kode_kd', 'kds.teks_kd', 'kds.mapel_id')
        //                                                     // ->leftJoin('kds', function($join) use ($rombel, $mapel) {
        //                                                     //     $join->on('kds.kode_kd', '=', 'nilais.kd_id')
        //                                                     //         ->where([
        //                                                     //             ['kds.tingkat', '=', $rombel->tingkat],
        //                                                     //             ['kds.mapel_id', '=', $mapel->kode_mapel]
        //                                                     //         ]);
        //                                                     // })->first();
        //     $datas[$mapel->kode_mapel]['maxK3']= 'App\Nilai'::where($cond)->where('nilais.nilai', $maxK3)->select('nilais.nilai', 'nilais.kd_id', 'kds.kode_kd', 'kds.teks_kd', 'kds.mapel_id')
        //                                                     ->leftJoin('kds', function($join) use ($rombel, $mapel) {
        //                                                         $join->on('kds.kode_kd', '=', 'nilais.kd_id')
        //                                                             ->where([
        //                                                                 ['kds.tingkat', '=', $rombel->tingkat],
        //                                                                 ['kds.mapel_id', '=', $mapel->kode_mapel]
        //                                                             ]);
        //                                                     })->first();
        //     $datas[$mapel->kode_mapel]['maxK4']= 'App\Nilai'::where($cond)->where('nilais.nilai', $maxK4)->select('nilais.nilai', 'nilais.kd_id', 'kds.kode_kd', 'kds.teks_kd', 'kds.mapel_id')
        //                                                     ->leftJoin('kds', function($join) use ($rombel, $mapel) {
        //                                                         $join->on('kds.kode_kd', '=', 'nilais.kd_id')
        //                                                             ->where([
        //                                                                 ['kds.tingkat', '=', $rombel->tingkat],
        //                                                                 ['kds.mapel_id', '=', $mapel->kode_mapel]
        //                                                             ]);
        //                                                     })->first();
                
        //     // $minK1 = 'App\Nilai'::where($cond)->where('nilais.kd_id', 'LIKE', '1.%')->where('nilais.mapel_id', '=', $mapel->kode_mapel)->min('nilais.nilai');
        //     // $minK2 = 'App\Nilai'::where($cond)->where('nilais.kd_id', 'LIKE', '2.%')->where('nilais.mapel_id', '=', $mapel->kode_mapel)->min('nilais.nilai');
        //     $minK3 = 'App\Nilai'::where($cond)->where('nilais.kd_id', 'LIKE', '3.%')->where('nilais.mapel_id', '=', $mapel->kode_mapel)->min('nilais.nilai');
        //     $minK4 = 'App\Nilai'::where($cond)->where('nilais.kd_id', 'LIKE', '4.%')->where('nilais.mapel_id', '=', $mapel->kode_mapel)->min('nilais.nilai');

        //     // $datas[$mapel->kode_mapel]['minK1']= 'App\Nilai'::where($cond)->where('nilais.nilai', $minK1)->select('nilais.nilai', 'nilais.kd_id', 'kds.kode_kd', 'kds.teks_kd', 'kds.mapel_id')
        //     //                                                 ->leftJoin('kds', function($join) use ($rombel, $mapel) {
        //     //                                                     $join->on('kds.kode_kd', '=', 'nilais.kd_id')
        //     //                                                         ->where([
        //     //                                                             ['kds.tingkat', '=', $rombel->tingkat],
        //     //                                                             ['kds.mapel_id', '=', $mapel->kode_mapel]
        //     //                                                         ]);
        //     //                                                 })->first();
        //     // $datas[$mapel->kode_mapel]['minK2']= 'App\Nilai'::where($cond)->where('nilais.nilai', $minK2)->select('nilais.nilai', 'nilais.kd_id', 'kds.kode_kd', 'kds.teks_kd', 'kds.mapel_id')
        //                                                     // ->leftJoin('kds', function($join) use ($rombel, $mapel) {
        //                                                     //     $join->on('kds.kode_kd', '=', 'nilais.kd_id')
        //                                                     //         ->where([
        //                                                     //             ['kds.tingkat', '=', $rombel->tingkat],
        //                                                     //             ['kds.mapel_id', '=', $mapel->kode_mapel]
        //                                                     //         ]);
        //                                                     // })->first();
        //     $datas[$mapel->kode_mapel]['minK3']= 'App\Nilai'::where($cond)->where('nilais.nilai', $minK3)->select('nilais.nilai', 'nilais.kd_id', 'kds.kode_kd', 'kds.teks_kd', 'kds.mapel_id')
        //                                                     ->leftJoin('kds', function($join) use ($rombel, $mapel) {
        //                                                         $join->on('kds.kode_kd', '=', 'nilais.kd_id')
        //                                                             ->where([
        //                                                                 ['kds.tingkat', '=', $rombel->tingkat],
        //                                                                 ['kds.mapel_id', '=', $mapel->kode_mapel]
        //                                                             ]);
        //                                                     })->first();
        //     $datas[$mapel->kode_mapel]['minK4']= 'App\Nilai'::where($cond)->where('nilais.nilai', $minK4)->select('nilais.nilai', 'nilais.kd_id', 'kds.kode_kd', 'kds.teks_kd', 'kds.mapel_id')
        //                                                     ->leftJoin('kds', function($join) use ($rombel, $mapel) {
        //                                                         $join->on('kds.kode_kd', '=', 'nilais.kd_id')
        //                                                             ->where([
        //                                                                 ['kds.tingkat', '=', $rombel->tingkat],
        //                                                                 ['kds.mapel_id', '=', $mapel->kode_mapel]
        //                                                             ]);
        //                                                     })->first();
                
        // }

        // // foreach($nilais as $nilai)
        // // {
        // //     // $datas[$nilai->mapel_id]['nilai'] = $nilai ?? '-';
        // //     if($datas[$nilai->mapel_id]) {
        // //         $datas[$nilai->mapel_id]['nilai'] = $nilai;
        // //     } else {
        // //         array_push($datas['nilai'], 'nilai');
        // //     }

        // // }


        // foreach($datas as $k=>$data)
        // {
        //     // echo $k.'<br>';
        //     foreach($nilais as $nilai)
        //     {
        //         // print_r($nilai);
        //         // echo '<br>';
        //         if($nilai->mapel_id == $k) {
        //             $datas[$k]['nilai'] = $nilai;
        //             // array_push($datas[$k], ['nilai' => (Object) $nilai]);
        //         } 
        //         // else {
        //         //     $datas[$k]['nilai'] =   (Object) ['mapel_id' => $k, 'n_k1' => null, 'n_k2' => null, 'n_k3' => null, 'n_k4' => null, ];
        //         //     // array_push($datas[$k], ['nilai' => (Object) ['mapel_id' => $k, 'n_k1' => null, 'n_k2' => null, 'n_k3' => null, 'n_k4' => null, ]]);
        //         //  }
        //     }
        // }

        // $cek = DB::select('SELECT n.kd_id, FROM nilais n WHERE n.mapel_id = ? AND n.siswa_id = ? AND n.semester = ? AND n.periode = ? AND n.kd_id LIKE ? AND n.nilai = (
        //     "SELECT MAX(m.nilai) FORM nilais m WHERE m.mapel_id = "pabp" AND m.siswa_id = "$nisn" AND m.semester = "$nisn" AND m.periode = "uh" AND m.kd_id LIKE "3.%"
        // )', 
        //                 ['pabp', $nisn, $semester, 'uh', '3.%']);
        
        // $cek = 'App\Nilai'::where($cond)->max('nilais.nilai');
        // $kd = 'App\Nilai'::where($cond)->where('nilais.nilai', $cek)->select('nilais.nilai','nilais.kd_id', 'kds.kode_kd', 'kds.teks_kd')
        //     ->leftJoin('kds', function($join) use ($rombel){
        //         $join->on('kds.kode_kd', '=', 'nilais.kd_id')
        //             ->where([
        //                 ['kds.tingkat', '=', $rombel->tingkat],
        //                 ['kds.mapel_id', '=', 'pabp']
        //             ])
        //         ;
        //     })
        //     ->first();

        // dd($nilais, $datas);
        //     foreach($nilais as $k=>$nilai)
        //     {
        //         print_r($nilais[$k]);
        //         echo '<hr>';
        //     }
        //     dd('hi');
        return $nilais;
    }
}