
<div class="card">
    <div class="card-header outlined">
        <h4>
            <i class="mdi mdi-human-child"></i>
            Data Siswa
        </h4>
        <div class="d-flex float-left">
            {{-- <button class="btn btn-outlined btn-dark btn-flat" id="btnTambahSiswa">Tambah</button>
            <button class="btn btn-outlined btn-dark btn-flat" id="btnResetPassword">Reset Password</button> --}}
            {{-- <button class="btn btn-outlined btn-dark btn-flat" id="btnImpor" data-toggle="modal" data-target="#modalImpor" data-impor="siswa">Impor</button> --}}
            <button class="btn btn-outlined btn-dark btn-flat" id="btnEksporSiswa">Ekspor</button>
            <button class="btn btn-outlined btn-dark btn-flat" id="btnCetakSiswa">Cetak</button>
        </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-condensed table-striped" id="tablesiswaku" width="100%">
          <thead>
            <tr>
              <th>No</th>
              <th>NIS</th>
              <th>NISN</th>
              <th>Nama Siswa</th>
              <th>JK</th>
              <th>Kelas/Rombel</th>
              <th>HP</th>
              <th>Alamat</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
</div>
