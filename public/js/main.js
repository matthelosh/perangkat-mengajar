$(document).ready(function(){

    const headers = { 'X-CSRF-TOKEN':$('meta[name="csrf-token"]').prop('content')}
// Siswa
    var wali = sessionStorage.getItem('wali')
    var rombel = sessionStorage.getItem('rombel')
    var tsiswa = $('#tablesiswa').DataTable({
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

    $(document).on('click', '.btnHapusSiswa', function(){
        var id = $(this).data('id');
        var nama = $(this).data('nama');
        swal({
            title: "Yakin menghapus ?",
            text: "Data "+nama,
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((hapus) => {
            if(hapus) {
                $.ajax({
                    type: 'post',
                    headers: headers,
                    url: '/siswa/'+id,
  
                }).done(res => {
                    swal(res.msg)
                    location.href='/admin/siswa'
                }).catch(err => {
                    swal(err.response.msg)
                })
              //   swal('Data dihapus', {icon: 'success'})
            } else {
                swal('Data tidak dihapus')
            }
        })
  
    })
  

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
                return (data.siswas) ? data.siswas.length + ' siswa' : 'Belum ada siswa'
            }},
            {"data": null, render: (data) => {

                return (data.gurus) ? data.gurus.nama: 'Belum ada wali'
            }},
            {"data": null, render: (data) => {
                // console.log(data)
                return `
                    <button class="btn btn-sm btn-primary btn-outlined btnMnjRombel"><i class="mdi mdi-cogs"></i></button>
                    <button class="btn btn-sm btn-warning btn-outlined btnEditRombel" data-id="`+data.id+`" data-nama="nama"><i class="mdi mdi-pencil"></i></button> 
                    <button class="btn btn-sm btn-danger btn-outlined btnHapusRombel" data-id="`+data.id+`" data-nama="`+data.nama_siswa+`"><i class="mdi mdi-delete"></i></button>`;
            }}
        ]
    });

    $(document).on('click', '#btnTambahRombel', function(e) {
        e.preventDefault()
        // $.fn.modal.Constructor.prototype.enforceFocus = function() {};
        $('#modalRombel #formRombel').append(`
                                        <input type="hidden" name="_method" value="post" />
                                        <input type="hidden" name="id_rombel" value="" />
                                    `)
        $('#modalRombel').modal()
    })
    
    $(document).on('click', '.btnEditRombel', function(e) {
        e.preventDefault()
        var data = trombel.row($(this).parents('tr')).data()
        Object.keys(data).forEach(k => {
            $(`#modalRombel #formRombel .form-control[name="${k}"]`).val(data[k])
        })
        $('#modalRombel #formRombel .selWali').append(`<option value="${(data.gurus)?data.guru_id:'0'}" selected>${(data.gurus) ? data.gurus.nama : 'Pilih Wali Kelas'}</option>`)
        $('#modalRombel #formRombel').append(`
                                        <input type="hidden" name="_method" value="put" />
                                        <input type="hidden" name="id_rombel" value="${data.id}" />
                                    `)
        $('#modalRombel').modal()
    })

    $(document).on('click', '.btnMnjRombel', function(){
        var data = trombel.row($(this).parents('tr')).data();
            if(data == undefined) {
                var selected_row = $(this).parents('tr');
                if(selected_row.hasClass('child')) {
                    selected_row = selected_row.prev();
                    data = trombel.row(selected_row).data();
                }
            }
    
        $('#modalMnjRombel').modal()
    
        $('#modalMnjRombel .modal-title span').text(data.nama_rombel)
        $('#modalMnjRombel select[name="rombel_tujuan"]').append(`<option value="${data.kode_rombel}" selected>${data.nama_rombel}</option>`).trigger('change')
    
        // Tampilkan Table Anggota ROmbel
        // var trAnggota = ''
        // data.siswas.forEach((siswa,index) => {
        //     trAnggota += `<tr>
        //         <td><input type="checkbox" name="select" class="select" /></td>
        //         <td>${siswa.id}</td>
        //         <td>${siswa.nis}</td>
        //         <td>${siswa.nama_siswa}</td>
        //     </tr>`
        // })
        var tableAnggota = $('#modalMnjRombel #table-anggota').DataTable({
            serverSide: true,
            select: 'multi',
            ajax: {
                url: '/siswa?req=member&rombel_id='+data.kode_rombel,
                type: 'post',
                headers: headers
            },
    
            columns:[
                {data: 'DT_RowIndex'},
                {data: 'nisn'},
                {data: 'nama_siswa'},
            ]
    
        })
    
        // Pilih semua Anggota
        $(document).on('change', '.select_all', function(){
            if ($(this).prop('checked') == true) {
                $('#modalMnjRombel #table-anggota tbody tr').addClass('selected')
            } else {
                $('#modalMnjRombel #table-anggota tbody tr').removeClass('selected')
            }
    
        })
    
    
        var tnonmember = $('#table-non-anggota').DataTable({
            serverSide:true,
            select: 'multi',
            ajax: {
                url: '/siswa?req=non-member',
                type: 'post',
                headers: headers
            },
            columns:[
                {data: 'DT_RowIndex'},
                {data: 'nisn'},
                {data: 'nama_siswa'}
            ]
        })
    
        // Keluarkan Anggota
        $(document).on('click', '#btnKeluarkanAnggota', function(){
            var members = tableAnggota.rows({selected: true}).data();
            // console.log(members)
            var ids = []
            var namas = ''
            members.each(item => {
                ids.push(item.id)
                namas += item.nama_siswa+', '
            })
            // console.log(ids)
            swal({
                title: 'Yakin mengeluarkan data siswa?',
                html: true,
                text: namas,
                icon: 'warning',
                buttons: true,
                dangerMode: true
            }).then(keluarkan => {
                if ( keluarkan ) {
                    $.ajax({
                        url: '/siswa/keluar-rombel',
                        type: 'post',
                        data: {'ids': ids},
                        headers: headers
                    }).then(res => {
                        // console.log(res)
                        swal({
                            text: res.msg,
                            icon: 'info'
                        })
                        tableAnggota.ajax.reload()
                        tnonmember.draw()
                    }).catch(err => {
                        console.log(err)
                    })
                } else {
                    swal('Siswa tidak dikeluarkan.')
                }
            })
    
    
        })
    
        // Masukkan Anggota
        $(document).on('click', '#btnMasukkanSiswa', function(){
            var nonmembers = tnonmember.rows({selected: true}).data()
    
            var ids = []
            var namas = ''
            var rombel7 = $('#rombel7').val()
            var nama_rombel7 = $('#rombel7 option').text()
            nonmembers.each(nm => {
                ids.push(nm.id)
                namas += nm.nama_siswa
            })
    
            swal({
                title: 'Yakin memasukkan siswa ke rombel ' + nama_rombel7,
                html: true,
                text: namas,
                buttons: true,
                dangerMode: true
            }).then(masukkan => {
                if ( masukkan ) {
                    $.ajax({
                        url: '/siswa/masuk-rombel',
                        type: 'post',
                        data: {rombel: rombel7, ids: ids},
                        headers: headers
                    }).done(res => {
                        tableAnggota.draw()
                        tnonmember.ajax.reload()
                    }).catch(err => {
                        swal(err.response.text)
                    })
                } else {
                    swal('Siswa tidak dimasukkan ke rombel')
                }
            })
        })
    
        $(document).on('click', '#btnPindahAnggota', function(){
            var members = tableAnggota.rows({selected: true}).data();
            var ids = []
            var namas = ''
            var rombel7 = $('#rombel7').val()
            var nama_rombel7 = $('#rombel7 option').text()
            var rombelasal = ''
            members.each(m => {
                ids.push(m.id)
                namas += m.nama_siswa
                rombelasal = m.rombel_id
            })
            if(rombelasal == rombel7) {
                swal({icon: 'error', title: 'Error', text: 'Rombel Tujuan tidak boleh sama dengan rombel tujuan.'})
                return false
            }
            swal({
                title: 'Yakin memindahkan siswa ke rombel ' + nama_rombel7,
                html: true,
                text: namas,
                buttons: true,
                dangerMode: true
            }).then(masukkan => {
                if ( masukkan ) {
                    $.ajax({
                        url: '/siswa/pindah-rombel',
                        type: 'post',
                        data: {rombel7: rombel7, ids: ids, rombelasal: rombelasal},
                        headers: headers
                    }).done(res => {
                        tableAnggota.draw()
                        tnonmember.ajax.reload()
                    }).catch(err => {
                        swal(err.response.text)
                    })
                } else {
                    swal('Siswa tidak dipindah-rombel  kan')
                }
            })
        })
    
    
        // Destroy Table
        $(document).on('hidden.bs.modal', '#modalMnjRombel', function(){
            tableAnggota.destroy()
            tnonmember.destroy()
    
        })
    })

    $(document).on('submit', '#formRombel', function(e) {
        e.preventDefault()
        var data = $(this).serialize()
        var method = $('#formRombel').find('input[name="_method"').val()
        // alert(method)
        $.ajax({
            headers: headers,
            url: '/rombel/one',
            type: method,
            data: data
        }).done(res => {
            trombel.ajax.reload()
            swal('Info', res.msg, 'info')
            $('#modalRombel').modal('hide')
        }).fail(err => {
            swal('Error', err.response.msg, 'error')
        })
    })
    // Autoselect
        // SelGuru
        $('.selWali').select2({
            ajax: {
                headers: headers,
                url: '/select/wali?req=select&role=wali',
                type: 'post',
                    dataType: 'json',
                    delay: 250,
                    processResults: function(response) {
                        return {
                            results: response.gurus
                        };
                    },
                    cache: true,

            },
        })

        
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

        // Ekskul
        $('.selEkskul').select2({
            ajax: {
                headers: headers,
                url: '/select/ekskul?req=select',
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

        // Siswa
        $('.selSiswa').select2({
            ajax: {
                headers: headers,
                url: '/siswa?req=select&rombel='+sessionStorage.getItem('rombel'),
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
        })

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

        $('.selKd').select2({
        })

        $('.selKompetensi').change(function(){
            var mapel = $('#mapel').val()
            var ki = $(this).val()
            $.ajax({
                headers: headers,
                type: 'post',
                dataType: 'json',
                url: '/select/kd?req=select&mapel='+mapel+'&ki='+ki,
                success: function(res){
                    var kdOpt = ''
                    res.forEach(item => {
                        kdOpt += `
                            <option value="${item.id}">${item.text}</option>
                        `
                        $('select#kd').html(kdOpt)
                    })
                }
            })
        })


        // $('.selMapel').change(function(){
        //     var mapel = $(this).val()
        //     $.ajax({
        //         headers: headers,
        //         type: 'post',
        //         dataType: 'json',
        //         url: '/select/kd?req=select&mapel='+mapel,
        //         success: function(res){
        //             var kdOpt = ''
        //             res.forEach(item => {
        //                 kdOpt += `
        //                     <option value="${item.id}">${item.text}</option>
        //                 `
        //                 $('select#kd').html(kdOpt)
        //             })
        //         }
        //     })
        // })

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



    // Pengguna
    var tusers = $('#table-pengguna').DataTable({
        serverSide: true,
        ajax: {
            url: '/pengguna?req=dt',
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
            {data: "username", className: "text-center"},
            {data: "email", className: "text-center"},
            {data: "fullname", className: "text-center"},
            {data: "hp", className: "text-left text-wrap"},
            {data: "level", className: "text-left text-wrap"},
            {data: "role", className: "text-left text-wrap"},
            {data: "password_asli", className: "text-left text-wrap"},
            {data: null, render: (data) => {
                return `
                    <button class="btn btn-sm btn-secondary btn-reset-password" on-click="resetPassword(${data.id})"><i class="mdi mdi-refresh"></i> Reset Password</button>
                    <button class="btn btn-sm btn-warning btn-edit-user" on-click="editUser(${data.id})"><i class="mdi mdi-pencil"></i> Edit</button>
                    <button class="btn btn-sm btn-danger btn-remove-user" on-click="hapusUser(${data.id})"><i class="mdi mdi-trash"></i> Hapus</button>

                `
            }},

        ]
    })

    $('.data_sekolah').dblclick(function(){
        // alert($(this).data('field'))
        var field = $(this).data('field')
        var value = $(this).data('value')
        $(this).parents('td').html(`:<input type="text" name="${field}" class="field-sekolah" value="${value}">`)
    })

    $(document).on('blur', '.field-sekolah', function(){
        var field = $(this).prop('name')
        var value = $(this).val()
        // alert(value)
        // if($(this).val() == '' || $(this).val() == null) {
            // swal('Awas', 'Data Masih Kosong', 'warning')
            // $(this).parents('td').html(`<span class="data_sekolah" data-field="${field}" data-value="${value}>${value}</span>`)
            $(this).parents('td').html(`: <span class="data_sekolah" data-field="${field}" data-value="${value}">${value}</span>`)
            return false
        // }
    })

    // Untuk Wali
    var tsiswaku = $('#tablesiswaku').DataTable({
        serverSide: true,
        ajax: {
            url: '/siswa?req=dt&rombel='+sessionStorage.getItem('rombel'),
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
                    <button class="btn btn-sm btn-warning btn-outlined btnEditSiswa" data-id="`+data.id+`" data-nama="nama"><i class="mdi mdi-pencil"></i></button>`;
            }}
        ]
    })

    $(document).on('click','.btnEditSiswa', function(e) {
        e.preventDefault();
        var data = tsiswaku.row($(this).parents('tr')).data()
        $('#formSiswa').append(`<input type="hidden" name="id_siswa" value="${data.id}" />`)
        $('#formSiswa').append(`<input type="hidden" name="_method" value="put" />`)
        Object.keys(data).forEach((k) => {
            // console.log(k+'=>'+data[k])
            $(`#formSiswa .form-control[name="${k}"]`).val(data[k])
        })
        
        $('#modalSiswa .modal-header .modal-title .nama_siswa').text(data.nama_siswa)
        // $('#modalSiswa .modal-header button.btnImgSiswa').html(`<img src="/images/siswas/${data.nisn}.jpg" onerror="this.onerror=null;this.src='/images/siswas/default.jpg';" height="26px">`)
        $('#modalSiswa').modal()
    })

    $(document).on('click', '.btnImgSiswa', function(e) {
        e.preventDefault()
        var nisn = $(`#formSiswa .form-control[name="nisn"]`).val()
        $('#modalSiswa .modal-body .cardImgSiswa').slideDown()
        $('#modalSiswa .modal-body .cardImgSiswa .card-img-top').prop({
            'src' : `/images/siswas/${nisn}.jpg`
        }).on('error', function(){
            $(this).prop('src', '/images/siswas/default.jpg')
            $('#modalSiswa .modal-body .cardImgSiswa .card-img-overlay .card-title').text('Belum ada Foto Siswa')
        })

        $(document).on('change', 'input[name="fileFoto"]', function(e){
            var output = $('#modalSiswa .modal-body .cardImgSiswa .card-img-top')
            output.prop('src', URL.createObjectURL(e.target.files[0]))
            $('#modalSiswa .modal-body .cardImgSiswa .card-img-overlay .card-title').text(e.target.files[0].size)
            //     URL.revokeObjectURL(output.src)
            // }
        })
    })

    $(document).on('click', '.btnBatalUploadImgSiswa', function(e) {
        e.preventDefault()
        $(this).parents('.cardImgSiswa').hide()
    })
    $(document).on('submit', '#formSiswa', function(e) {
        e.preventDefault()
        var data = $(this).serialize()
        $.ajax({
            headers: headers,
            url: '/siswa/update',
            type: 'post',
            data: data
        }).done(res => {
            tsiswaku.ajax.reload()
            swal('Info', res.msg, 'info')
            $('#modalSiswa').modal('hide')
        }).fail(err => {
            swal('Error', err.response.msg, 'error')
        })
    })

    $('#btnFormNilai').click(function(){
        var tahun = $('#tapel').val()
        var semester = tahun.substr(2,2)+tahun.substr(7,2)+$('#semester').val()
        var periode = $('#periode').val()
        var mapel = $('#mapel').val()
        var kd = $('#kd').val()
        var kompetensi = $('#kompetensi').val()
        
        if(periode == '' || periode == null || periode =='0') {
            swal('Error', 'Pilih Periode Penilaian', 'error')
            $('#periode').focus()
            return false
        } else if (mapel == '' || mapel == null || mapel == '0') {
            swal('Error', 'Pilih Mapel Penilaian', 'error')
            $('#mapel').focus()
            return false
        } else if (kd == '' || kd == null || kd == '0') {
            swal('Error', 'Pilih KD Penilaian', 'error')
            $('#kd').focus()
            return false
        } else if (kompetensi == '' || kompetensi == null || kompetensi == '0') {
            swal('Error', 'Pilih Kompetensi Penilaian', 'error')
            $('#kompetensi').focus()
            return false
        }
        $('#table-form-nilai tbody').html('<h4 class="text-center">Mohon Tunggu</h4>')
        
        // alert(nilai_default)
        $.ajax({
            headers: headers,
            type: 'post',
            url: '/nilai?req=view',
            data: {
                semester : semester,
                periode: periode,
                mapel: mapel,
                kd: kd
            }
        }).done(res => {
            var data = res.data
            var tr = ''
            data.forEach((siswa,index) => {
                var nilai_default = (siswa.nilai != 0) ? siswa.nilai : (/(1|2)/g.test($('#kompetensi').val())) ? 80 : 0
                // var nilai = (siswa.nilai != 0) ? siswa.nilai : `<input class="form-control" type="number" min="0" max="100" name="nilai[${siswa.nisn}]" value="${nilai_default}" />`
                tr += `
                    <tr>
                        <td class="text-center p-1">${(index+1)}</td>
                        <td class="text-center  p-1 td-nisn">${siswa.nisn}</td>
                        <td class="text-left p-1">${siswa.nama_siswa}</td>
                        <td class="text-center p-1 td-nilai" style="max-width: 75px; text-align:center">
                            <span class="nilai ${(siswa.nilai != 0) ? 'd-block' : 'd-none'}" data-id_nilai="${siswa.id_nilai} ">
                                ${nilai_default}
                            </span>
                            <div class="input-group ${(siswa.nilai != 0) ? 'd-none' : 'd-block'} input-nilai" style="auto: 100px;margin:auto;">
                                <div class="input-group-append">
                                    <input class="form-control" type="number" min="0" max="100" name="nilai[${siswa.nisn}]" data-id_nilai="${siswa.id_nilai}" value="${nilai_default}" />
                                </div>
                            </div>
                        </td>
                    </tr>
                `
            })

            $('#table-form-nilai tbody').html(tr)
            $('#btnSubmitNilai').removeClass('d-none')
        }).fail(err => {
            swal('Error', err.response.msg, 'error')
        })
    })

    
    $(document).on('click','#table-form-nilai tbody tr td span.nilai', function() {
        $(this).siblings('.input-nilai').removeClass('d-none').addClass('d-block').fadeIn().children('.input-group-append').append('<button class="btn btn-warning btn-ganti-nilai"><i class="mdi mdi-check"></i></button>')
        $(this).removeClass('d-block').addClass('d-none').fadeOut()
    })

    $(document).on('click', '.btn-ganti-nilai', function(e){
        e.preventDefault()
        var id_nilai = $(this).siblings('input').data('id_nilai')
        var nilai = $(this).siblings('input').val()
        // alert(nilai)
        $.ajax({
            headers: headers,
            url: '/nilai/ganti/'+id_nilai,
            type: 'post',
            data: {'nilai' : nilai},

        }).done(res => {
            $(this).parents('.input-group').siblings('span.nilai').text(nilai).toggleClass('d-block')
            $(this).parents('.input-group').addClass('d-none').removeClass('d-block')
            $(this).remove()
            swal('Sukses', res.msg, 'info')
        }).fail(err => {
            swal('Error', err.response.msg, 'error')
        })
    })

    


    // $(document).on('change', '#table-form-nilai tbody .nilai .input-nilai', function(e) {
    //     var val = $(this).val()
    //    $(this).parents('span.nilai').append('<button class="btn btn-warning">Ubah</button>')
    // })
    // // Impor NIlai
    // $('#formImportNilai').on('submit', function(e) {
    //     e.preventDefault()

    // })

    $('#btnFormatNilai').click(function(e){
        e.preventDefault()
        var tahun = $('#tapel').val()
        var semester = tahun.substr(2,2)+tahun.substr(7,2)+$('#semester').val()
        var periode = $('#periode').val()
        var mapel = $('#mapel').val()
        var kd = $('#kd').val()
        var kompetensi = $('#kompetensi').val()
        
        if(mapel == '' || mapel == null || mapel == '0') {
            swal('Error', 'Pilih Mapel Penilaian', 'error')
            $('#mapel').focus()
            return false
        } else if($('#kompetensi').val() == '0') {
            swal('Error', 'Pilih Kompetensi Penilaian', 'error')
            $('#kompetensi').focus()
            return false
        }
        $.ajax({
            headers: headers,
            type: 'post',
            url: '/nilai/unduh-format',
            xhrFields: { responseType: 'blob'},
            data: {
                semester : semester,
                periode: $('#periode').val(),
                mapel: $('#mapel').val(),
                kd: $('#kd').val(),
                kompetensi: kompetensi
            },
            success: function(res) {
                var blob = res
                const a = document.createElement('a')
                var filename = 'Nilai.'+$('#mapel').val()+"."+$('#kompetensi').val()+'.xlsx'
                document.body.appendChild(a)
                a.href = window.URL.createObjectURL(blob)
                a.download = filename
                a.target = '_blank'
                a.click()
                a.remove()
            }
        })
    })

    // Submit Nilai
    $('#formNilai').on('submit', function(e){
        e.preventDefault()
        var data = $(this).serialize();
        var tapel = $('#tapel').val()
        var semester = tapel.substr(2,2)+tapel.substr(7,2)+$('#semester').val()
        data += '&semester='+semester+'&periode='+$('#periode').val()+'&mapel='+$('#mapel').val()+'&kd='+$('#kd').val()
        $.ajax({
            headers: headers,
            url: '/nilai/entri',
            type: 'post',
            data: data,

        }).done(res => {
            swal('Sukses', res.msg, 'info')
            $('#btnFormNilai').trigger('click')
        }).fail(err => {
            swal('Error', err.response.msg, 'error')
        })
    })

    // Rapor
    var tsiswarapor = $('#table-siswa-rapor').DataTable({
        serverSide: true,
        ajax: {
            url: '/siswa?req=dt&rombel='+sessionStorage.getItem('rombel'),
            type: 'post',
            headers: headers
        },
        columns: [
            {"data": "DT_RowIndex"},
            {"data": "nisn"},
            {"data": null, render: (data) => {
                return `<img src="/images/siswas/${data.nisn}.jpg" onerror="this.onerror=null;this.src='/images/siswas/default.jpg';" class="img img-circle" height="40px"/>`
            }},
            {"data": "nama_siswa", "className": "text-left"},
            {"data": null, render: (data) => {
                // 2019/2020
                var th = $('#tapel').val()
                var sm = $('#semester').val()
                var semester = th.substr(2,2)+th.substr(7,2)+sm
                return `
                    <a href="" class="btn btn-primary btn-outlined btnDetilSiswa" title="Detil Siswa"><i class="mdi mdi-magnify"></i></a>
                    <a href="" class="btn btn-warning btn-outlined btnEditRaporSiswa" title="Edit Data Siswa ${data.nama_siswa}" data-id="`+data.id+`" data-nama="nama"><i class="mdi mdi-pencil"></i></a> 
                    <a href="/rapor/cetak?nisn=${data.nisn}&semester=${semester}" class="btn btn-success btn-outlined btnRaporSiswa" title="Cetak Rapor ${data.nama_siswa}" data-id="`+data.id+`" data-nama="`+data.nama_siswa+`"><i class="mdi mdi-printer"></i></a>`;
            }}
        ]
    });

    
    $('.selSiswa').on('select2:select', function(e){
        
        var siswa = e.params.data
        var urlParams = new URLSearchParams(window.location.search)
        var semester = urlParams.get('semester')
        var nisn = siswa.id
        // console.log(nisn, semester)
        window.location.href='/rapor/cetak?nisn='+nisn+'&semester='+semester
    })

    // Cetak Cover
    $('#btn-print-cover').on('click', function(){
        var cover = document.querySelector('.page_rapor')
        var win = window.open('', '_blank', 'location=yes,height=1500,width=1024,scrollbars=yes,status=yes')
        var head = `<head>
                    <title>Cetak Cover</title>
                    <link rel="stylesheet" href="/css/app.css" />
                    <link rel="stylesheet" href="/css/rapor.css" />
                </head>`
        var body = cover.outerHTML
        var html = `
                <!doctype html>
                <html>
                    ${head}
                    <body>
                        ${body}
                    </body>
                </html>
        
        `
        win.document.write(html)
        setTimeout(() => {
            win.print()
        }, 500)
    })

    $('#btn-print-biodata').on('click', function(){
        cetakRapor('biodata_rapor', 'Biodata')
    })

    $('#btn-print-rapor-pas').on('click', function(){
        cetakRapor('rapor_pas', 'Rapor PAS')
    })

    $('#btn-print-rapor-pts').on('click', function(e) {
        e.preventDefault();
        cetakRapor('rapor_pts', 'Rapor PTS')
    })
    
    function cetakRapor(divId, title){
        var page = document.querySelector('#'+divId)
        var win = window.open('', '_blank', 'location=yes,height=1400,width=1024,scrollbars=yes,status=yes')
        var head = `<head>
                    <title>Cetak ${title}</title>
                    <link rel="stylesheet" href="/css/app.css" />
                    <link rel="stylesheet" href="/bootstrap/css/bootstrap.css" />
                    <link rel="stylesheet" href="/css/rapor.css" />
                </head>`
        var body = page.outerHTML
        var html = `
                <!doctype html>
                <html>
                    ${head}
                    <body>
                        ${body}
                    </body>
                </html>
        
        `
        win.document.write(html)
        setTimeout(() => {
            win.print()
        }, 1500)
    }


    // Form Ekskul
    $(document).on('click', '#btnFormNilaiEkskul', function(e) {
        e.preventDefault()
        var tahun = $('#tapel').val()
        var semester = tahun.substr(2,2)+tahun.substr(7,2)+$('#semester').val()
        var ekskul = $('#ekskul_id').val()
        // alert(ekskul)
        if (ekskul == null || ekskul == '' || ekskul == '0') {
            swal('Error', 'Pilih Ekstrakurikuler', 'error')
            return false
        }
        $.ajax({
            headers: headers,
            url: '/nilai/ekstra/view',
            type: 'post',
            data: {
                semester: semester,
                // periode: periode,
                ekstra_id: ekskul
            },
            beforeSend: function(){
                $('#table-form-nilai-ekstra tbody').html(`
                    <h1 class="text-center" style="margin-top: 20px; text-align:center;background:#efefef;height: 100px;padding:50px;">Tunngu Sebentar, ..</h1>
                `)
            }
        }).done(res => {
            var data = res.data
            var tr = ''
            data.forEach((siswa,index) => {
                var nilai_default = (siswa.nilai != 0) ? siswa.nilai : 'B'
                // var nilai = (siswa.nilai != 0) ? siswa.nilai : `<input class="form-control" type="number" min="0" max="100" name="nilai[${siswa.nisn}]" value="${nilai_default}" />`
                tr += `
                    <tr>
                        <td class="text-center p-1">${(index+1)}</td>
                        <td class="text-center  p-1 td-nisn">${siswa.nisn}</td>
                        <td class="text-left p-1">${siswa.nama_siswa}</td>
                        <td class="text-center p-1 td-nilai-ekstra" style="max-width: 60%; text-align:center">
                            <span class="nilai-ekstra ${(siswa.nilai != '0') ? 'd-block' : 'd-none'}" data-id_nilai="${siswa.id_nilai} ">
                                ${nilai_default}
                            </span>
                            <div class="input-group ${(siswa.nilai != '0') ? 'd-none' : 'd-block'} input-nilai-ekstra" style="auto: 100px;margin:auto;">
                                <div class="input-group-append">
                                    <input class="form-control" type="text" name="nilai_ekstra[${siswa.nisn}]" data-id_nilai="${siswa.id_nilai}" value="${nilai_default}" />
                                </div>
                            </div>
                        </td>
                    </tr>
                `
            })

            $('#table-form-nilai-ekstra tbody').html(tr)
            $('#btnSubmitNilai').removeClass('d-none')
        }).fail(err => {
            swal('Error', err.response.msg, 'error')
        })
    })

    // SUbmit NIlai EKstra
    $('#formNilaiEkstra').on('submit', function(e){
        e.preventDefault()
        var data = $(this).serialize();
        var tapel = $('#tapel').val()
        var semester = tapel.substr(2,2)+tapel.substr(7,2)+$('#semester').val()
        var ekstra_id = $('#ekskul_id').val()
        data += '&semester='+semester+'&ekstra_id='+ekstra_id
        $.ajax({
            headers: headers,
            url: '/nilai/entri/ekstra',
            type: 'post',
            data: data,

        }).done(res => {
            swal('Sukses', res.msg, 'info')
            $('#btnFormNilai').trigger('click')
        }).fail(err => {
            swal('Error', err.response.msg, 'error')
        })
    })

    $(document).on('click','#table-form-nilai-ekstra tbody tr td span.nilai-ekstra', function() {
        $(this).siblings('.input-nilai-ekstra').removeClass('d-none').addClass('d-block').fadeIn().children('.input-group-append').append('<button class="btn btn-warning btn-ganti-nilai-ekstra"><i class="mdi mdi-check"></i></button>')
        $(this).removeClass('d-block').addClass('d-none').fadeOut()
    })

    $(document).on('click', '.btn-ganti-nilai-ekstra', function(e){
        e.preventDefault()
        var id_nilai = $(this).siblings('input').data('id_nilai')
        var nilai = $(this).siblings('input').val()
        // alert(nilai)
        $.ajax({
            headers: headers,
            url: '/nilai/ganti-nilai-ekstra/'+id_nilai,
            type: 'post',
            data: {'nilai' : nilai},

        }).done(res => {
            $(this).parents('.input-group').siblings('span.nilai-ekstra').text(nilai).toggleClass('d-block')
            $(this).parents('.input-group').addClass('d-none').removeClass('d-block')
            $(this).remove()
            swal('Sukses', res.msg, 'info')
        }).fail(err => {
            swal('Error', err.response.msg, 'error')
        })
    })

    // Tambah Data rapor. eg: ekskul, saran , tbb, kesehatan, presensi, dan prestasi

    $(document).on('click', '.btnEditRaporSiswa', function(e) {
        e.preventDefault();
        var data = tsiswarapor.row($(this).parents('tr')).data()
        // get previous saran
        $.ajax({
            headers: headers,
            url: '/nilai/saran?nisn='+data.nisn,
            type: 'get',
            dataType: 'json'
        }).done(res => {
            $('#modalDataRapor #form-saran textarea[name="saran"]').val(res.data.saran)
            $('#modalDataRapor .form-detil-siswa input[name="tb"]').val((res.data.detil == '0') ?res.data.detil:  res.data.detil.tb)
            $('#modalDataRapor .form-detil-siswa input[name="bb"]').val((res.data.detil == '0') ?res.data.detil:  res.data.detil.bb)
            $('#modalDataRapor .form-detil-siswa input[name="pendengaran"]').val((res.data.detil == '0') ?res.data.detil:  res.data.detil.pendengaran)
            $('#modalDataRapor .form-detil-siswa input[name="penglihatan"]').val((res.data.detil == '0') ?res.data.detil:  res.data.detil.penglihatan)
            $('#modalDataRapor .form-detil-siswa input[name="gigi"]').val((res.data.detil == '0') ?res.data.detil:  res.data.detil.gigi)
            $('#modalDataRapor .form-detil-siswa input[name="fisik_lain"]').val((res.data.detil == '0') ?res.data.detil:  res.data.detil.fisik_lain)
            if (res.data.prestasi != '0') {
                var formPrestasi = $('#modalDataRapor .form-prestasi .container-row')
                res.data.prestasi.forEach(prestasi => {
                    formPrestasi.append(`
                    <div class="row row-input my-2">
                    <div class="form-group col-sm-3">
                        <label for="tingkat">Tingkat:</label>
                        <input type="text" name="tingkat[]" value="${prestasi.tingkat}" class="form-control mx-2">
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="jenis_prestasi">Jenis Prestasi:</label>
                        <input type="text" name="jenis_prestasi[]" value="${prestasi.jenis_prestasi}" class="form-control mx-2">
                    </div>
                    <div class="form-group col-sm-5">
                        <label for="ket">Keterangan:</label>
                        <input type="text" name="ket[]" value="${prestasi.ket}" class="form-control mx-2" style="width:80%">
                    </div>
                    <div class="form-group col-sm-1">
                        <button class="btn btn-danger btn-rem-row">Hapus</button>
                    </div>
                </div>
                    `)
                })
            } else {
                var formPrestasi = $('#modalDataRapor .form-prestasi .container-row')
                formPrestasi.html(
                    ` <div class="row row-input my-2">
                    <div class="form-group col-sm-3">
                        <label for="tingkat">Tingkat:</label>
                        <input type="text" name="tingkat[]" placeholder="cth. Korwil Wagir" class="form-control mx-2">
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="jenis_prestasi">Jenis Prestasi:</label>
                        <input type="text" name="jenis_prestasi[]" placeholder="cth. Lomba Lari 100m" class="form-control mx-2">
                    </div>
                    <div class="form-group col-sm-5">
                        <label for="ket">Keterangan:</label>
                        <input type="text" name="ket[]" placeholder="cth. Juara 1" class="form-control mx-2" style="width:80%">
                    </div>
                    <div class="form-group col-sm-1">
                        <button class="btn btn-danger btn-rem-row">Hapus</button>
                    </div>
                </div>`
                )
            }
            $('#modalDataRapor .form-absensi input[name="sakit"]').val((res.data.absensi == '0') ?res.data.absensi:  res.data.absensi.sakit)
            $('#modalDataRapor .form-absensi input[name="izin"]').val((res.data.absensi == '0') ?res.data.absensi:  res.data.absensi.izin)
            $('#modalDataRapor .form-absensi input[name="alpa"]').val((res.data.absensi == '0') ?res.data.absensi:  res.data.absensi.alpa)
        })
        $('#modalDataRapor h4.modal-title span').text(data.nama_siswa)
        $('#modalDataRapor #form-saran input[name="siswa_id"]').val(data.nisn)
        $('#modalDataRapor').modal()
    })

    $(document).on('click', '.btn-more-prestasi', function(e){
        e.preventDefault();
        var formPrestasi = $('#modalDataRapor .form-prestasi .container-row')
        var inputRow = `
                            <div class="row row-input my-2">
                                <div class="form-group col-sm-3">
                                    <label for="tingkat">Tingkat:</label>
                                    <input type="text" name="tingkat[]" placeholder="cth. Korwil Wagir" class="form-control mx-2">
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="jenis_prestasi">Jenis Prestasi:</label>
                                    <input type="text" name="jenis_prestasi[]" placeholder="cth. Lomba Lari 100m" class="form-control mx-2">
                                </div>
                                <div class="form-group col-sm-5">
                                    <label for="ket">Keterangan:</label>
                                    <input type="text" name="ket[]" placeholder="cth. Juara 1" class="form-control mx-2" style="width:80%">
                                </div>
                                <div class="form-group col-sm-1">
                                    <button class="btn btn-danger btn-rem-row">Hapus</button>
                                </div>
                            </div>
                        `

        formPrestasi.append(inputRow)
    })

    $(document).on('click', '.btn-rem-row', function(e) {
        e.preventDefault()
        var row = $(this).parents('.row-input')
        row.remove()
    })

    $(document).on('click', '#modalDataRapor .btn-simpan-detil', function(e) {
        e.preventDefault();

        var dataSaran = $('#form-saran').serialize()
        var dataDetil = $('.form-detil-siswa').serialize()
        var dataAbsensi = $('.form-absensi').serialize()
        var dataPrestasi = $('.form-prestasi').serialize()

        // console.log(dataPrestasi)

        $.ajax({
            headers: headers,
            url: '/rapor/saran/input',
            type: 'post',
            data: {saran: dataSaran, prestasi: dataPrestasi, detil: dataDetil, absensi: dataAbsensi}
        }).done(res => {
            swal('Info', res.msg, 'info')
            // $('#modalDataRapor').modal('hide')
        }).fail(err => {
            swal('Error', err.response.msg, 'error')
        })
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
