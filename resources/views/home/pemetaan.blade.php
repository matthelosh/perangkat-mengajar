<div class="card">
    <div class="card-header outlined">
        <h4>
          <i class="mdi mdi-map"></i>
          Pemetaan KD
        </h4>
        <div class="d-flex float-left">
          <button class="btn btn-outlined btn-dark btn-flat" id="btnTambahRombel">Tambah</button>
          <button class="btn btn-outlined btn-dark btn-flat" id="btnImpor" data-toggle="modal" data-target="#modalImpor" data-impor="rombel">Impor</button>
          <button class="btn btn-outlined btn-dark btn-flat" id="btnEksporRombel">Ekspor</button>
          <button class="btn btn-outlined btn-dark btn-flat" id="btnCetakRombel">Cetak</button>
          <select name="tingkat" id="tingkat" class="form-control">
              <option value="1">Kelas 1</option>
              <option value="2">Kelas 2</option>
              <option value="3">Kelas 3</option>
              <option value="4">Kelas 4</option>
              <option value="5">Kelas 5</option>
              <option value="6">Kelas 6</option>
          </select>
          <button class="btn btn-outline btn-primary" id="btn-view-peta">
              <i class="mdi mdi-magnify"></i>
          </button>
        </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-condensed table-striped" id="table-petakd" width="100%">
          <thead>
            <tr>
              <th>No</th>
              <th>Bab</th>
              <th>KI</th>
              <th>Kode KD</th>
              <th>Teks KD</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
</div>
