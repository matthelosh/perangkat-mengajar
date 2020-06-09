{{-- Modal Import User --}}
<div class="modal" id="modalImpor">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-title"></div>
        <button class="close" data-dismiss="modal" type="button">&times;</button>
      </div>
      <div class="modal-body">
        <form action="" method="post" class="form" id="formImpor" enctype="multipart/form-data">
          @csrf()
          <div class="form-group">
            <label for="fileUsers"><i class="mdi mdi-file-excel"></i> Pilih File Excel </label>
            <input type="file" name="file" id="file" class="form-control" placeholder="">
          </div>
          <button class="btn btn-outlined float-right" type="submit">Upload</button>
        </form>
      </div>
    </div>
  </div>
</div>
{{-- Modal Tambah User --}}
<div class="modal" id="modalUser">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-title"></div>
        <button class="close" data-dismiss="modal" type="button">&times;</button>
      </div>
      <div class="modal-body">
        <form action="" method="post" class="form" id="formUser" enctype="multipart/form-data">
          @csrf()
          <div class="row">
            <div class="form-group col-md-6">
              <label for="nip">NIP</label>
              <input type="text" name="nip" class="form-control" placeholder="NIP">
            </div>
            <div class="form-group col-md-6">
              <label for="nip">Username</label>
              <input type="text" name="username" class="form-control" placeholder="Username">
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label for="email">Email</label>
              <input type="email" name="email" class="form-control" placeholder="Email">
            </div>
            <div class="form-group col-md-6">
              <label for="password">Password</label>
              <input type="text" name="password" class="form-control" placeholder="Password">
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-8">
              <label for="fullname">Nama Lengkap</label>
              <input type="text" name="fullname" class="form-control" placeholder="Nama Lengkap">
            </div>
            <div class="form-group col-md-4">
              <label for="level">Level</label>
              <select name="level" class="form-control">
                <option value="0">-- Level --</option>
                @if(Auth::user()->level == 'superadmin')
                    <option value="admin">Admin</option>
                @endif
                <option value="guru">Guru</option>
                <option value="staf">Staf</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-4">
              <label for="role">Role</label>
              <input type="text" name="role" class="form-control" placeholder="Role">
            </div>
            <div class="form-group col-md-8">
              <label for="hp">No. HP</label>
              <input type="text" name="hp" class="form-control" placeholder="No. HP">
            </div>
          </div>
          @if(Auth::user()->level == 'superadmin')
            <div class="row">
                <div class="form-group col-md-8">
                <label for="sekolah_id">Kode Sekolah</label>
                <select name="sekolah_id" id="" class="form-control selSekolah"></select>
                </div>
            </div>
          @endif
          <button class="btn btn-outlined float-right" type="submit">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>


@if(Auth::user()->level == 'admin')
{{--  Modal Siswa --}}
    <div class="modal" id="modalSiswa">
        <div class="modal-dialog modal-lg"  >
            <div class="modal-content" >
                <div class="modal-header">
                    <h4 class="modal-title">Buat Data Siswa</h4>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="" class="form" id="formSiswa" method="POST">
                        @csrf()
                        <div class="container">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="nis">NIS</label>
                                    <input type="text" class="form-control" name="nis" placeholder="NIS" required />
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="nisn">NISN</label>
                                    <input type="text" class="form-control" name="nisn" placeholder="NISN" required />
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="rombel_id">Rombel</label>
                                    <select name="rombel_id" class="form-control selRombel" style="width: 100%;">
                                        <option value="0">-- Rombel --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-8">
                                    <label for="nama_siswa">Nama</label>
                                    <input type="text" class="form-control" name="nama_siswa" placeholder="Nama Lengkap" required />
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="nis">JK</label>
                                    <select name="jk" class="form-control">
                                        <option value="0">-- Jenis Kelamin --</option>
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="agama">Agama</label>
                                    <select name="agama" id="agama" class="form-control">
                                        <option value="0">--Agama--</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Protestan">Protestan</option>
                                        <option value="Katolik">Katolik</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Budha">Budha</option>
                                        <option value="Konghuchu">Konghuchu</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir">
                                </div>
                                <div class="fomr-group col-md-4">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-8">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" name="alamat" class="form-control" placeholder="Alamat">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="desa">Desa/Kelurahan</label>
                                    <input type="text" class="form-control" name="desa" placeholder="Desa/Kelurahan">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="kec">Kecamatan</label>
                                    <input type="text" class="form-control" name="kec" placeholder="Kecamatan">
                                    {{-- <select name="kec" id="selKec" class="form-control" placeholder="Kecamatan" style="width:100%">
                                        <option value="0">-- Kecamatan --</option>
                                    </select> --}}
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="kab">Kabupaten/Kota</label>
                                    <input type="text" class="form-control" name="kab" placeholder="Kabupaten/Kota">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="prov">Propinsi</label>
                                    <input type="text" class="form-control" name="prov" placeholder="Propinsi">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label for="kode_pos">Kode Pos</label>
                                    <input type="text" class="form-control" name="kode_pos" placeholder="Kode Pos">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="hp">No. HP</label>
                                    <input type="text" class="form-control" name="hp" placeholder="No. HP">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Email">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 text-center">
                                    <button class="btn btn-primary btn-outlined block-center" type="submit">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

{{-- Modal Detil Siswa --}}
    <div class="modal" id="modalDetilSiswa">
        <div class="modal-dialog modal-xl"  style="max-width:95%!important;max-height: 95vh; overflow: hidden;" >
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card" id="data-siswa" >
                                <div class="card-header">
                                    <h4>Data Siswa <span></span></h4>
                                </div>
                                <div class="card-body" style="max-height: 80vh; overflow-y: auto;">

                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card" id="data-detil-siswa">
                                <div class="card-header">
                                    <h4>Detil Siswa <span></span></h4>
                                </div>
                                <div class="card-body" style="max-height: 80vh; overflow-y: auto;">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <form action="" class="form" id="form-foto-siswa" enctype="multipart/form-data">
                                                <input type="file" name="foto-siswa" style="display:none;">
                                            </form>
                                            <img class="img foto-siswa" alt="" style="cursor:pointer;width: 150px;border: solid 5px white; box-shadow: 0 0 5px rgba(0,0,0,0.6);border-radius: 2px;">
                                        </div>
                                        <div class="col-md-8">
                                            <form action="" class="form" id="form-medical">
                                                @csrf()
                                                <div class="row">
                                                    <label for="penyakit" class="col-sm-4">Riwayat Sakit</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control mb-2 mr-sm-2" name="penyakit" placeholder="Riwayat Sakit">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label for="kelainan" class="col-sm-4">Kelainan</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control mb-2 mr-sm-2" name="kelainan" placeholder="Kelainan">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label for="berat_badan" class="col-sm-4">Riwayat Sakit</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control mb-2 mr-sm-2" name="berat_badan" placeholder="Berat Badan">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label for="tinggi_badan" class="col-sm-4">Tinggi Badan</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control mb-2 mr-sm-2" name="tinggi_badan" placeholder="Tinggi Badan">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group text-center col-sm-12">
                                                        <button class="btn btn-primary btn-sm" type="submit">Simpan</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <hr>
                                    <h4>Pendidikan / Sekolah Asal</h4>
                                    {{-- Pendidikan/Asal Sekolah --}}
                                    <div class="row">
                                        <form action="" class="form" id="form-pendidikan">
                                            @csrf()
                                            <div class="container">
                                                <div class="row">
                                                    <label for="sekolah_asal" class="col-sm-4">Sekolah Asal</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="sekolah_asal" placeholder="Sekolah Asal">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label for="ijazah_asal" class="col-sm-4">Ijazah</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="ijazah_asal" placeholder="ijazah">
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <label for="skhu_asal" class="col-sm-4">SKHU</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="skhu_asal" placeholder="SKHU">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label for="no_ujian" class="col-md-4">No. Ujian</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" name="no_ujian" placeholder="No. Ujian">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label for="mutasi_dari" class="col-sm-4">Pindah Dari</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="mutasi_dari" placeholder="Pindah Dari">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label for="alasan_mutasi" class="col-sm-4">Alasan Pindah</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="alasan_mutasi" placeholder="Alasan Pindah">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label for="mutasi_kelas" class="col-sm-4">Pindah Ke Kelas</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="mutasi_kelas" placeholder="Pindah ke Kelas">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label for="tanggal_mutasi" class="col-sm-4">Tanggal Pindah</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="tanggal_mutasi" placeholder="Tanggal Pindah">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group text-center col-sm-12">
                                                        <button class="btn btn-primary btn-sm" type="submit">Simpan</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <hr>
                                    <h4>Hobi</h4>
                                    {{-- Hobi --}}
                                    <div class="row">
                                        <form action="" class="form" id="form-hobi">
                                            @csrf()
                                            <div class="container">
                                                <div class="row">
                                                    <label for="seni" class="col-sm-4">Seni</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="seni" placeholder="Seni">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label for="olahraga" class="col-sm-4">Olah Raga</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="olahraga" placeholder="Olah Raga">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label for="organisasi" class="col-sm-4">Organisasi</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="organisasi" placeholder="Organisasi">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label for="lainnya" class="col-sm-4">Lainnya</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="lainnya" placeholder="Lainnya">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group text-center col-sm-12 mt-2">
                                                        <button class="btn btn-primary btn-sm" type="submit">Simpan</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <hr>
                                    <h4>Perkembangan Lanjutan</h4>
                                    {{-- Perkembangan Lanjutan --}}
                                    <div class="row">
                                        <form action="" class="form" id="form-perkembangan">
                                            @csrf()
                                            <div class="container">
                                                <div class="row">
                                                    <label for="tanggal_keluar" class="col-sm-4">Tanggal Keluar</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="tanggal_keluar" placeholder="Tanggal Keluar">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label for="alasan_keluar" class="col-sm-4">Alasan Keluar</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="alasan_keluar" placeholder="Alasan Keluar">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label for="tanggal_lulus" class="col-sm-4">Tanggal Lulus</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="tanggal_lulus" placeholder="Tnaggal Lulus">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label for="ijazah" class="col-sm-4">No. Ijazah</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="ijazah" placeholder="No. Ijazah">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label for="skhu" class="col-sm-4">No. SKHU</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="skhu" placeholder="No. SKHU">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group text-center col-sm-12 mt-2">
                                                        <button class="btn btn-primary btn-sm" type="submit">Simpan</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card" id="data-ortu">
                                <div class="card-header">
                                    <h4>Data Ortu</h4>
                                </div>
                                <div class="card-body" style="max-height: 80vh; overflow-y: auto;">
                                    <form action="" class="form">
                                        <div class="form-group">
                                            <label for="ayah">Nama Ayah</label>
                                            <input type="text" class="form-control" name="ayah" placeholder="Nama Ayah">
                                        </div>
                                        <div class="form-group">
                                            <label for="pend_ayah">Pendidikan Ayah</label>
                                            <input type="text" class="form-control" name="pend_ayah" placeholder="Pendidikan Ayah">
                                        </div>
                                        <div class="form-group">
                                            <label for="job_ayah">Pekerjaan Ayah</label>
                                            <input type="text" class="form-control" name="job_ayah" placeholder="Pekerjaan Ayah">
                                        </div>
                                        <div class="form-group">
                                            <label for="ibu">Nama Ibu</label>
                                            <input type="text" class="form-control" name="ibu" placeholder="Nama Ibu">
                                        </div>
                                        <div class="form-group">
                                            <label for="pend_ibu">Pendidikan Ibu</label>
                                            <input type="text" class="form-control" name="pend_ibu" placeholder="Pendidikan Ibu">
                                        </div>
                                        <div class="form-group">
                                            <label for="job_ibu">Pekerjaan Ibu</label>
                                            <input type="text" class="form-control" name="job_ibu" placeholder="Pekerjaan Ibu">
                                        </div>
                                        <div class="form-group">
                                            <label for="wali">Nama Wali</label>
                                            <input type="text" class="form-control" name="wali" placeholder="Nama Wali">
                                        </div>
                                        <div class="form-group">
                                            <label for="pend_wali">Pendidikan Wali</label>
                                            <input type="text" class="form-control" name="pend_wali" placeholder="Pendidikan Wali">
                                        </div>
                                        <div class="form-group">
                                            <label for="job_wali">Pekerjaan Wali</label>
                                            <input type="text" class="form-control" name="job_wali" placeholder="Pekerjaan Wali">
                                        </div>
                                        <div class="form-group text-center">
                                            <button class="btn btn-primary btn-sm" type="submit">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{-- Modal Mapel --}}
    <div class="modal" id="modalMapel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Buat Data Mapel</h4>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="" class="form" id="formMapel">
                        @csrf()
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="kode_mapel">Kode Mapel</label>
                                <input type="text" class="form-control" name="kode_mapel" placeholder="Kode Mapel" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="nama_mapel">Nama Mapel</label>
                                <input type="text" class="form-control" name="nama_mapel" placeholder="Nama Mapel" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-12 text-center">
                                <button class="btn btn-primary btn-outlined" type="submit">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
{{-- Modal Rombel --}}
    <div class="modal" id="modalRombel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="mdi mdi-google-classroom"></i> Data Rombel Baru</h4>
                    <button class="close" data-dismiss="modal">&times</button>
                </div>
                <div class="modal-body">
                    <form action="" class="form" id="formRombel">
                        @csrf()
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="kode_rombel">Kode Rombel</label>
                                <input type="text" name="kode_rombel" placeholder="Kode Rombel" class="form-control">
                            </div>
                            <div class="form-group col-md-8">
                                <label for="nama_rombel">Nama Rombel</label>
                                <input type="text" class="form-control" name="nama_rombel" placeholder="Nama Rombel">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-8">
                                <label for="guru_id">Wali Kelas</label>
                                <select name="guru_id" class="form-control selGuru" style="width:100%;height: 40px;">
                                    <option value="0">--Wali Kelas--</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="tingkat">Tingkat</label>
                                <select name="tingkat" class="form-control selTingkat" style="width:100%;height: 40px;">
                                    <option value="0">--Tingkat--</option>
                                    @if(Auth::user()->sekolahs->jenjang == 'sd')
                                        @for($i=1;$i<=6;$i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    @elesif(Auth::user()->sekolahs->jenjang == 'smp')
                                        @for($i=7;$i<=9;$i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    @elesif(Auth::user()->sekolahs->jenjang == 'smk' || Auth::user()->sekolahs->jenjang == 'smu')
                                        @for($i=10;$i<=12;$i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group text-center col-md-12">
                                <button type="submit" class="btn btn-primary btn-outlined">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
{{-- Modal Manajemen Rombel --}}
    <div class="modal" id="modalMnjRombel">
        <div class="modal-dialog modal-xl" style="max-width:95%!important;max-height: 95vh; overflow: hidden;" >
            <div class="modal-content" >
                <div class="modal-header">
                    <h4 class="modal-title">Manajemen Anggota Rombel <span></span></h4>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-3">
                                            <select name="rombel_tujuan" id="rombel7" class="selRombel" style="width:100%"></select>
                                        </div>
                                        <div class="col-3">
                                            <button class="btn btn-warning" id="btnPindahAnggota">
                                                <i class="mdi mdi-shuffle"></i>
                                                Pindahkan Anggota
                                            </button>
                                        </div>
                                        <div class="col-3">
                                            <button class="btn btn-danger" id="btnKeluarkanAnggota">
                                                <i class="mdi mdi-delete"></i>
                                                Keluarkan Anggota
                                            </button>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4>Data Anggota Rombel</h4>
                                                </div>
                                                <div class="card-body" style="max-height: 70vh; overflow-y: auto;">
                                                    <div class="table-responsive">
                                                        <table class="table table-sm" id="table-anggota">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>NIS</th>
                                                                    <th>Nama</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody></tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-3">
                                            <button class="btn btn-primary" id="btnMasukkanSiswa">
                                                <i class="mdi mdi-save"></i>
                                                Masukkan Siswa
                                            </button>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4>Data Siswa</h4>
                                                </div>
                                                <div class="card-body" style="max-height: 70vh; overflow-y: auto;">
                                                    <div class="table-responsive">
                                                        <table class="table table-sm" id="table-non-anggota" style="width:100%;">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>NIS</th>
                                                                    <th>Nama</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody></tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{-- Jadwal --}}
    <div class="modal" id="modalJadwal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        <i class="mdi mdi-calendar"></i>
                        Jadwal Pembelajaran
                    </h4>
                    <button class="close" data-dismiss="modal">&times</button>
                </div>
                <div class="modal-body">
                    <form action="" class="form" id="formJadwal">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="form-group col-sm-3">
                                    <label for="hari">Hari</label>
                                    <select name="hari" class="form-control selHari" style="width: 100%">
                                        <option value="0">--Hari--</option>
                                        <option value="Senin">Senin</option>
                                        <option value="Selasa">Selasa</option>
                                        <option value="Rabu">Rabu</option>
                                        <option value="Kamis">Kamis</option>
                                        <option value="Jumat">Jumat</option>
                                        <option value="Sabtu">Sabtu</option>
                                        <option value="Minggu">Minggu</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="mapel_id">Mapel</label>
                                    <select name="mapel_id" class="form-control selMapel" style="width:100%">
                                        <option value="0">-- Mapel --</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="rombel_id">Rombel</label>
                                    <select name="rombel_id" class="form-control selRombel" style="width:100%">
                                        <option value="0">-- Rombel --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-8">
                                    <label for="guru_id">Guru Pengajar</label>
                                    <select name="guru_id" class="form-control selGuru" style="width:100%">
                                        <option value="0">-- Guru --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-3">
                                    <label for="mulai">Mulai</label>
                                    <select name="mulai" class="form-control selJam">
                                        <option value="0">-- Jam Mulai --</option>
                                        @php
                                            $jenjang = Auth::user()->sekolahs->jenjang;
                                            $jam = ($jenjang == 'sd') ? 8 : 10;
                                        @endphp
                                        @for($i = 1; $i <= $jam+1; $i++) {
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        }
                                        @endfor
                                    </select>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="selesai">Selesai</label>
                                    <select name="selesai" class="form-control selJam">
                                        <option value="0">-- Jam Selesai --</option>
                                        @php
                                            $jenjang = Auth::user()->sekolahs->jenjang;
                                            $jam = ($jenjang == 'sd') ? 8 : 10;
                                        @endphp
                                        @for($i = 1; $i <= $jam+1; $i++) {
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        }
                                        @endfor
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="ket">Keterangan</label>
                                    <input type="text" name="ket" class="form-control" placeholder="Keterangan">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12 text-center">
                                    <button class="btn btn-primary" type="submit">Simpan</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endif

