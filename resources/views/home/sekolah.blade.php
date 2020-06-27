<div class="card">
    <div class="card-header">
        <h4 class="card-title">
            <i class="mdi mdi-bank"></i>
            Sekolah
        </h4>
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalSekolah"><i class="mdi mdi-pencil"></i> Edit</button>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-4">
            
            </div>
            <div class="col-sm-8">
                <span id="id_sekolah" class="d-none">{{ $sekolah ? $sekolah->id : '' }}</span>
                <table>
                    <tr>
                        <td>
                            NPSN
                        </td>
                        <td>: <span class="data_sekolah" data-field="npsn" data-value="{{ $sekolah ? $sekolah->npsn : null }}">{{ $sekolah != null ? $sekolah->npsn : 'Belum ada data' }}</span></td>
                    </tr>
                    <tr>
                        <td>
                            Nama Sekolah
                        </td>
                        <td>: <span class="data_sekolah" data-field="nama_sekolah" data-value="{{ $sekolah ? $sekolah->nama_sekolah : null }}">{{ $sekolah ? $sekolah->nama_sekolah : 'Belum ada data' }}</span></td>
                    </tr>
                    <tr>
                        <td>
                            Alamat
                        </td>
                        <td>: <span class="data_sekolah" data-field="alamat" data-value="{{ $sekolah ? $sekolah->alamat : null }}">{{ $sekolah ? $sekolah->alamat : 'Belum ada data' }}</span></td>
                    </tr>
                    <tr>
                        <td>
                            Desa
                        </td>
                        <td>: <span class="data_sekolah" data-field="desa" data-value="{{ $sekolah ? $sekolah->desa : null }}">{{ $sekolah ? $sekolah->desa : 'Belum ada data' }}</span></td>
                    </tr>
                    <tr>
                        <td>
                            Kecamatan
                        </td>
                        <td>: <span class="data_sekolah" data-field="kec" data-value="{{ $sekolah ? $sekolah->kec : null }}">{{ $sekolah ? $sekolah->kec : 'Belum ada data' }}</span></td>
                    </tr>
                    <tr>
                        <td>
                            Kabupaten
                        </td>
                        <td>: <span class="data_sekolah" data-field="kab" data-value="{{ $sekolah ? $sekolah->kab : null }}">{{ $sekolah ? $sekolah->kab : 'Belum ada data' }}</span></td>
                    </tr>
                    <tr>
                        <td>
                            Propinsi
                        </td>
                        <td>: <span class="data_sekolah" data-field="prov" data-value="{{ $sekolah ? $sekolah->prov : null }}">{{ $sekolah ? $sekolah->prov : 'Belum ada data' }}</span></td>
                    </tr>
                    <tr>
                        <td>
                            Kode Pos
                        </td>
                        <td>: <span class="data_sekolah" data-field="kode_pos" data-value="{{ $sekolah ? $sekolah->kode_pos : null }}">{{ $sekolah ? $sekolah->kode_pos : 'Belum ada data' }}</span></td>
                    </tr>
                    <tr>
                        <td>
                            Telepon
                        </td>
                        <td>: <span class="data_sekolah" data-field="telp" data-value="{{ $sekolah ? $sekolah->telp : null }}">{{ $sekolah ? $sekolah->telp : 'Belum ada data' }} </span></td>
                    </tr>
                    <tr>
                        <td>
                            Email
                        </td>
                        <td>: <span class="data_sekolah" data-field="email" data-value="{{ $sekolah ? $sekolah->email : null }}">{{ $sekolah ? $sekolah->email : 'Belum ada data' }}</span></td>
                    </tr>
                    <tr>
                        <td>
                            Website
                        </td>
                        <td>: <span class="data_sekolah" data-field="website" data-value="{{ $sekolah ? $sekolah->website : null }}">{{ $sekolah ? $sekolah->website : 'Belum ada data' }}</span></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="modal" id="modalSekolah">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Data Sekolah</h4>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="/sekolah/update" class="form" method="post">
                    @csrf()
                    <input type="hidden" name="id" value="{{ $sekolah != null ? $sekolah->id : '0' }}">
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label for="npsn">NPSN</label>
                            <input type="text" name="npsn" class="form-control">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="nama_sekolah">Nama Sekolah</label>
                            <input type="text" class="form-control" name="nama_sekolah">
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="kode_sekolah">Kode Sekolah</label>
                            <input type="text" class="form-control" name="kode_sekolah">
                        </div>
                        <div class="form-group col-sm-8">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" id="alamat" cols="30" rows="3" class="form-control"></textarea>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="desa">Desa</label>
                            <input type="text" class="form-control" name="desa">
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="kec">Kecamatan</label>
                            <input type="text" class="form-control" name="kec">
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="kab">Kab / Kota</label>
                            <input type="text" class="form-control" name="kab">
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="prov">Propinsi</label>
                            <input type="text" class="form-control" name="prov">
                        </div>
                        <div class="form-group col-sm-2">
                            <label for="kode_pos">Kode Pos</label>
                            <input type="text" class="form-control" name="kode_pos">
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="telp">Telepon</label>
                            <input type="text" class="form-control" name="telp">
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="website">Website</label>
                            <input type="text" class="form-control" name="website">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12 text-center">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>