
<div class="card">
    <div class="card-header outlined">
        <h4>
            <i class="mdi mdi-book"></i>
            Rekap Nilai
        </h4>
        <div class="d-flex float-left">
            
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a href="#rekapnilaik34" class="nav-link active" data-toggle="tab">Rekap Nilai K3 dan K4</a>
                    </li>
                    <li class="nav-item">
                        <a href="#rekapnilaik12" class="nav-link" data-toggle="tab">Rekap Nilai K1 dan K2</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="rekapnilaik34">
                        <div class="container-fluid">
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center p-2" rowspan="4" style="vertical-align:middle;">No</th>
                                            <th class="text-center p-2" rowspan="4" style="vertical-align:middle;">NISN</th>
                                            <th class="text-center p-2" rowspan="4" style="vertical-align:middle;">Nama</th>
                                            <th class="text-center p-2" colspan="{{ (Session::get('rombel')->tingkat > 3)? 60 : 48 }}">Nilai</th>
                                        </tr>
                                        <tr>
                                            <th colspan="6" class="text-center p-2">PABP</th>
                                            <th colspan="6" class="text-center p-2">PPKN</th>
                                            <th colspan="6" class="text-center p-2">B. IND</th>
                                            <th colspan="6" class="text-center p-2">MTK</th>
                                            @if(Session::get('rombel')->tingkat > 4)
                                                <th colspan="6" class="text-center p-2">IPA</th>
                                                <th colspan="6" class="text-center p-2">IPS</th>
                                            @endif
                                            <th colspan="6" class="text-center p-2">SBDP</th>
                                            <th colspan="6" class="text-center p-2">PJOK</th>
                                            <th colspan="6" class="text-center p-2">B. ING</th>
                                            <th colspan="6" class="text-center p-2">B. JAWA</th>
                                        </tr>
                                        <tr>
                                            {{-- PABP --}}
                                            <th class="text-center p-2" colspan="2">NH</th>
                                            <th class="text-center p-2" colspan="2">PTS</th>
                                            <th class="text-center p-2" colspan="2">PAS</th>
                                            {{-- PKN --}}
                                            <th class="text-center p-2" colspan="2">NH</th>
                                            <th class="text-center p-2" colspan="2">PTS</th>
                                            <th class="text-center p-2" colspan="2">PAS</th>
                                            {{-- BID --}}
                                            <th class="text-center p-2" colspan="2">NH</th>
                                            <th class="text-center p-2" colspan="2">PTS</th>
                                            <th class="text-center p-2" colspan="2">PAS</th>
                                            {{-- MTK --}}
                                            <th class="text-center p-2" colspan="2">NH</th>
                                            <th class="text-center p-2" colspan="2">PTS</th>
                                            <th class="text-center p-2" colspan="2">PAS</th>
                                            @if(Session::get('rombel')->tingkat > 3)
                                            {{-- IPA --}}
                                                <th class="text-center p-2" colspan="2">NH</th>
                                                <th class="text-center p-2" colspan="2">PTS</th>
                                                <th class="text-center p-2" colspan="2">PAS</th>
                                                {{-- IPS --}}
                                                <th class="text-center p-2" colspan="2">NH</th>
                                                <th class="text-center p-2" colspan="2">PTS</th>
                                                <th class="text-center p-2" colspan="2">PAS</th>
                                            @endif
                                            {{-- SBDP --}}
                                            <th class="text-center p-2" colspan="2">NH</th>
                                            <th class="text-center p-2" colspan="2">PTS</th>
                                            <th class="text-center p-2" colspan="2">PAS</th>
                                            {{-- PJOK --}}
                                            <th class="text-center p-2" colspan="2">NH</th>
                                            <th class="text-center p-2" colspan="2">PTS</th>
                                            <th class="text-center p-2" colspan="2">PAS</th>
                                            {{-- BIG --}}
                                            <th class="text-center p-2" colspan="2">NH</th>
                                            <th class="text-center p-2" colspan="2">PTS</th>
                                            <th class="text-center p-2" colspan="2">PAS</th>
                                            {{-- B.JW --}}
                                            <th class="text-center p-2" colspan="2">NH</th>
                                            <th class="text-center p-2" colspan="2">PTS</th>
                                            <th class="text-center p-2" colspan="2">PAS</th>
                                        </tr>
                                        <tr>
                                            {{-- PABP --}}
                                            <th class="text-center p-2">K3</th>
                                            <th class="text-center p-2">K4</th>
                                            <th class="text-center p-2">K3</th>
                                            <th class="text-center p-2">K4</th>
                                            <th class="text-center p-2">K3</th>
                                            <th class="text-center p-2">K4</th>
                                            {{-- PKN --}}
                                            <th class="text-center p-2">K3</th>
                                            <th class="text-center p-2">K4</th>
                                            <th class="text-center p-2">K3</th>
                                            <th class="text-center p-2">K4</th>
                                            <th class="text-center p-2">K3</th>
                                            <th class="text-center p-2">K4</th>

                                            {{-- BID --}}
                                            <th class="text-center p-2">K3</th>
                                            <th class="text-center p-2">K4</th>
                                            <th class="text-center p-2">K3</th>
                                            <th class="text-center p-2">K4</th>
                                            <th class="text-center p-2">K3</th>
                                            <th class="text-center p-2">K4</th>

                                            {{-- MTK --}}
                                            <th class="text-center p-2">K3</th>
                                            <th class="text-center p-2">K4</th>
                                            <th class="text-center p-2">K3</th>
                                            <th class="text-center p-2">K4</th>
                                            <th class="text-center p-2">K3</th>
                                            <th class="text-center p-2">K4</th>
                                            @if(Session::get('rombel')->tingka > 3)
                                                {{-- IPA --}}
                                                <th class="text-center p-2">K3</th>
                                                <th class="text-center p-2">K4</th>
                                                <th class="text-center p-2">K3</th>
                                                <th class="text-center p-2">K4</th>
                                                <th class="text-center p-2">K3</th>
                                                <th class="text-center p-2">K4</th>
                                                {{-- IPS --}}
                                                <th class="text-center p-2">K3</th>
                                                <th class="text-center p-2">K4</th>
                                                <th class="text-center p-2">K3</th>
                                                <th class="text-center p-2">K4</th>
                                                <th class="text-center p-2">K3</th>
                                                <th class="text-center p-2">K4</th>
                                            @endif
                                            {{-- SBDP --}}
                                            <th class="text-center p-2">K3</th>
                                            <th class="text-center p-2">K4</th>
                                            <th class="text-center p-2">K3</th>
                                            <th class="text-center p-2">K4</th>
                                            <th class="text-center p-2">K3</th>
                                            <th class="text-center p-2">K4</th>

                                            {{-- PJOK --}}
                                            <th class="text-center p-2">K3</th>
                                            <th class="text-center p-2">K4</th>
                                            <th class="text-center p-2">K3</th>
                                            <th class="text-center p-2">K4</th>
                                            <th class="text-center p-2">K3</th>
                                            <th class="text-center p-2">K4</th>

                                            {{-- MULOK --}}
                                                {{-- BIG --}}
                                                <th class="text-center p-2">K3</th>
                                                <th class="text-center p-2">K4</th>
                                                <th class="text-center p-2">K3</th>
                                                <th class="text-center p-2">K4</th>
                                                <th class="text-center p-2">K3</th>
                                                <th class="text-center p-2">K4</th>
                                                {{-- BJ --}}
                                                <th class="text-center p-2">K3</th>
                                                <th class="text-center p-2">K4</th>
                                                <th class="text-center p-2">K3</th>
                                                <th class="text-center p-2">K4</th>
                                                <th class="text-center p-2">K3</th>
                                                <th class="text-center p-2">K4</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    {{ $kkm = 75 }}
                                        @foreach($nilaik34 as $siswa)
                                            <tr>
                                                <td class="text-center p-2">{{ ($loop->index +$nilaik34->firstItem() ) }}</td>
                                                <td class="text-center p-2">{{ $siswa->nisn }}</td>
                                                <td class="text-left p-2">{{ $siswa->nama_siswa }}</td>
                                                {{-- PABP --}}
                                                <td class="text-center p-2 {{ ($siswa->k3_pabp_uh == null || (int) $siswa->k3_pabp_uh < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k3_pabp_uh != null) ? $siswa->k3_pabp_uh : '-' }}</td>
                                                <td class="text-center p-2 {{ ($siswa->k4_pabp_uh == null || (int) $siswa->k4_pabp_uh < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k4_pabp_uh != null) ? $siswa->k4_pabp_uh : '-' }}</td>
                                                <td class="text-center p-2 {{ ($siswa->k3_pabp_pts == null || (int) $siswa->k3_pabp_pts < $kkm) ? 'text-danger' : '' }}">{{ ($siswa->k3_pabp_pts != null) ? $siswa->k3_pabp_pts : '-' }}</td>
                                                <td class="text-center p-2 {{ ($siswa->k4_pabp_pts == null || (int) $siswa->k4_pabp_pts < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k4_pabp_pts != null) ? $siswa->k4_pabp_pts : '-' }}</td>
                                                <td class="text-center p-2 {{ ($siswa->k3_pabp_pas == null || (int) $siswa->k3_pabp_pas < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k3_pabp_pas != null)? $siswa->k3_pabp_pas : '-' }}</td>
                                                <td class="text-center p-2 {{  ($siswa->k4_pabp_pas == null || (int) $siswa->k4_pabp_pas < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k4_pabp_pas != null) ? $siswa->k4_pabp_pas : '-' }}</td>
                                                {{-- PKN --}}
                                                <td class="text-center p-2 {{ ($siswa->k3_pkn_uh == null || (int) $siswa->k3_pkn_uh < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k3_pkn_uh != null) ? $siswa->k3_pkn_uh : '-' }}</td>
                                                <td class="text-center p-2 {{ ($siswa->k4_pkn_uh == null || (int) $siswa->k4_pkn_uh < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k4_pkn_uh != null) ? $siswa->k4_pkn_uh : '-' }}</td>
                                                <td class="text-center p-2 {{ ($siswa->k3_pkn_pts == null || (int) $siswa->k3_pkn_pts < $kkm) ? 'text-danger' : '' }}">{{ /*($siswa->k3_pkn_pts != null) ? $siswa->k3_pkn_pts : '-'*/ $siswa->k3_pkn_pts }}</td>
                                                <td class="text-center p-2 {{ ($siswa->k4_pkn_pts == null || (int) $siswa->k4_pkn_pts < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k4_pkn_pts != null) ? $siswa->k4_pkn_pts : '-' }}</td>
                                                <td class="text-center p-2 {{ ($siswa->k3_pkn_pas == null || (int) $siswa->k3_pkn_pas < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k3_pkn_pas != null)? $siswa->k3_pkn_pas : '-' }}</td>
                                                <td class="text-center p-2 {{  ($siswa->k4_pkn_pas == null || (int) $siswa->k4_pkn_pas < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k4_pkn_pas != null) ? $siswa->k4_pkn_pas : '-' }}</td>
                                                {{--BID --}}
                                                <td class="text-center p-2 {{ ($siswa->k3_bid_uh == null || (int) $siswa->k3_bid_uh < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k3_bid_uh != null) ? $siswa->k3_bid_uh : '-' }}</td>
                                                <td class="text-center p-2 {{ ($siswa->k4_bid_uh == null || (int) $siswa->k4_bid_uh < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k4_bid_uh != null) ? $siswa->k4_bid_uh : '-' }}</td>
                                                <td class="text-center p-2 {{ ($siswa->k3_bid_pts == null || (int) $siswa->k3_bid_pts < $kkm) ? 'text-danger' : '' }}">{{ ($siswa->k3_bid_pts != null) ? $siswa->k3_bid_pts : '-' }}</td>
                                                <td class="text-center p-2 {{ ($siswa->k4_bid_pts == null || (int) $siswa->k4_bid_pts < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k4_bid_pts != null) ? $siswa->k4_bid_pts : '-' }}</td>
                                                <td class="text-center p-2 {{ ($siswa->k3_bid_pas == null || (int) $siswa->k3_bid_pas < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k3_bid_pas != null)? $siswa->k3_bid_pas : '-' }}</td>
                                                <td class="text-center p-2 {{  ($siswa->k4_bid_pas == null || (int) $siswa->k4_bid_pas < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k4_bid_pas != null) ? $siswa->k4_bid_pas : '-' }}</td>

                                                {{-- MTK --}}
                                                <td class="text-center p-2 {{ ($siswa->k3_mtk_uh == null || (int) $siswa->k3_mtk_uh < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k3_mtk_uh != null) ? $siswa->k3_mtk_uh : '-' }}</td>
                                                <td class="text-center p-2 {{ ($siswa->k4_mtk_uh == null || (int) $siswa->k4_mtk_uh < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k4_mtk_uh != null) ? $siswa->k4_mtk_uh : '-' }}</td>
                                                <td class="text-center p-2 {{ ($siswa->k3_mtk_pts == null || (int) $siswa->k3_mtk_pts < $kkm) ? 'text-danger' : '' }}">{{ ($siswa->k3_mtk_pts != null) ? $siswa->k3_mtk_pts : '-' }}</td>
                                                <td class="text-center p-2 {{ ($siswa->k4_mtk_pts == null || (int) $siswa->k4_mtk_pts < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k4_mtk_pts != null) ? $siswa->k4_mtk_pts : '-' }}</td>
                                                <td class="text-center p-2 {{ ($siswa->k3_mtk_pas == null || (int) $siswa->k3_mtk_pas < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k3_mtk_pas != null)? $siswa->k3_mtk_pas : '-' }}</td>
                                                <td class="text-center p-2 {{  ($siswa->k4_mtk_pas == null || (int) $siswa->k4_mtk_pas < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k4_mtk_pas != null) ? $siswa->k4_mtk_pas : '-' }}</td>

                                                @if(Session::get('rombel')->tingkat > 3)
                                                    {{-- IPA --}}
                                                    <td class="text-center p-2 {{ ($siswa->k3_ipa_uh == null || (int) $siswa->k3_ipa_uh < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k3_ipa_uh != null) ? $siswa->k3_ipa_uh : '-' }}</td>
                                                    <td class="text-center p-2 {{ ($siswa->k4_ipa_uh == null || (int) $siswa->k4_ipa_uh < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k4_ipa_uh != null) ? $siswa->k4_ipa_uh : '-' }}</td>
                                                    <td class="text-center p-2 {{ ($siswa->k3_ipa_pts == null || (int) $siswa->k3_ipa_pts < $kkm) ? 'text-danger' : '' }}">{{ ($siswa->k3_ipa_pts != null) ? $siswa->k3_ipa_pts : '-' }}</td>
                                                    <td class="text-center p-2 {{ ($siswa->k4_ipa_pts == null || (int) $siswa->k4_ipa_pts < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k4_ipa_pts != null) ? $siswa->k4_ipa_pts : '-' }}</td>
                                                    <td class="text-center p-2 {{ ($siswa->k3_ipa_pas == null || (int) $siswa->k3_ipa_pas < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k3_ipa_pas != null)? $siswa->k3_ipa_pas : '-' }}</td>
                                                    <td class="text-center p-2 {{  ($siswa->k4_ipa_pas == null || (int) $siswa->k4_ipa_pas < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k4_ipa_pas != null) ? $siswa->k4_ipa_pas : '-' }}</td>
                                                    {{-- IPS --}}
                                                    <td class="text-center p-2 {{ ($siswa->k3_ips_uh == null || (int) $siswa->k3_ips_uh < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k3_ips_uh != null) ? $siswa->k3_ips_uh : '-' }}</td>
                                                    <td class="text-center p-2 {{ ($siswa->k4_ips_uh == null || (int) $siswa->k4_ips_uh < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k4_ips_uh != null) ? $siswa->k4_ips_uh : '-' }}</td>
                                                    <td class="text-center p-2 {{ ($siswa->k3_ips_pts == null || (int) $siswa->k3_ips_pts < $kkm) ? 'text-danger' : '' }}">{{ ($siswa->k3_ips_pts != null) ? $siswa->k3_ips_pts : '-' }}</td>
                                                    <td class="text-center p-2 {{ ($siswa->k4_ips_pts == null || (int) $siswa->k4_ips_pts < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k4_ips_pts != null) ? $siswa->k4_ips_pts : '-' }}</td>
                                                    <td class="text-center p-2 {{ ($siswa->k3_ips_pas == null || (int) $siswa->k3_ips_pas < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k3_ips_pas != null)? $siswa->k3_ips_pas : '-' }}</td>
                                                    <td class="text-center p-2 {{  ($siswa->k4_ips_pas == null || (int) $siswa->k4_ips_pas < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k4_ips_pas != null) ? $siswa->k4_ips_pas : '-' }}</td>
                                                @endif
                                                {{-- SBDP --}}
                                                <td class="text-center p-2 {{ ($siswa->k3_sbdp_uh == null || (int) $siswa->k3_sbdp_uh < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k3_sbdp_uh != null) ? $siswa->k3_sbdp_uh : '-' }}</td>
                                                <td class="text-center p-2 {{ ($siswa->k4_sbdp_uh == null || (int) $siswa->k4_sbdp_uh < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k4_sbdp_uh != null) ? $siswa->k4_sbdp_uh : '-' }}</td>
                                                <td class="text-center p-2 {{ ($siswa->k3_sbdp_pts == null || (int) $siswa->k3_sbdp_pts < $kkm) ? 'text-danger' : '' }}">{{ ($siswa->k3_sbdp_pts != null) ? $siswa->k3_sbdp_pts : '-' }}</td>
                                                <td class="text-center p-2 {{ ($siswa->k4_sbdp_pts == null || (int) $siswa->k4_sbdp_pts < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k4_sbdp_pts != null) ? $siswa->k4_sbdp_pts : '-' }}</td>
                                                <td class="text-center p-2 {{ ($siswa->k3_sbdp_pas == null || (int) $siswa->k3_sbdp_pas < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k3_sbdp_pas != null)? $siswa->k3_sbdp_pas : '-' }}</td>
                                                <td class="text-center p-2 {{  ($siswa->k4_sbdp_pas == null || (int) $siswa->k4_sbdp_pas < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k4_sbdp_pas != null) ? $siswa->k4_sbdp_pas : '-' }}</td>
                                                {{-- PJOK --}}
                                                <td class="text-center p-2 {{ ($siswa->k3_pjok_uh == null || (int) $siswa->k3_pjok_uh < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k3_pjok_uh != null) ? $siswa->k3_pjok_uh : '-' }}</td>
                                                <td class="text-center p-2 {{ ($siswa->k4_pjok_uh == null || (int) $siswa->k4_pjok_uh < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k4_pjok_uh != null) ? $siswa->k4_pjok_uh : '-' }}</td>
                                                <td class="text-center p-2 {{ ($siswa->k3_pjok_pts == null || (int) $siswa->k3_pjok_pts < $kkm) ? 'text-danger' : '' }}">{{ ($siswa->k3_pjok_pts != null) ? $siswa->k3_pjok_pts : '-' }}</td>
                                                <td class="text-center p-2 {{ ($siswa->k4_pjok_pts == null || (int) $siswa->k4_pjok_pts < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k4_pjok_pts != null) ? $siswa->k4_pjok_pts : '-' }}</td>
                                                <td class="text-center p-2 {{ ($siswa->k3_pjok_pas == null || (int) $siswa->k3_pjok_pas < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k3_pjok_pas != null)? $siswa->k3_pjok_pas : '-' }}</td>
                                                <td class="text-center p-2 {{  ($siswa->k4_pjok_pas == null || (int) $siswa->k4_pjok_pas < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k4_pjok_pas != null) ? $siswa->k4_pjok_pas : '-' }}</td>
                                                {{-- MULOK --}}
                                                    {{-- BIG --}}
                                                    <td class="text-center p-2 {{ ($siswa->k3_big_uh == null || (int) $siswa->k3_big_uh < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k3_big_uh != null) ? $siswa->k3_big_uh : '-' }}</td>
                                                <td class="text-center p-2 {{ ($siswa->k4_big_uh == null || (int) $siswa->k4_big_uh < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k4_big_uh != null) ? $siswa->k4_big_uh : '-' }}</td>
                                                <td class="text-center p-2 {{ ($siswa->k3_big_pts == null || (int) $siswa->k3_big_pts < $kkm) ? 'text-danger' : '' }}">{{ ($siswa->k3_big_pts != null) ? $siswa->k3_big_pts : '-' }}</td>
                                                <td class="text-center p-2 {{ ($siswa->k4_big_pts == null || (int) $siswa->k4_big_pts < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k4_big_pts != null) ? $siswa->k4_big_pts : '-' }}</td>
                                                <td class="text-center p-2 {{ ($siswa->k3_big_pas == null || (int) $siswa->k3_big_pas < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k3_big_pas != null)? $siswa->k3_big_pas : '-' }}</td>
                                                <td class="text-center p-2 {{  ($siswa->k4_big_pas == null || (int) $siswa->k4_big_pas < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k4_big_pas != null) ? $siswa->k4_big_pas : '-' }}</td>
                                                    {{-- BJ --}}
                                                    <td class="text-center p-2 {{ ($siswa->k3_bd_uh == null || (int) $siswa->k3_bd_uh < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k3_bd_uh != null) ? $siswa->k3_bd_uh : '-' }}</td>
                                                <td class="text-center p-2 {{ ($siswa->k4_bd_uh == null || (int) $siswa->k4_bd_uh < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k4_bd_uh != null) ? $siswa->k4_bd_uh : '-' }}</td>
                                                <td class="text-center p-2 {{ ($siswa->k3_bd_pts == null || (int) $siswa->k3_bd_pts < $kkm) ? 'text-danger' : '' }}">{{ ($siswa->k3_bd_pts != null) ? $siswa->k3_bd_pts : '-' }}</td>
                                                <td class="text-center p-2 {{ ($siswa->k4_bd_pts == null || (int) $siswa->k4_bd_pts < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k4_bd_pts != null) ? $siswa->k4_bd_pts : '-' }}</td>
                                                <td class="text-center p-2 {{ ($siswa->k3_bd_pas == null || (int) $siswa->k3_bd_pas < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k3_bd_pas != null)? $siswa->k3_bd_pas : '-' }}</td>
                                                <td class="text-center p-2 {{  ($siswa->k4_bd_pas == null || (int) $siswa->k4_bd_pas < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k4_bd_pas != null) ? $siswa->k4_bd_pas : '-' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    
                                </table>
                                
                            </div>
                            <div class="">Jml Siswa: {{ $nilaik34->count() }} dari {{ $nilaik34->total() }} Orang</div>
                            <div class="float-right">{{ $nilaik34->links() }}</div>
                        </div>
                    </div>
                    <div class="tab-pane" id="rekapnilaik12">
                        <div class="container-fluid">
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center p-2" rowspan="4" style="vertical-align:middle;">No</th>
                                            <th class="text-center p-2" rowspan="4" style="vertical-align:middle;">NISN</th>
                                            <th class="text-center p-2" rowspan="4" style="vertical-align:middle;">Nama</th>
                                            <th class="text-center p-2" colspan="12" >Nilai Sikap Spiritual</th>
                                            <th class="text-center p-2" colspan="18" >Nilai Sikap Sosial</th>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="text-center p-2">1.1</th>
                                            <th colspan="3" class="text-center p-2">1.2</th>
                                            <th colspan="3" class="text-center p-2">1.3</th>
                                            <th colspan="3" class="text-center p-2">1.4</th>
                                            {{-- k2 --}}
                                            <th colspan="3" class="text-center p-2">2.1</th>
                                            <th colspan="3" class="text-center p-2">2.2</th>
                                            <th colspan="3" class="text-center p-2">2.3</th>
                                            <th colspan="3" class="text-center p-2">2.4</th>
                                            <th colspan="3" class="text-center p-2">2.5</th>
                                            <th colspan="3" class="text-center p-2">2.6</th>
                                        </tr>
                                        <tr>
                                            {{-- k1 --}}
                                            <th class="text-center p-2" >NH</th>
                                            <th class="text-center p-2" >PTS</th>
                                            <th class="text-center p-2" >PAS</th>
                                            <th class="text-center p-2" >NH</th>
                                            <th class="text-center p-2" >PAS</th>
                                            <th class="text-center p-2" >PTS</th>
                                            <th class="text-center p-2" >NH</th>
                                            <th class="text-center p-2" >PTS</th>
                                            <th class="text-center p-2" >PAS</th>
                                            <th class="text-center p-2" >NH</th>
                                            <th class="text-center p-2" >PTS</th>
                                            <th class="text-center p-2" >PAS</th>
                                            {{-- k2 --}}
                                            <th class="text-center p-2" >NH</th>
                                            <th class="text-center p-2" >PTS</th>
                                            <th class="text-center p-2" >PAS</th>
                                            <th class="text-center p-2" >NH</th>
                                            <th class="text-center p-2" >PAS</th>
                                            <th class="text-center p-2" >PTS</th>
                                            <th class="text-center p-2" >NH</th>
                                            <th class="text-center p-2" >PTS</th>
                                            <th class="text-center p-2" >PAS</th>
                                            <th class="text-center p-2" >NH</th>
                                            <th class="text-center p-2" >PTS</th>
                                            <th class="text-center p-2" >PAS</th>
                                            <th class="text-center p-2" >NH</th>
                                            <th class="text-center p-2" >PTS</th>
                                            <th class="text-center p-2" >PAS</th>
                                            <th class="text-center p-2" >NH</th>
                                            <th class="text-center p-2" >PTS</th>
                                            <th class="text-center p-2" >PAS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    {{ $kkm = 75 }}
                                        @foreach($nilaik12 as $siswa)
                                            <tr>
                                                <td class="text-center p-2">{{ ($loop->index +$nilaik12->firstItem() ) }}</td>
                                                <td class="text-center p-2">{{ $siswa->nisn }}</td>
                                                <td class="text-left p-2">{{ $siswa->nama_siswa }}</td>
                                                {{-- 1.1 --}}
                                                <td class=text-center p-2 {{  ($siswa->k1_11_uh == null || (int) $siswa->k1_11_uh < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k1_11_uh != null) ? round($siswa->k1_11_uh) : '-' }}</td>
                                                <td class=text-center p-2 {{  ($siswa->k1_11_pts == null || (int) $siswa->k1_11_pts < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k1_11_pts != null) ? round($siswa->k1_11_pts) : '-' }}</td>
                                                <td class=text-center p-2 {{  ($siswa->k1_11_pas == null || (int) $siswa->k1_11_pas < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k1_11_pas != null) ? round($siswa->k1_11_pas) : '-' }}</td>
                                                {{-- 1.2 --}}
                                                <td class=text-center p-2 {{  ($siswa->k1_12_uh == null || (int) $siswa->k1_12_uh < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k1_12_uh != null) ? round($siswa->k1_12_uh) : '-' }}</td>
                                                <td class=text-center p-2 {{  ($siswa->k1_12_pts == null || (int) $siswa->k1_12_pts < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k1_12_pts != null) ? round($siswa->k1_12_pts) : '-' }}</td>
                                                <td class=text-center p-2 {{  ($siswa->k1_12_pas == null || (int) $siswa->k1_12_pas < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k1_12_pas != null) ? round($siswa->k1_12_pas) : '-' }}</td>
                                                {{-- 1.3 --}}
                                                <td class=text-center p-2 {{  ($siswa->k1_13_uh == null || (int) $siswa->k1_13_uh < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k1_13_uh != null) ? round($siswa->k1_13_uh) : '-' }}</td>
                                                <td class=text-center p-2 {{  ($siswa->k1_13_pts == null || (int) $siswa->k1_13_pts < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k1_13_pts != null) ? round($siswa->k1_13_pts) : '-' }}</td>
                                                <td class=text-center p-2 {{  ($siswa->k1_13_pas == null || (int) $siswa->k1_13_pas < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k1_13_pas != null) ? round($siswa->k1_13_pas) : '-' }}</td>
                                                {{-- 1.4 --}}
                                                <td class=text-center p-2 {{  ($siswa->k1_14_uh == null || (int) $siswa->k1_14_uh < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k1_14_uh != null) ? round($siswa->k1_14_uh) : '-' }}</td>
                                                <td class=text-center p-2 {{  ($siswa->k1_14_pts == null || (int) $siswa->k1_14_pts < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k1_14_pts != null) ? round($siswa->k1_14_pts) : '-' }}</td>
                                                <td class=text-center p-2 {{  ($siswa->k1_14_pas == null || (int) $siswa->k1_14_pas < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k1_14_pas != null) ? round($siswa->k1_14_pas) : '-' }}</td>
                                                {{-- KI 2 --}}

                                                {{-- 2.1 --}}
                                                <td class=text-center p-2 {{  ($siswa->k2_21_uh == null || (int) $siswa->k2_21_uh < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k2_21_uh != null) ? round($siswa->k2_21_uh) : '-' }}</td>
                                                <td class=text-center p-2 {{  ($siswa->k2_21_pts == null || (int) $siswa->k2_21_pts < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k2_21_pts != null) ? round($siswa->k2_21_pts) : '-' }}</td>
                                                <td class=text-center p-2 {{  ($siswa->k2_21_pas == null || (int) $siswa->k2_21_pas < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k2_21_pas != null) ? round($siswa->k2_21_pas) : '-' }}</td>
                                                {{-- 2.2 --}}
                                                <td class=text-center p-2 {{  ($siswa->k2_22_uh == null || (int) $siswa->k2_22_uh < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k2_22_uh != null) ? round($siswa->k2_22_uh) : '-' }}</td>
                                                <td class=text-center p-2 {{  ($siswa->k2_22_pts == null || (int) $siswa->k2_22_pts < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k2_22_pts != null) ? round($siswa->k2_22_pts) : '-' }}</td>
                                                <td class=text-center p-2 {{  ($siswa->k2_22_pas == null || (int) $siswa->k2_22_pas < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k2_22_pas != null) ? round($siswa->k2_22_pas) : '-' }}</td>
                                                {{-- 2.3 --}}
                                                <td class=text-center p-2 {{  ($siswa->k2_23_uh == null || (int) $siswa->k2_23_uh < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k2_23_uh != null) ? round($siswa->k2_23_uh) : '-' }}</td>
                                                <td class=text-center p-2 {{  ($siswa->k2_23_pts == null || (int) $siswa->k2_23_pts < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k2_23_pts != null) ? round($siswa->k2_23_pts) : '-' }}</td>
                                                <td class=text-center p-2 {{  ($siswa->k2_23_pas == null || (int) $siswa->k2_23_pas < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k2_23_pas != null) ? round($siswa->k2_23_pas) : '-' }}</td>
                                                {{-- 2.4 --}}
                                                <td class=text-center p-2 {{  ($siswa->k2_24_uh == null || (int) $siswa->k2_24_uh < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k2_24_uh != null) ? round($siswa->k2_24_uh) : '-' }}</td>
                                                <td class=text-center p-2 {{  ($siswa->k2_24_pts == null || (int) $siswa->k2_24_pts < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k2_24_pts != null) ? round($siswa->k2_24_pts) : '-' }}</td>
                                                <td class=text-center p-2 {{  ($siswa->k2_24_pas == null || (int) $siswa->k2_24_pas < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k2_24_pas != null) ? round($siswa->k2_24_pas) : '-' }}</td>
                                                {{-- 2.5 --}}
                                                <td class=text-center p-2 {{  ($siswa->k2_25_uh == null || (int) $siswa->k2_25_uh < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k2_25_uh != null) ? round($siswa->k2_25_uh) : '-' }}</td>
                                                <td class=text-center p-2 {{  ($siswa->k2_25_pts == null || (int) $siswa->k2_25_pts < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k2_25_pts != null) ? round($siswa->k2_25_pts) : '-' }}</td>
                                                <td class=text-center p-2 {{  ($siswa->k2_25_pas == null || (int) $siswa->k2_25_pas < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k2_25_pas != null) ? round($siswa->k2_25_pas) : '-' }}</td>
                                                {{-- 2.6 --}}
                                                <td class=text-center p-2 {{  ($siswa->k2_26_uh == null || (int) $siswa->k2_26_uh < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k2_26_uh != null) ? round($siswa->k2_26_uh) : '-' }}</td>
                                                <td class=text-center p-2 {{  ($siswa->k2_26_pts == null || (int) $siswa->k2_26_pts < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k2_26_pts != null) ? round($siswa->k2_26_pts) : '-' }}</td>
                                                <td class=text-center p-2 {{  ($siswa->k2_26_pas == null || (int) $siswa->k2_26_pas < $kkm) ? 'text-danger': '' }}">{{ ($siswa->k2_26_pas != null) ? round($siswa->k2_26_pas) : '-' }}</td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                    
                                </table>
                                
                            </div>
                            <div class="">Jml Siswa: {{ $nilaik12->count() }} dari {{ $nilaik12->total() }} Orang</div>
                            <div class="float-right">{{ $nilaik12->links() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
