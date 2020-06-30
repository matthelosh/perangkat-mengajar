
@if(Auth::user()->level == 'guru' && Auth::user()->role == 'wali')
{{--  Modal Siswa --}}
    <div class="modal" id="modalSiswa">
        <div class="modal-dialog modal-lg"  >
            <div class="modal-content" >
                <div class="modal-header">
                    <h4 class="modal-title">Edit Data <span class="nama_siswa"></span></h4>
                    
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row-fluid">
                        {{-- <div class="container"> --}}
                            <div class="btn-group">
                                <button class="btn btn-primary btn-sm ml-5 float-right btnImgSiswa" title="Unggah Foto Siswa">Foto Siswa</button>
                                <button class="btn btn-warning btn-sm float-right btnOrtu" title="Data Orang Tua">Data Ortu</button>
                            </div>
                        {{-- </div> --}}
                    </div>
                    <div class="card cardImgSiswa" style="display:none">
                        <img src="" alt="Foto Siswa" class="card-img-top" style="height:300px; width:auto; margin:auto;" />
                        <div class="card-img-overlay" style="bottom:150px!important;">
                            <h4 class="card-title"></h4>
                            <div class="progress justify-content-center align-items-center" style="display:none;background: rgba(200,200,200,0.4);position:absolute;top:0;right:0;bottom:0;left:0;height: 100%; ">
                                <div class="text-center">
                                    <i class="mdi mdi-spin mdi-progress-clock mdi-48px"></i><br>
                                    <h3 class="text-cneter">Tunggu sebentar ..</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="" class="form formImgSiswa" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="fileFoto">Ambil File Foto</label>
                                    <input type="file" name="fileFoto" class="form-control">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-danger btnBatalUploadImgSiswa">Batal</button>
                                    <button class="btn btn-success btnUploadImgSiswa">Unggah Foto</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card cardOrtu" id="data-ortu">
                            <div class="card-header">
                                <h4>Data Ortu</h4>
                            </div>
                            <div class="card-body" style="max-height: 80vh; overflow-y: auto;">
                                <form action="" class="form form-ortu">
                                    <div class="row">
                                        <div class="form-group col-sm-4">
                                            <label for="ayah">Nama Ayah</label>
                                            <input type="text" class="form-control" name="ayah" placeholder="Nama Ayah">
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <label for="job_ayah">Pekerjaan Ayah</label>
                                            <input type="text" class="form-control" name="job_ayah" placeholder="Pekerjaan Ayah">
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <label for="ibu">Nama Ibu</label>
                                            <input type="text" class="form-control" name="ibu" placeholder="Nama Ibu">
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <label for="job_ibu">Pekerjaan Ibu</label>
                                            <input type="text" class="form-control" name="job_ibu" placeholder="Pekerjaan Ibu">
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <label for="wali">Nama Wali</label>
                                            <input type="text" class="form-control" name="wali" placeholder="Nama Wali">
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <label for="job_wali">Pekerjaan Wali</label>
                                            <input type="text" class="form-control" name="pend_wali" placeholder="Pendidikan Wali">
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <label for="hp_ortu">No. HP Orang Tua</label>
                                            <input type="text" class="form-control" name="job_wali" placeholder="Pekerjaan Wali">
                                        </div>
                                        <div class="form-group text-center col-sm-12">
                                            <button class="btn btn-primary btn-sm" type="submit">Simpan</button>
                                        </div>
                                    </div>  
                                </form>
                            </div>
                        </div>
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
                                <div class="form-group col-md-5">
                                    <label for="nama_siswa">Nama</label>
                                    <input type="text" class="form-control" name="nama_siswa" placeholder="Nama Lengkap" required />
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="tk">TK Asal</label>
                                    <input type="text" class="form-control" name="tk" placeholder="Pendidikan Sebelumnya. eg. TK" required />
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
    <div class="modal" id="modalOrtu">
        <div class="modal-dialog modal"  style="max-width:95%!important;max-height: 95vh; overflow: hidden;" >
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="card" id="data-ortu">
                            <div class="card-header">
                                <h4>Data Ortu</h4>
                            </div>
                            <div class="card-body" style="max-height: 80vh; overflow-y: auto;">
                                <form action="" class="form form-ortu">
                                    <div class="form-group">
                                        <label for="ayah">Nama Ayah</label>
                                        <input type="text" class="form-control" name="ayah" placeholder="Nama Ayah">
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

@endif

