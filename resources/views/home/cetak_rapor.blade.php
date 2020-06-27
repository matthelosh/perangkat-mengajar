<div class="card">
    <div class="card-header">
        <h4 class="card-title">Cetak Rapor {{ $siswa->nama_siswa }}</h4>
    </div>
    <div class="card-body">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a href="#cover" data-toggle="tab" class="nav-link">
                    <i class="mdi mdi-book"></i>
                    Sampul
                </a>
            </li>
            <li class="nav-item">
                <a href="#biodata" data-toggle="tab" class="nav-link">
                    <i class="mdi mdi-account-box"></i>
                    Biodata
                </a>
            </li>
            <li class="nav-item">
                <a href="#rapor-pts" data-toggle="tab" class="nav-link active">
                    <i class="mdi mdi-book-open-page-variant"></i>
                    Rapor PTS
                </a>
            </li>
            <li class="nav-item">
                <a href="#rapor-pas" data-toggle="tab" class="nav-link ">
                    <i class="mdi mdi-book-open-page-variant"></i>
                    Rapor PAS
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane container-fluid" id="cover">
               @include('home.rapor_pages.cover')
            </div>
            <div class="tab-pane container-fluid" id="biodata">
                @include('home.rapor_pages.biodata')
            </div>
            <div class="tab-pane active container-fluid" id="rapor-pts">
                @include('home.rapor_pages.rapor_pts')
            </div>
            <div class="tab-pane container-fluid" id="rapor-pas">
                @include('home.rapor_pages.rapor_pas')
            </div>
        </div>
    </div>
</div>
