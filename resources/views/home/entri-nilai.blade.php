<div class="card text-left">
  <img class="card-img-top" src="holder.js/100px180/" alt="">
  <div class="card-header">
       <h4 class="card-title">Nilai Rapor</h4>
          <div class="row">
            <div class="form-group col-sm-2">
              <label for="tapel">Tapel:</label>
              <select name="tapel" id="tapel" class="form-control" style="font-size:small;">
                @php
                  $Y = date('Y');
                  $m = date('m');
                  for($i = ($Y-3) ; $i < ($Y + 5) ; $i++) {
                    if($m < 7) {
                       $selected = ($i == ($Y -1)) ? 'selected' : '';
                    } else {
                      $selected = ($i == $Y) ? 'selected' : '';
                    }
                   
                    echo '<option value="'.$i.'/'.($i+1).'" '.$selected.'>'.$i.'/'.($i+1).'</option>';
                  }
                @endphp
                {{-- <option value="0">Semester</option> --}}
              </select>
            </div>
            <div class="col-sm-1 form-group">
              <label for="semester">Semester</label>
              <select name="semester" id="semester" class="form-control" style="font-size:small;">
                @php
                  $m = date('m');
                  if($m > 6 ) {
                    echo '<option value="1" selected>Ganjil</option>';
                    echo '<option value="2" >Genap</option>';
                  } else {
                    echo '<option value="1" >Ganjil</option>';
                    echo '<option value="2" selected >Genap</option>';
                  }
                @endphp
                {{-- <option value="0">Semester</option> --}}
              </select>
            </div>
            <div class="form-group col-sm-1">
              <label for="periode">Periode</label>
              <select name="periode" id="periode" class="form-control" style="font-size:small;">
                <option value="0">Periode</option>
                <option value="uh">Harian</option>
                <option value="pts">PTS</option>
                <option value="pas">PAS</option>
              </select>
            </div>
            
            <div class="form-group col-sm-2">
              <label for="mapel">Mapel</label>
              <select name="mapel" id="mapel" class="form-control selMapel" style="font-size:small;">
                <option value="0">Mapel</option>
              </select>
            </div>

            <div class="foem-group col-sm-1">
              <label for="kompetensi">Kompetensi</label>
              <select name="kompetensi" id="kompetensi" class="form-control selKompetensi" style="font-size:small;">
                <option value="0">Kompetensi</option>
                <option value="1">KI-1</option>
                <option value="2">KI-2</option>
                <option value="3">KI-3</option>
                <option value="4">KI-4</option>
              </select>
            </div>

            <div class="foem-group col-sm-3">
              <label for="kd">Kompetensi Dasar</label>
              <select name="kd" id="kd" class="form-control selKd" style="font-size:small;">
                <option value="0">KD</option>
              </select>
            </div>
            <div class="form-group col-sm-2">
              <label for="" style="color: transparent;">Tampilkan Tombol </label>
              <div class="btn-group">
                <button class="btn btn-primary btn-sm" id="btnFormNilai">
                  Tampilkan
                </button>
                <button class="btn btn-success btn-sm" id="btnFormatNilai">
                  Unduh Format
                </button>
              </div>
              
            </div>
            {{-- <div class="form-group col-sm-1">
              <label for="" style="color: transparent;">Download</label>
              <button class="btn btn-primary" id="btnFormatNilai">
                <i class="mdi mdi-download"></i>
                Unduh Format
              </button>
            </div> --}}
          
          </div>
   
    
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-sm-8">
        <h3><i class="mdi mdi-file-document-edit"></i> Form Entri Nilai</h3>
        <hr>
        <form action="/nilai/entri" class="form" id="formNilai">
          @csrf()
          <div class="table-responsive">
            <table id="table-form-nilai" class="table table-bordered table-sm">
              <thead>
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">NISN</th>
                  <th class="text-center">Nama</th>
                  <th class="text-center">Nilai</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <p class="text-center">
                  <button class="btn btn-primary d-none" type="submit" id="btnSubmitNilai">Simpan</button>
                </p>
              </div>
            </div>
          </form>
      </div>
      <div class="col-sm-4">
        <h3><i class="mdi mdi-tools"></i> Alat</h3>
        <hr>
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">
              <i class="mdi mdi-file-excel"></i>
              Impor dari Excel
            </h4>
          </div>
          <div class="card-body">
            <form action="/nilai/impor" class="form" id="formImportNilai" method="post" enctype="multipart/form-data">
              @csrf()
              <div class="form-group">
                <label for="tapel">Tapel:</label>
                <select name="tapel" class="form-control">
                  @php
                    $Y = date('Y');
                    $m = date('m');
                    for($i = ($Y-3) ; $i < ($Y + 5) ; $i++) {
                      if($m < 7) {
                        $selected = ($i == ($Y -1)) ? 'selected' : '';
                      } else {
                        $selected = ($i == $Y) ? 'selected' : '';
                      }
                    
                      echo '<option value="'.$i.'/'.($i+1).'" '.$selected.'>'.$i.'/'.($i+1).'</option>';
                    }
                  @endphp
                  {{-- <option value="0">Semester</option> --}}
                </select>
              </div>
              <div class="form-group">
                <label for="semester">Semester</label>
                <select name="semester" id="semester" class="form-control">
                  @php
                    $m = date('m');
                    if($m > 6 ) {
                      echo '<option value="1" selected>Ganjil</option>';
                      echo '<option value="2" >Genap</option>';
                    } else {
                      echo '<option value="1" >Ganjil</option>';
                      echo '<option value="2" selected >Genap</option>';
                    }
                  @endphp
                  {{-- <option value="0">Semester</option> --}}
                </select>
              </div>
              <div class="form-group">
                <label for="mapel">Mapel</label>
                <select name="mapel" class="form-control selMapel">
                  <option value="0">Mapel</option>
                </select>
              </div>
              <div class="form-group">
                <label for="fileNilai">Pilih File NIlai Excel</label>
                <input type="file" name="file_nilai" class="form-control" >
              </div>
              <p class="text-center">
                <button class="btn btn-primary"><i class="mdi mdi-upload"></i> Upload</button>
              </p>
            </form>
          </div>
        </div>
      </div>
    </div>
   
    
  </div>
</div>