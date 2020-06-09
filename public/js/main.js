$(document).ready(function(){

    const headers = { 'X-CSRF-TOKEN':$('meta[name="csrf-token"]').prop('content')}
// Siswa
    var tsiswa = $('#tablesiswaku').DataTable({
        serverSide: true,
        ajax: {
            url: '/siswa?req=dt',
            type: 'post',
            headers: headers
        },
        columns: [
           {"data": "DT_RowIndex"},
           {"data": null, render: (data) => {
            return (data.nis != null) ? data.nis : '<span style="color:red;">Segera Cek ke Wali Kelas!</span>';
            }},
            {"data": "nisn"},
            {"data": "nama_siswa"},
            {"data": "jk"},
            {"data": null, render: (data, item, type, row) => {
                return (data.rombels) ? data.rombels.nama_rombel : '<span style="color:red;">Belum Masuk Rombel</span>';
            }},
            {"data": "hp"},
            {"data": "alamat"},
            {"data": null, render: (data) => {
                // console.log(data)
                return `
                    <button class="btn btn-sm btn-primary btn-outlined btnDetilSiswa"><i class="mdi mdi-magnify"></i></button>
                    <button class="btn btn-sm btn-warning btn-outlined btnEditSiswa" data-id="`+data.id+`" data-nama="nama"><i class="mdi mdi-pencil"></i></button> <button class="btn btn-sm btn-danger btn-outlined btnHapusSiswa" data-id="`+data.id+`" data-nama="`+data.nama_siswa+`"><i class="mdi mdi-delete"></i></button>`;
            }}
        ]
    });


    var trombel = $('#tablerombel').DataTable({
        serverSide: true,
        ajax: {
            url: '/rombel?req=dt',
            type: 'post',
            headers: headers
        },
        columns: [
            {"data": "DT_RowIndex"},
            {"data": "kode_rombel"},
            {"data": "nama_rombel"},
            {"data": null, render: (data) => {
                return data.siswas.length + ' siswa'
            }},
            {"data": null, render: (data) => {
                return data.gurus.nama
            }},
            {"data": null, render: (data) => {
                // console.log(data)
                return `
                    <button class="btn btn-sm btn-primary btn-outlined btnDetilSiswa"><i class="mdi mdi-magnify"></i></button>
                    <button class="btn btn-sm btn-warning btn-outlined btnEditSiswa" data-id="`+data.id+`" data-nama="nama"><i class="mdi mdi-pencil"></i></button> <button class="btn btn-sm btn-danger btn-outlined btnHapusSiswa" data-id="`+data.id+`" data-nama="`+data.nama_siswa+`"><i class="mdi mdi-delete"></i></button>`;
            }}
        ]
    });


    // Autoselect
        // Rombel
        $('.selRombel').select2({
            ajax: {
                headers: headers,
                url: '/rombel?req=select',
                type: 'post',
                    dataType: 'json',
                    delay: 250,
                    processResults: function(response) {
                        return {
                            results: response
                        };
                    },
                    cache: true,
            }
        });

        // Semester
        $('.selSemester').select2({
            ajax: {
                headers: headers,
                url: '/semester?req=select',
                type: 'post',
                    dataType: 'json',
                    delay: 250,
                    processResults: function(response) {
                        return {
                            results: response
                        };
                    },
                    cache: true,
            }
        });
        $('.selMapel').select2({
            ajax: {
                headers: headers,
                url: '/mapel?req=select',
                type: 'post',
                dataType: 'json',
                delay: 250,
                processResults: function(res) {
                    return {
                        results: res.mapels
                    }
                },
                cache: false
            },
            placeholder: 'Mata Pelajaran'
        })

        $('#selKD').select2({

        })

        $('.selPeriode').select2();
        $('.selKompetensi').select2();
        $('.selFormat').select2();


        // View Nilai
        $('#btnViewNilai').click(function(){
            $.ajax({
                type: 'post',
                url: '/nilai?req=view',
                data: {semester: $('#semester').val(), periode: $('#periode').val(), kompetensi: $('#kompetensi').val(), format: $('#format').val(), rombel: $('#rombel').val()},
                headers: headers
            }).done(res => {
                let tr = '';
                res.data.forEach((item, i) => {
                    tr += `<tr>
                        <td>${i+1}</td>
                        <td>${item.nisn}</td>
                        <td>${item.nama_siswa}</td>
                        <td></td>
                    </tr>`;

                    $('#table-nilai tbody').html(tr)
                })
            }).catch(err => {
                swal('Error', err.response.msg, 'error');
            })
        });

    // Kompetensi
    var tkompetensi = $('#tablekd').DataTable({
        serverSide: true,
        ajax: {
            url: '/kompetensi?req=dt',
            type: 'post',
            headers: headers
        },
        orderCellsTop: true,
        fixedHeader: true,
        "columnDefs": [
            { "width": "5px", "targets": 0 },
            { "width": "75px", "targets": 1 },
            { "width": "75px", "targets": 2 },
            { "width": "150px", "targets": 4 },
            { "width": "5px", "targets": 5 },
            { "width": "150px", "targets": 6 },
          ],
        columns: [
            {"data": "DT_RowIndex", "className": 'text-center text-wrap'},
            {"data": "mapels.label", "className": 'text-left text-wrap'},
            {"data": "kode_kd", "className": 'text-left text-wrap'},
            {"data": "teks_kd", "className": 'text-left text-wrap' },
            {"data": null, render: (data) => {
                var ki = data.kode_kd.split('.')
                var ranah = (ki[0] == '1') ? 'Spiritual' : (ki[0] == '2') ? 'Sosial' : (ki[0] == '3') ? 'Pengetahuan' : 'Keterampilan'
                return ranah
            }, "className": 'text-left text-wrap'},
            {"data" : "tingkat", "className": 'text-left text-wrap'},
            {"data": null, render: (data) => {
                return "Opsi"
            }, "className": 'text-left text-wrap'}
        ]
    })

    // Search Column
    $('#tablekd thead tr').clone(true).appendTo( '#tablekd thead' );
    $('#tablekd thead tr:eq(1) th').each( function (i) {
        var title = $(this).text();
        if(i >= 1 && i != 4 && i <6) {
            $(this).html( '<input type="text" class="form-control" style="width:100%;" placeholder="Cari" />' );
        } else {
            $(this).html('');
        }

        $( 'input', this ).on( 'keyup change', function () {
            if ( tkompetensi.column(i).search() !== this.value ) {
                tkompetensi
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } );
    } );


    // Pemetaan PAI


    function getPetaKD(tingkat) {
        var tpetakd = $('#table-petakd');
        tpetakd.DataTable().destroy()
        tpetakd.DataTable({
            serverSide: true,
            ajax: {
                url: '/pemetaan?req=dt&tingkat='+tingkat,
                type: 'post',
                headers: headers
            },
            orderCellsTop: true,
            fixedHeader: true,
            "columnDefs": [
                { "width": "5px", "targets": 0 },
                { "width": "10px", "targets": 1 },
                { "width": "10px", "targets": 2 },
                { "width": "10px", "targets": 3 },
                { "width": "75px", "targets": 5 },
            ],
            columns: [
                {data: "DT_RowIndex", className: "text-center"},
                {data: "bab_id", className: "text-center"},
                {data: "ki_id", className: "text-center"},
                {data: "kd_id", className: "text-center"},
                {data: "kds.teks_kd", className: "text-left text-wrap"},
                {data: null, render: (data) => {
                    return 'Opsi'
                }},

            ]
        })
    }



    $('#btn-view-peta').on('click', function(e){
        e.preventDefault()
        if($('#tingkat').val() == '0') {
            swal('Peringatan', 'Mohon Pilih Kelas Dulu', 'warning')
            $('#tingkat').focus()
        } else {
            getPetaKD($('#tingkat').val())

        }
    })


    // Show Kalender
    $('#btnShowCalendar').click(function(){
        $('#box-kaldik').slideToggle()
    })

    $('#btnrpe').click(function(){
        $('#box-rpe').slideToggle()
    })

    $('#btnagenda').click(function(){
        $('#box-agenda').slideToggle()
    })

    $('#btnagenda').click(function(){
        $('#modal-agenda').modal('show')
    })
})
