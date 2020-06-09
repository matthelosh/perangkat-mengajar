<div class="card">
    <div class="card-header">
        <h4 class="card-title">{{ (count($pembelajarans) > 0 ) ? "Pembelajaran hari ini:" : "Tidak Ada Pembelajaran." }}</h4>
    </div>
    <div class="card-body">
        <div class="row">
            @if(count($pembelajarans) > 0 )
                @foreach ($pembelajarans as $lesson)
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">
                                    {{ $lesson->rombels->nama_rombel }} | <span class="label-mode">{{ $lesson->mode }} </span>
                                    <div class="float-right">
                                        <label class="switch">

                                            <input type="checkbox" name="mode" value="{{ $lesson->mode }}" {{ ($lesson->mode == 'online') ? 'checked' : false }} class="on-toggle" id="mode-pembelajaran" data-id="{{ $lesson->id }}">
                                            <span class="slider round"></span>

                                          </label>
                                    </div>
                                </h4>
                            </div>
                            <div class="card-body">
                                <h4>{{ $lesson->mapels->nama_mapel }}</h4>
                                Jamke: {{ substr($lesson->jamke,0,1) }} s/d {{ substr($lesson->jamke, 2,1) }} | {{ $lesson->mulai }} s/d {{ $lesson->selesai }}
                            </div>
                            <div class="card-footer text-center">
                                <a href="/guru/jurnal/isi/{{ $lesson->kode_pembelajaran }}" class="btn {{ ($lesson->ket == 'jamkos' ? 'btn-primary' : 'btn-warning') }}"> <i class="mdi {{ ($lesson->ket == 'jamkos') ? 'mdi-pencil' : 'mdi-magnify' }}"></i> {{ ($lesson->ket == 'jamkos') ? 'ISI' : 'LIHAT' }} JURNAL</a>
                            </div>
                        </div>
                    </div>

                @endforeach
            @else

            @endif
        </div>
    </div>
</div>

{{-- {{ dd(Session::all()) }} --}}
