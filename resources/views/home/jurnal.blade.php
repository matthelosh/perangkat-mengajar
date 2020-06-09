<div class="card">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
                <a href="#jurnal" class="nav-link active" data-toggle="tab">Jurnal Mengajar</a>

            </li>
            <li class="nav-item">
                <a href="#presensi" class="nav-link" data-toggle="tab">Presensi Siswa</a>
            </li>
        </ul>
    </div>
    <div class="card-body">

        <div class="tab-content">
            <div id="jurnal" class="tab-pane container-fluid active">
                <form action="/guru/jurnal/isi/{{ $pembelajaran->kode_pembelajaran }}" id="frm-jurnal-mengajar" method="POST">
                    @csrf()
                    <div class="media p-3 border rounded">
                        <div class="media-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    Tanggal: {{ date('d-m-Y') }}
                                </div>
                                @if($pembelajaran->tematik == true)
                                    <div class="col-sm-4">
                                        <select name="tema" id="tema" class="form-control selTema">
                                            {{-- <option value="0">-- Tema --</option> --}}
                                        </select>
                                    </div>

                                    <div class="col-sm-5 subtema-container">
                                        <select name="subtema" id="subtema" class="form-control selSubtema">
                                            {{-- <option value="0">-- Sub Tema --</option> --}}
                                        </select>
                                    </div>
                                @endif
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="mupel">Muatan Pelajaran</label>
                                        <select name="mupels[]" id="mupels" class="form-control selMupel" multiple placeholder="Muatan Pelajaran">
                                            {{-- <option value="0">-- Mupel --</option> --}}
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="kd">Kompetensi Dasar</label>
                                        <button class="btn btn-outlined btnCekKd">Cek KD</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div id="presensi" class="tab-pane container">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="switch1">
                    <label class="custom-control-label" for="switch1">Gulir</label>
                </div>
                <form action="/guru/jurnal/presensi/{{ $pembelajaran->kode_pembelajaran }}" id="frm-presensi-siswa" method="POST">
                    @csrf()
                    <input type="hidden" name="kode_pembelajaran" value="{{ $pembelajaran->kode_pembelajaran }}">
                    @foreach ($pembelajaran->rombels->siswas as $siswa)
                        <div class="media p-3 border my-1 rounded">
                            @php
                                $src = (file_exists('images/siswas/'.$siswa->sekolah_id.'_'.$siswa->nis.'.jpg')) ? 'images/siswas/'.$siswa->sekolah_id.'_'.$siswa->nis.'.jpg' : 'images/faces/face10.jpg';
                            @endphp
                            <img src="{{ asset($src) }}" alt="{{ $siswa->nisn }}" class="mr-3 mt-3 rounded-circle" style="width: 60px;">
                            <div class="media-body">
                                <h4>{{ $siswa->nama_siswa }}</h4>
                                <p>
                                    <label>
                                        <input type="radio" name="ket-{{ $siswa->nisn }}" class="form-control" value="h">
                                        Hadir
                                    </label>
                                    <label>
                                        <input type="radio" name="ket-{{ $siswa->nisn }}" class="form-control" value="i">
                                        I jin
                                    </label>
                                    <label>
                                        <input type="radio" name="ket-{{ $siswa->nisn }}" class="form-control" value="s">
                                        Sakit
                                    </label>
                                    <label>
                                        <input type="radio" name="ket-{{ $siswa->nisn }}" class="form-control" value="a">
                                        Alpa
                                    </label>
                                    <label>
                                        <input type="radio" name="ket-{{ $siswa->nisn }}" class="form-control" value="t">
                                        Telat
                                    </label>
                                </p>
                            </div>
                        </div>
                    @endforeach
                    <div class="text-center">
                        <button class="btn btn-primary btn-outlined">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
