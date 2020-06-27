<div class="card">
    <div class="card-header outlined">
        <h4>
          <i class="mdi mdi-book"></i>
          Data Kompetensi
        </h4>
        <div class="d-flex float-left">
          <button class="btn btn-outlined btn-dark btn-flat" id="btnTambahRombel">Tambah</button>
          <button class="btn btn-outlined btn-dark btn-flat" id="btnImpor" data-toggle="modal" data-target="#modalImportKd" data-impor="rombel">Impor</button>
          <button class="btn btn-outlined btn-dark btn-flat" id="btnEksporRombel">Ekspor</button>
          <button class="btn btn-outlined btn-dark btn-flat" id="btnCetakRombel">Cetak</button>
        </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-condensed table-striped" id="tablekd" width="100%">
          <thead>
            <tr>
              <th>No</th>
              <th>Mapel</th>
              <th>Kode KD</th>
              <th>Teks KD</th>
              <th>Ranah</th>
              <th>Tingkat</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalImportKd" tabindex="-1" role="dialog" aria-labelledby="modalImportKd" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Impor KD</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
      <div class="modal-body">
        <div class="container-fluid">
          <form action="/kompetensi/impor" enctype="multipart/form-data" method="POST">
            @csrf()
            <div class="form-group">
              <label for="file">File KD</label>
              <input type="file" name="file" id="file" class="form-control" placeholder="Ambil File KD" aria-describedby="helpId">
              <small id="helpId" class="text-muted">File Excel KD</small>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
          </form>
          
        </div>
      </div>
    </div>
  </div>
</div>

