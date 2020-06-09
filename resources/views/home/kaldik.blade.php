<div class="card">
    <div class="card-header">
        <h4 class="card-title"><i class="mdi mdi-calendar"></i> Kalender Pendidikan {{ $tapel = (date('m') < 7 ) ? (date('Y')-1) . "/" . date('Y') : date('Y') . "/" . (date('Y')+1) }}</h4>
        <button class="btn btn-primary" id="btnShowCalendar">Kalender</button>
        <button class="btn btn-primary" id="btnrpe">RPE</button>
        <button class="btn btn-primary" id="btnagenda" >Agenda</button>
    </div>
    <div class="card-body">
        <div class="row kal" id="box-kaldik" style="display:none;">
            <div class="col-sm-12">
                <object data="{{ asset('files/kaldik-1920.pdf') }}" type="application/pdf" width="100%" height="600px"></object>
            </div>
        </div>
        <hr>
        <div class="row" id="box-rpe" style="display:none;">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Rencana Pekan Efektif</h4>
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row" id="box-agenda" style="display:none;">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            <i class="mdi mdi-calendar"></i>
                            Agenda
                        </h4>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modal-agenda">
                            <i class="mdi mdi-calendar-plus"></i>
                            Baru
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Mulai</th>
                                        <th>Selesai</th>
                                        <th>Lokasi</th>
                                        <th>Acara</th>
                                        <th>Uraian</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="modal-agenda">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Buat Agenda Baru</h4>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="" class="form" id="formNewAgenda">
                    <div class="row">
                        <div class="form-group col-sm-2">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" placeholder="Tanggal">
                        </div>

                        <div class="form-group">
                            <label for="mulai">Mulai</label>
                            <input type="datetime-local" class="form-control" name="mulai" placeholder="Mulai">
                        </div>
                        <div class="form-group">
                            <label for="selesai">Selesai</label>
                            <input type="datetime-local" class="form-control" name="selesai" placeholder="Selesai">
                        </div>
                        <div class="form-group">
                            <label for="lokasi">Lokasi</label>
                            <input type="text" class="form-control" name="lokasi">
                        </div>
                        <div class="form-group">
                            <label for="acara">Acara</label>
                            <input type="text" class="form-control" name="acara">
                        </div>
                        <div class="form-group">
                            <label for="uraian">Uraian</label>
                            <input type="text" class="form-control" name="uraian">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

