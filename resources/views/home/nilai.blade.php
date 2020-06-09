
<div class="card">
    <div class="card-header outlined">
        <h4>
            <i class="mdi mdi-book"></i>
            Buku Nilai
        </h4>
        <div class="d-flex float-left">
            <button class="btn btn-outlined btn-dark btn-flat" id="btnTambahSiswa">Tambah</button>
            <button class="btn btn-outlined btn-dark btn-flat" id="btnResetPassword">Reset Password</button>
            <button class="btn btn-outlined btn-dark btn-flat" id="btnImpor" data-toggle="modal" data-target="#modalImpor" data-impor="siswa">Impor</button>
            <button class="btn btn-outlined btn-dark btn-flat" id="btnEksporSiswa">Ekspor</button>
            <button class="btn btn-outlined btn-dark btn-flat" id="btnCetakSiswa">Cetak</button>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-2">
                <select name="semester" id="semester" class="form-control selSemester">
                    <option value="0">--Semester--</option>
                </select>
            </div>
            <div class="col-sm-1">
                <select name="periode" id="periode" class="form-control selPeriode">
                    <option value="0">--Periode--</option>
                    <option value="harian">Harian</option>
                    <option value="pts">PTS</option>
                    <option value="pas">PAS</option>
                </select>
            </div>
            <div class="col-sm-2">
                <select name="kompetensi" id="kompetensi" class="form-control selKompetensi">
                    <option value="0">--Kompetensi--</option>
                    <option value="k1">Spiritual</option>
                    <option value="k2">Sosial</option>
                    <option value="k3">Pengetahuan</option>
                    <option value="k4">Keterampilan</option>
                </select>
            </div>

            <div class="col-sm-2">
                <select name="format" id="format" class="form-control selFormat">
                    <option value="0">--Format--</option>
                    <option value="ob">Observasi</option>
                    <option value="pd">Penilaian Diri</option>
                    <option value="at">Antar Teman</option>
                    <option value="ul">Ulangan Tulis</option>
                    <option value="ls">Ulangan Lisan</option>
                    <option value="tg">Tugas</option>
                    <option value="prk">Praktek</option>
                    <option value="prj">Proyek</option>
                    <option value="port">Portofolio</option>
                </select>
            </div>
            <div class="col-sm-1">
                <select name="mapel" id="mapel" class="form-control selMapel">
                    <option value="0">--Mapel--</option>
                </select>
            </div>
            <div class="col-sm-1">
                <select name="rombel" id="rombel" class="form-control selRombel">
                    <option value="0">--Rombel--</option>
                </select>
            </div>
            <div class="col-sm-1">
                <select name="kd" id="kd" class="form-control selKD">
                    <option value="0">-- KD --</option>
                </select>
            </div>
            <div class="col-sm-2">
                <button class="btn btn-primary btn-sm" id="btnViewNilai">
                    Lihat Nilai
                </button>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Penilaian</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered" id="table-nilai">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIS</th>
                                        <th>Nama</th>
                                        <th>Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
