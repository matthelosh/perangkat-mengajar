<div class="card">
    <div class="card-header">
        <h4 class="card-title"><i class="mdi mdi-calendar"></i> Jadwal Pelajaran</h4>
    </div>
    <div class="card-body">
        <div class="table-responseive">
            <table class="table" id="table-jadwal-guru">
                <thead>
                    <tr>
                        <th>Hari</th>
                        <th>Rombel</th>
                        <th>Mapel</th>
                        <th>Jamke</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jadwals as $jadwal)
                        <tr>
                            <td>{{ $jadwal->hari }}</td>
                            <td>{{ $jadwal->rombels->nama_rombel }}</td>
                            <td>{{ $jadwal->mapels->nama_mapel }}</td>
                            <td>{{ $jadwal->jamke }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $jadwals->links() }}
        </div>
    </div>
</div>
