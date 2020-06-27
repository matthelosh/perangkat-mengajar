<div class="card">
    <div class="card-header">
        <h4 class="card-title">
            <i class="mdi mdi-account"></i>
            Data Pengguna
        </h4>
        <div class="row">
            <div class="col-sm-12">
                <button class="btn btn-primary"><i class="mdi mdi-plus"></i> Tambah</button>
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalImportUser"><i class="mdi mdi-upload"></i> Impor</button>
                <button class="btn btn-primary"><i class="mdi mdi-file-excel"></i> Expor</button>
                <button class="btn btn-primary"><i class="mdi mdi-printer"></i> Cetak</button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table" id="table-pengguna" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Nama</th>
                        <th>HP</th>
                        <th>Level</th>
                        <th>Role</th>
                        <th>Password Asli</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalImportUser" tabindex="-1" role="dialog" aria-labelledby="modalImportUser" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Impor Pengguna</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
      <div class="modal-body">
        <div class="container-fluid">
          <form action="/pengguna/impor" enctype="multipart/form-data" method="POST">
            @csrf()
            <div class="form-group">
              <label for="file">File Pengguna</label>
              <input type="file" name="file" id="file" class="form-control" placeholder="Ambil File Pengguna" aria-describedby="helpId">
              <small id="helpId" class="text-muted">File Excel Pengguna</small>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
          </form>
          
        </div>
      </div>
    </div>
  </div>
</div>