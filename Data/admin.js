
$(document).ready(function(){
// Manajemen Siswa
// Datatables Siswa
jQuery.noConflict();
var headers =  {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
  var tsiswa = $('#tablesiswa').DataTable({
    serverSide: true,
    ajax: {
        url: '/admin/siswa?req=dt',
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
        }},

    ]
  });

// Reset Password Siswa
  $('#btnResetPassword').click(function(){
      $.ajax({
          url: '/admin/siswa/reset-password',
          type: 'post', headers:headers
      }).done(res => {
          swal({ title: 'Info', text: res.msg, icon:'info', html: true})
          tsiswa.ajax.reload()
      }).catch(err=>{
          swal('error', err.response.msg, 'error')
      })
  })

//   Detail Siswa
    $(document).on('click', '.btnDetilSiswa', function(){
        var data = tsiswa.row($(this).parents('tr')).data();
        if(data == undefined) {
            var selected_row = $(this).parents('tr');
            if(selected_row.hasClass('child')) {
                selected_row = selected_row.prev();
                data = tsiswa.row(selected_row).data();
            }
        }
        $('#modalDetilSiswa').modal();
        var imgSrc = '/images/siswas/'+data.sekolah_id+'_'+data.nis+'.jpg'

        $.ajax(imgSrc)
                        .done((res, status) => {
                            // console.log( status)
                            $('#modalDetilSiswa #data-detil-siswa .card-body .foto-siswa').prop('src', imgSrc)
                        })
                        .catch((err, state) => {
                            // console.log(state)
                            $('#modalDetilSiswa #data-detil-siswa .card-body .foto-siswa').prop('src', '/images/faces/face5.jpg')
                        })

      var trs =''
        Object.keys(data).forEach(key => {
            trs += `<tr>
                    <td>${key}</td>
                    <td>${data[key]}</td>
            </tr>`
        })
        var tableDataSiswa = `
                                <table class="table">
                                    ${trs}
                                </table>
                            `;
        $('#modalDetilSiswa #data-siswa .card-body').html(tableDataSiswa)

        $('#modalDetilSiswa .foto-siswa').click(function(){
            $('#modalDetilSiswa #form-foto-siswa input[type="file"').trigger('click')
        })

        $(document).on('change', '#form-foto-siswa input[type="file"]', function(e) {
            var fotoSiswa = e.target.files[0]
            var id = data.id
            var fd = new FormData();
            fd.append('file', fotoSiswa)
            fd.append('id', id)
            swal({
                title: "Yakin Mengubah Foto ?",
                text: "Data "+data.nama_siswa,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then(ganti => {
                if(ganti) {
                    $.ajax({
                        url: '/admin/siswa/foto',
                        type: 'post',
                        headers:headers,
                        data: fd,
                        contentType: false,
                        processData: false
                    }).done(res => {
                        console.log(res)
                        $('#modalDetilSiswa #data-detil-siswa .card-body .foto-siswa').prop('src', res.url)
                    }).catch((err, status, res, msg) => {
                        swal({icon: 'error', title: err.responseJSON.msg})
                        // console.log(err.responseJSON, status, res, msg)
                    })
                } else {
                    swal('Foto '+data.nama_siswa+' tidak diganti.')
                }
            })


        })
    })

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
                  url: '/admin/siswa/'+id,

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

  $('#btnImpor').click(function(e){
    e.preventDefault();
    // alert($(this).data('impor'))
    var dataImpor = $(this).data('impor')
    var action = ''
    switch(dataImpor)
    {
        default:
            action = ''
            break
        case 'siswa':
            action = '/admin/siswa/impor'
            break
        case 'rombel':
            action = '/admin/rombel/impor'
            break
        case 'jadwal':
            action = '/admin/jadwal/impor'
            break
        case 'mapel':
            action = '/admin/mapel/impor'
            break
        case 'pemetaan' :
            action = '/admin/pemetaan/impor'
            break

    }
    $('#formImpor').prop('action', action)
    // $('#modalImpor').modal();
    $('#modalImpor .modal-dialog .modal-content .modal-header .modal-title').text('Impor ' + dataImpor.toUpperCase())
  });

  $('#btnEksporSiswa').click(function(){
    $.ajax({
      type: 'get',
      url: '/admin/siswa/ekspor',
      xhrFields: { responseType: 'blob'},
      success: function(res) {
        var blob = res
        const a = document.createElement('a')
        var filename = 'Data-Siswa-'+$('#app-npsn').text()+'.xlsx'
        document.body.appendChild(a)
        a.href = window.URL.createObjectURL(blob)
        a.download = filename
        a.target = '_blank'
        a.click()
        a.remove()
      }
    })
  });

  $('#btnCetakSiswa').click(function(){
    $.ajax({
      type: 'get',
      url: '/admin/siswa/cetak',
      dataType: 'json',
      success: function(res) {
        var data = res.siswas;
        var win = window.open('', '', 'width=600');
        var tr = ''
        var sekolah = res.sekolah
        data.forEach((siswa, index) => {
          tr += `<tr>
            <td>${index+1}</td>
            <td>${siswa.nis}</td>
            <td>${siswa.nisn}</td>
            <td>${siswa.nama_siswa}</td>
            <td>${siswa.jk}</td>
            <td>${ (siswa.rombels) ? siswa.rombels.nama_rombel : '<span style="color: red;">Belum Masuk Rombel</span>'}</td>
            <td>${siswa.hp}</td>
            <td>${siswa.alamat}</td>
          </tr>`
        })
        var table = `
          <table>
            <thead>
              <tr>
                <th>No</th>
                <th>NIS</th>
                <th>NISN</th>
                <th>Nama</th>
                <th>JK</th>
                <th>Kelas</th>
                <th>HP</th>
                <th>Alamat</th>
              </tr>
            </thead>
            <tbody>
              ${tr}
            </tbody>
          </table>
        `

        var html = `
          <!doctype html>
          <html>
            <head>
              <title>Data Siswa Sekolah Kelas Daring</title>
              <style>
                table, th, td {
                  border: 1px solid black;
                  border-collapse: collapse;
                }
                th {
                  text-align: center;
                }

                td {
                  padding: 5px;
                }
                h2 {
                  text-align:center;
                  margin: 5px;
                }
                table#kop,
                table#kop th,
                table#kop td {
                    border-top: 0;
                    border-right: 0;
                    border-bottom: 3px double black;
                    border-left: 0;
                }
                table {
                    width: 100%;
                    font-size: 10pt;
                }
                table#kop tr td {
                    text-align:center;
                }
                table#kop tr td h3,
                table#kop tr td h5 {
                    margin: 0;
                }
                @media print {
                  html,body {
                    margin: 0;
                  }

                  main {
                      margin: 20px 1cm 1cm 1cm;
                  }


                }
              </style>
            </head>
            <body>
                <header>
                    <table id="kop">
                        <tr>
                            <td>
                                <span id="logo-kab">
                                <img class="img" src="../images/malangkab.png" height="100px" />
                            </span>
                            </td>
                            <td>
                                <h3>PEMERINTAH KABUPATEN ${sekolah.kab.toUpperCase()} </h3>
                                <h3>DINAS PENDIDIKAN </h3>
                                <h3>KOORDINATOR WILAYAH DINAS PENDIDIKAN KEC. ${sekolah.kec.toUpperCase()}</h3>
                                <h3>${sekolah.nama_sekolah.toUpperCase()}</h3>
                                <h5>${sekolah.alamat+' '+sekolah.desa} - Kode Pos ${sekolah.kode_pos}</h5>
                                <h5>Telp: ${sekolah.telp}, Email: ${sekolah.email}, Website: ${sekolah.website}</h5>
                            </td>
                        </tr>
                    </table>
                </header>
                <main>
                    <h2>DATA SISWA</h2>
                    ${table}
                </main>
            </body>
          </html>
        `
        win.document.write(html)
        setTimeout(() => {
            win.print()
        }, 500)
      }
    })
  })

  $('#btnTambahSiswa').click(function(e){
    // e.preventDefault();
    // alert('halo')
    // jQuery.noConflict();
    $('#modalSiswa').modal();
    $('#modalSiswa .modal-dialog .modal-content .modal-header .modal-title').text('Buat Data Siswa');

    $('#formSiswa').prop({'action': '/admin/siswa/tambah', 'method': 'POST'});
    // $.ajax({
    //     type: 'post',
    //     url: '/admin/rombel?req=select',
    //     headers: headers,
    //     dataType: 'json',
    //     success: function(res){
    //         var rombelOPts = ''
    //         res.forEach(item => {
    //             rombelOpts += `<option value="${item.kode_rombel}">${item.nama_rombel}</option>`
    //         })
    //       //   console.log(dataRombel)
    //         $('.selRombel').html(dataRombel)

    //     }
    // })
  })

//   Edit Siswa
$(document).on('click', '.btnEditSiswa', function(){
    var data = tsiswa.row($(this).parents('tr')).data();
        if(data == undefined) {
            var selected_row = $(this).parents('tr');
            if(selected_row.hasClass('child')) {
                selected_row = selected_row.prev();
                data = tsiswa.row(selected_row).data();
            }
        }

    $('#modalSiswa').modal()
    $('#modalSiswa form').prop({'action': '/admin/siswa/'+data.id, 'method': 'POST'}).append('<input type="hidden" name="_method" value="PUT" />')
    $('#modalSiswa .modal-header .modal-title').html("Edit Data: " + data.nama_siswa)
    $('#formSiswa input[name="nis"]').val(data.nis)
    $('#formSiswa input[name="nisn"]').val(data.nisn)
    $('#formSiswa input[name="nama_siswa"]').val(data.nama_siswa)
    $('#formSiswa select[name="rombel_id"]').append(`<option value="${data.rombel_id}" selected>${data.rombels.nama_rombel}</option>`).trigger('change')
    $('#formSiswa select[name="jk"]').val(data.jk)
    $('#formSiswa select[name="agama"]').val(data.agama)
    $('#formSiswa input[name="tempat_lahir"]').val(data.tempat_lahir)
    $('#formSiswa input[name="tanggal_lahir"]').val(data.tanggal_lahir)
    $('#formSiswa input[name="alamat"]').val(data.alamat)
    $('#formSiswa input[name="desa"]').val(data.desa)
    $('#formSiswa input[name="kec"]').val(data.kec)
    $('#formSiswa input[name="kab"]').val(data.kab)
    $('#formSiswa input[name="prov"]').val(data.prov)
    $('#formSiswa input[name="kode_pos"]').val(data.kode_pos)
    $('#formSiswa input[name="hp"]').val(data.hp)
    $('#formSiswa input[name="email"]').val(data.email)
})

//   Manajemen Rombel
// Datatable Rombel
    var trombel = $('#tablerombel').DataTable({
        serverSide: true,
        ajax: {
            url: '/admin/rombel?req=dt',
            type: 'post',
            headers: headers
        },
        columns: [
            {"data": "DT_RowIndex"},
            {"data": "kode_rombel"},
            {"data": "nama_rombel"},

            {"data": null, render: (data) => {
               return (data.siswas) ? data.siswas.length+' orang': 'Tidak ada siswa'
            }},
            {"data": null, render: (data) => {
                return (data.gurus) ? data.gurus.fullname : '<span style="color: red">Belum ada wali kelas</span>'
            }},
            {"data": null, render: (data) => {
                return `
                    <button class="btn btn-sm btn-primary btn-outlined btnMnjRombel" data-id="`+data.id+`" data-nama="`+data.nama_rombel+`" data-kode="`+data.kode_rombel+`"><i class="mdi mdi-settings"></i></button>
                    <button class="btn btn-sm btn-warning btn-outlined btnEditRombel" data-id="`+data.id+`" data-nama="`+data.nama_rombel+`"><i class="mdi mdi-pencil"></i></button>
                    <button class="btn btn-sm btn-danger btn-outlined btnHapusRombel" data-id="`+data.id+`" data-nama="`+data.nama_rombel+`"><i class="mdi mdi-delete"></i></button>`;
            }}
        ],
        // select: true
    })


// Ekspor ROmbel
    $('#btnEksporRombel').click(function(){
        $.ajax({
            type: 'get',
            url: '/admin/rombel/ekspor',
            xhrFields: { responseType: 'blob'},
            success: function(res) {
              var blob = res
              const a = document.createElement('a')
              var filename = 'Data-Rombel-'+$('#app-npsn').text()+'.xlsx'
              document.body.appendChild(a)
              a.href = window.URL.createObjectURL(blob)
              a.download = filename
              a.target = '_blank'
              a.click()
              a.remove()
            }
          })
    })
    // Tambah Rombel
    $('#btnTambahRombel').click(function() {
        $('#modalRombel').modal()
        $('#modalRombel form').prop({'action': '/admin/rombel/tambah', 'method': 'POST'})
    })

// Cetak Rombel
$('#btnCetakRombel').click(function(){
    $.ajax({
      type: 'post',
      url: '/admin/rombel?req=cetak',
      dataType: 'json',
      headers: headers,
      success: function(res) {
        var data = res.rombels;
        var win = window.open('', '', 'width=600');
        var tr = ''
        var sekolah = res.sekolah
        data.forEach((rombel, index) => {
          tr += `<tr>
            <td>${index+1}</td>
            <td>${rombel.kode_rombel}</td>
            <td>${rombel.nama_rombel}</td>
            <td>${(rombel.gurus)?rombel.gurus.fullname: 'Belum ada Wali Kelas'}</td>
            <td>${rombel.siswas.length} orang</td>
            <td>${rombel.tingkat}</td>
            <td>${rombel.status}</td>
          </tr>`
        })
        var table = `
          <table>
            <thead>
              <tr>
                <th>No</th>
                <th>Kode Rombel</th>
                <th>Nama Rombel</th>
                <th>Wali Kelas</th>
                <th>Jml Siswa</th>
                <th>Tingkat</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              ${tr}
            </tbody>
          </table>
        `

        var html = `
          <!doctype html>
          <html>
            <head>
              <title>Data Rombel ${sekolah.nama_sekolah}</title>
              <style>
                table, th, td {
                  border: 1px solid black;
                  border-collapse: collapse;
                }
                th {
                  text-align: center;
                }

                td {
                  padding: 5px;
                }
                h2 {
                  text-align:center;
                  margin: 5px;
                }
                table#kop,
                table#kop th,
                table#kop td {
                    border-top: 0;
                    border-right: 0;
                    border-bottom: 3px double black;
                    border-left: 0;
                }
                table {
                    width: 100%;
                    font-size: 10pt;
                }
                table#kop tr td {
                    text-align:center;
                }
                table#kop tr td h3,
                table#kop tr td h5 {
                    margin: 0;
                }
                @media print {
                  html,body {
                    margin: 0;
                  }

                  main {
                      margin: 20px 1cm 1cm 1cm;
                  }


                }
              </style>
            </head>
            <body>
                <header>
                    <table id="kop">
                        <tr>
                            <td>
                                <span id="logo-kab">
                                <img class="img" src="../images/malangkab.png" height="100px" />
                            </span>
                            </td>
                            <td>
                                <h3>PEMERINTAH KABUPATEN ${sekolah.kab.toUpperCase()} </h3>
                                <h3>DINAS PENDIDIKAN </h3>
                                <h3>KOORDINATOR WILAYAH DINAS PENDIDIKAN KEC. ${sekolah.kec.toUpperCase()}</h3>
                                <h3>${sekolah.nama_sekolah.toUpperCase()}</h3>
                                <h5>${sekolah.alamat+' '+sekolah.desa} - Kode Pos ${sekolah.kode_pos}</h5>
                                <h5>Telp: ${sekolah.telp}, Email: ${sekolah.email}, Website: ${sekolah.website}</h5>
                            </td>
                        </tr>
                    </table>
                </header>
                <main>
                    <h2>DATA ROMBEL</h2>
                    ${table}
                </main>
            </body>
          </html>
        `
        win.document.write(html)
        setTimeout(() => {
            win.print()
        }, 500)
      }
    })
  })

// Hapus Rombel
$(document).on('click', '.btnHapusRombel', function() {
    var data = trombel.row($(this).parents('tr')).data();
        if(data == undefined) {
            var selected_row = $(this).parents('tr');
            if(selected_row.hasClass('child')) {
                selected_row = selected_row.prev();
                data = trombel.row(selected_row).data();
            }
        }

    swal({
        title: 'Yakin Hapus Rombel ' + data.nama_rombel + '?',
        icon: 'warning',
        buttons: true,
        dangerMode: true
    }).then(hapus => {
        if ( hapus ) {
            $.ajax({
                url: '/admin/rombel/'+data.id,
                type: 'delete',
                headers: headers
            }).then(res => {
                swal({icon: 'success', text: res.msg})
                trombel.draw()
            }).catch(err => {
                swal(err.response.msg)
            })
        } else {
            swal({text: 'Rombel tidak dihapus', icon: 'info'})
        }
    })
})

// Edit Rombel
$(document).on('click', '.btnEditRombel', function() {
    var data = trombel.row($(this).parents('tr')).data();
        if(data == undefined) {
            var selected_row = $(this).parents('tr');
            if(selected_row.hasClass('child')) {
                selected_row = selected_row.prev();
                data = trombel.row(selected_row).data();
            }
        }

    $('#modalRombel').modal()
    $('#modalRombel .modal-header .modal-title').text("Perbarui Data Rombel: " + data.nama_rombel)
    $('#modalRombel .modal-body form').prepend('<input type="hidden" name="_method" value="PUT" />').prop({'action': '/admin/rombel/'+data.id, 'method': 'POST'})
    $('#modalRombel form input[name="kode_rombel"]').val(data.kode_rombel)
    $('#modalRombel form input[name="nama_rombel"]').val(data.nama_rombel)
    $('#modalRombel form select[name="guru_id"]').append(`<option value=${data.guru_id} selected>${data.gurus.fullname}</option>`)
    $('#modalRombel form select[name="tingkat"]').val(data.tingkat)
})

// Pengaturan Anggota Rombel
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
            url: '/admin/siswa?req=member&rombel_id='+data.kode_rombel,
            type: 'post',
            headers: headers
        },

        columns:[
            {data: 'id'},
            {data: 'nis'},
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
            url: '/admin/siswa?req=non-member',
            type: 'post',
            headers: headers
        },
        columns:[
            {data: 'id'},
            {data: 'nis'},
            {data: 'nama_siswa'}
        ]
    })

    // Keluarkan Anggota
    $(document).on('click', '#btnKeluarkanAnggota', function(){
        var members = tableAnggota.rows({selected: true}).data();
        // console.log(data)
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
                    url: '/admin/siswa/keluar-rombel',
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
                    url: '/admin/siswa/masuk-rombel',
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
                    url: '/admin/siswa/pindah-rombel',
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



// Manajemen Mapel
// Datatable Mapel
    var tmapel = $('#tablemapel').DataTable({
        serverSide: true,
        ajax: {
            url: '/admin/mapel?req=dt',
            type: 'post',
            headers: headers
        },
        columns: [
            {"data": "DT_RowIndex"},
            {"data": "kode_mapel"},
            {"data": "nama_mapel"},
            {"data": null, render: (data) => {
                return `
                    <button class="btn btn-sm btn-warning btn-outlined btnEditMapel" data-id="`+data.id+`" data-nama="`+data.nama_mapel+`"><i class="mdi mdi-pencil"></i></button>
                    <button class="btn btn-sm btn-danger btn-outlined btnHapusMapel" data-id="`+data.id+`" data-nama="`+data.nama_mapel+`"><i class="mdi mdi-delete"></i></button>
                `
            }}
        ]
    })
// Modal Mapel
    // Add Mapel
    $('#btnTambahMapel').click(function(){
        $('#modalMapel').modal();
        $('#modalMapel .modal-header .modal-title').text('Mapel Baru')
        $('#modalMapel form').prop({'action': '/admin/mapel/create', 'method': 'POST'})
    })
    $('#modalMapel').on('hide.bs.modal', function(){
        $('#modalMapel form').trigger('reset');
    })
    // Export Mapel
    $('#btnEksporMapel').on('click', function(){
        $.ajax({
            type: 'post',
            url: '/admin/mapel/ekspor',
            xhrFields: { responseType: 'blob'},
            headers: headers,
            success: function(res) {
              var blob = res
              const a = document.createElement('a')
              var filename = 'Data-Mapel-'+$('#app-npsn').text()+'.xlsx'
              document.body.appendChild(a)
              a.href = window.URL.createObjectURL(blob)
              a.download = filename
              a.target = '_blank'
              a.click()
              a.remove()
            }
          })
    })

    // Cetak Mapel
    $('#btnCetakMapel').on('click', function(){
        $.ajax({
            url: '/admin/mapel?req=cetak',
            type: 'post',
            headers: headers,
        }).done(res => {
            var data = res.mapels;
            var win = window.open('', '', 'width=600');
            var tr = ''
            var sekolah = res.sekolah
            data.forEach((mapel, index) => {
            tr += `<tr>
                <td>${index+1}</td>
                <td>${mapel.kode_mapel}</td>
                <td>${mapel.nama_mapel}</td>
            </tr>`
            })
            var table = `
            <table>
                <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Mapel</th>
                    <th>Nama Mapel</th>
                </tr>
                </thead>
                <tbody>
                ${tr}
                </tbody>
            </table>
            `

            var html = `
            <!doctype html>
            <html>
                <head>
                <title>Data Mapel ${sekolah.nama_sekolah}</title>
                <style>
                    table, th, td {
                    border: 1px solid black;
                    border-collapse: collapse;
                    }
                    th {
                    text-align: center;
                    }

                    td {
                    padding: 5px;
                    }
                    h2 {
                    text-align:center;
                    margin: 5px;
                    }
                    table#kop,
                    table#kop th,
                    table#kop td {
                        border-top: 0;
                        border-right: 0;
                        border-bottom: 3px double black;
                        border-left: 0;
                    }
                    table {
                        width: 100%;
                        font-size: 10pt;
                    }
                    table#kop tr td {
                        text-align:center;
                    }
                    table#kop tr td h3,
                    table#kop tr td h5 {
                        margin: 0;
                    }
                    @media print {
                    html,body {
                        margin: 0;
                    }

                    main {
                        margin: 20px 1cm 1cm 1cm;
                    }


                    }
                </style>
                </head>
                <body>
                    <header>
                        <table id="kop">
                            <tr>
                                <td>
                                    <span id="logo-kab">
                                    <img class="img" src="../images/malangkab.png" height="100px" />
                                </span>
                                </td>
                                <td>
                                    <h3>PEMERINTAH KABUPATEN ${sekolah.kab.toUpperCase()} </h3>
                                    <h3>DINAS PENDIDIKAN </h3>
                                    <h3>KOORDINATOR WILAYAH DINAS PENDIDIKAN KEC. ${sekolah.kec.toUpperCase()}</h3>
                                    <h3>${sekolah.nama_sekolah.toUpperCase()}</h3>
                                    <h5>${sekolah.alamat+' '+sekolah.desa} - Kode Pos ${sekolah.kode_pos}</h5>
                                    <h5>Telp: ${sekolah.telp}, Email: ${sekolah.email}, Website: ${sekolah.website}</h5>
                                </td>
                            </tr>
                        </table>
                    </header>
                    <main>
                        <h2>DATA MAPEL</h2>
                        ${table}
                    </main>
                </body>
            </html>
            `
            win.document.write(html)
            setTimeout(() => {
                win.print()
            }, 500)

        })
    })

    // Edit Mapel
    $(document).on('click', '.btnEditMapel', function(){
        var mapel = tmapel.row($(this).parents('tr')).data()
        if ( mapel == undefined) {
            var selected_row = $(this).parents('tr')
            selected_row = selected.row.prev()
            mapel = tmapel.row(selected_row).data()
        }
        $('#modalMapel').modal()
        $('#modalMapel .modal-title').text('Edit Data Mapel ' + mapel.nama_mapel)
        $('#formMapel').prop({'action': '/admin/mapel/' + mapel.id, 'method' : 'POST'}).append('<input type="hidden" name="_method" value="PUT"')
        $('#formMapel input[name="kode_mapel"').val(mapel.kode_mapel)
        $('#formMapel input[name="nama_mapel"').val(mapel.nama_mapel)
    })

    $(document).on('click', '.btnHapusMapel', function(){
        var mapel = tmapel.row($(this).parents('tr')).data()
        if ( mapel == undefined ) {
            var selected_row = $(this).parents('tr')
                selectted_row = seelcted.row.prev()
                mapel = tmapel(selected_row).data()
        }

        swal({
            title: 'Yakin Menghapus Mapel ',
            text: mapel.nama_mapel,
            icon: 'warning',
            buttons: true,
            dangerMode: true
        }).then(hapus => {
            if ( hapus ) {
                $.ajax({
                    url: '/admin/mapel/'+mapel.id,
                    type: 'delete',
                    headers: headers
                }).done(res => {
                    swal('success', res.msg, 'success')
                    tmapel.ajax.reload()
                }).catch(err=>{
                    swal('error', err.response.msg, 'error')
                })
            } else {
                swal('info', 'Mapel tidak dihapus.', 'info')
            }
        })
    })
// Manajemen Jadwal
    $('#modalJadwal').on('hide.bs.modal', function(){
        // alert('tes')
        // $('#formJadwal').trigger('reset')
        $('#formJadwal select option[selected]').remove()
        $('#formJadwal input[name="_method"]').remove()
    })
// Datatable Jadwal

    var tjadwal = $('#tablejadwal').DataTable({
        serverSide: true,
        ajax: {
            url: '/admin/jadwal?req=dt',
            type: 'post',
            headers: headers
        },
        columns: [
            {"data": "DT_RowIndex"},
            {"data": "kode_jadwal"},
            {"data": "hari"},
            {"data": "mapels.nama_mapel"},
            {"data": "rombels.nama_rombel"},
            {"data": "gurus.fullname"},
            {"data": "jamke"},
            {"data": "ket"},
            {"data": "status"},
            {"data": null, render: (data) => {
                return `
                    <button class="btn btn-sm btn-warning btn-outlined btnEditJadwal" data-id="`+data.id+`" ><i class="mdi mdi-pencil"></i></button>
                    <button class="btn btn-sm btn-danger btn-outlined btnHapusJadwal" data-id="`+data.id+`" ><i class="mdi mdi-delete"></i></button>
                `
            }},
        ]
    })

    //Hapus Jadwal
    $(document).on('click', '.btnHapusJadwal', function() {
        var jadwal = tjadwal.row($(this).parents('tr')).data()
            if ( jadwal == undefined ) {
                var selected_row = $(this).parents('tr')
                    selected_row = selected_row.prev()
                jadwal = tjadwal(selected_row).data()
            }

        swal({
            title: 'Yakin Hapus Jadwal',
            text: jadwal.kode_jadwal +'?',
            buttons: true,
            dangerMode: true
        }).then(hapus => {
            if ( hapus ) {
                $.ajax({
                   url: '/admin/jadwal/'+jadwal.id,
                   type: 'delete',
                   headers: headers,
                   dataType: 'json'
                }).done(res => {
                    swal('info', res.msg, 'info')
                    tjadwal.ajax.reload()
                }).catch(err=>{
                    swal('error', err.response.msg,' error')
                })
            } else {
                swal('Jadwal tidak dihapus')
            }
        })
    })

    // Edit Jadwal
    $(document).on('click', '.btnEditJadwal', function() {
        var jadwal = tjadwal.row($(this).parents('tr')).data()
            if ( jadwal == undefined ) {
                var selected_row = $(this).parents('tr')
                    selected_row = selected_row.prev()
                jadwal = tjadwal(selected_row).data()
            }

        $('#modalJadwal').modal()
        $('#formJadwal').prop({ 'action' : '/admin/jadwal/'+jadwal.id, 'method': 'POST'}).append(`<input type="hidden" name="_method" value="PUT" />`)

        $('#formJadwal select[name="hari"]').append(`<option value="${jadwal.hari}" selected>${jadwal.hari}</option>`)
        $('#formJadwal select[name="mapel_id"]').append(`<option value="${jadwal.mapel_id}" selected>${jadwal.mapels.nama_mapel}</option>`)
        $('#formJadwal select[name="rombel_id"]').append(`<option value="${jadwal.rombel_id}" selected>${jadwal.rombels.nama_rombel}</option>`)
        $('#formJadwal select[name="guru_id"]').append(`<option value="${jadwal.guru_id}" selected>${jadwal.gurus.fullname}</option>`)
        $('#formJadwal select[name="mulai"]').val(jadwal.jamke.substr(0,1))
        $('#formJadwal select[name="selesai"]').val(jadwal.jamke.substr(2,1))
        $('#formJadwal input[name="ket"]').val(jadwal.ket)

    })

// Tambah Jadwal

    $('#btnTambahJadwal').on('click', function(){
        $('#modalJadwal').modal()
        $('#modalJadwal .modal-title').html('<i class="mdi mdi-calendar"></i> Jadwal Pembelajaran Baru')
        $('#formJadwal').prop({'action': '/admin/jadwal/baru', 'method' : 'post'})
    })

    // Submit Jadwal

    $(document).on('submit', '#formJadwal', function(e) {
        e.preventDefault()
        var jadwal = $(this).serialize()
        $.ajax({
            url: $(this).prop('action'),
            type: $(this).prop('method'),
            headers: headers,
            data: jadwal
        }).done(res => {
            if(res.status == 'error') {
                swal({
                    title: res.msg,
                    text: 'Apakah ingin ditukar?',
                    buttons: true,
                    dangerMode: true
                }).then(tukar => {
                    if ( tukar ) {
                        $('#formJadwal').prop('action', '/admin/jadwal/' + res.id + '?tukar=true')
                        $.ajax({
                            url: $(this).prop('action'),
                            type: $(this).prop('method'),
                            headers: headers,
                            data: jadwal
                        }).done(es => {
                            swal('info', res.msg, 'info')
                            tjadwal.ajax.reload()
                        }).catch(err => {
                            swal('error', err.response.msg, 'error')
                        })
                    }
                })
            } else {
                swal('info', res.msg, 'info')
                tjadwal.ajax.reload()
                // $(this).trigger('reset')
            }

        }).catch(err=>{
            swal(err.response.msg)
        })
    })

    // Ekspor Jadwal
    $('#btnEksporJadwal').on('click', function(){
        $.ajax({
            type: 'post',
            url: '/admin/jadwal/ekspor',
            headers: headers,
            xhrFields: { responseType: 'blob'},
            success: function(res) {
              var blob = res
              const a = document.createElement('a')
              var filename = 'Data-Jadwal-'+$('#app-npsn').text()+'.xlsx'
              document.body.appendChild(a)
              a.href = window.URL.createObjectURL(blob)
              a.download = filename
              a.target = '_blank'
              a.click()
              a.remove()
            }
          })
    })

    // Cetak Jadwal
    $('#btnCetakJadwal').on('click', function(){
        $.ajax({
            url: '/admin/jadwal?req=cetak',
            type: 'post',
            headers: headers,
        }).done(res => {
            var jadwals = res.jadwals;
            var win = window.open('', '', 'width=600');
            var tr = ''
            var sekolah = res.sekolah
            jadwals.forEach((jadwal, index) => {
            tr += `<tr>
                <td>${index+1}</td>
                <td>${jadwal.kode_jadwal}</td>
                <td>${jadwal.hari}</td>
                <td>${jadwal.rombels.nama_rombel}</td>
                <td>${jadwal.mapels.nama_mapel}</td>
                <td>${jadwal.gurus.fullname}</td>
                <td>${jadwal.jamke}</td>
                <td>${jadwal.ket}</td>
                <td>${jadwal.status}</td>
            </tr>`
            })
            var table = `
            <table>
                <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Jadwal</th>
                    <th>Hari</th>
                    <th>Rombel</th>
                    <th>Mapel</th>
                    <th>Guru</th>
                    <th>Jamke</th>
                    <th>Keterangan</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                ${tr}
                </tbody>
            </table>
            `

            var html = `
            <!doctype html>
            <html>
                <head>
                <title>Data Jadwal ${sekolah.nama_sekolah}</title>
                <style>
                    table, th, td {
                    border: 1px solid black;
                    border-collapse: collapse;
                    }
                    th {
                    text-align: center;
                    }

                    td {
                    padding: 5px;
                    }
                    h2 {
                    text-align:center;
                    margin: 5px auto 20px;
                    }

                    table#kop,
                    table#kop th,
                    table#kop td {
                        border-top: 0;
                        border-right: 0;
                        border-bottom: 3px double black;
                        border-left: 0;
                    }
                    table {
                        width: 100%;
                        font-size: 10pt;
                    }
                    table#kop tr td {
                        text-align:center;
                    }
                    table#kop tr td h1,
                    table#kop tr td h2,
                    table#kop tr td p {
                        margin: 0;
                    }

                    #logo-kab {
                        position: absolute;
                        left: 50px;
                    }
                    #logo-kab img {
                        width: 125px;
                    }
                    @media print {
                        html,body {
                            margin: 0;
                        }

                        main {
                            margin: 20px 1cm 1cm 1cm;
                        }

                        #logo-kab {
                            left: 40px;
                        }


                    }
                </style>
                </head>
                <body>
                    <header>
                        <table id="kop">
                            <tr>
                                <td>
                                    <span id="logo-kab">
                                        <img class="img" src="../images/malangkab.png" width="75px" />
                                    </span>
                                    <h1>PEMERINTAH KABUPATEN ${sekolah.kab.toUpperCase()} </h1>
                                    <h2>DINAS PENDIDIKAN </h2>
                                    <h2>KOORDINATOR WILAYAH DINAS PENDIDIKAN KEC. ${sekolah.kec.toUpperCase()}</h2>
                                    <h1>${sekolah.nama_sekolah.toUpperCase()}</h1>
                                    <h5>${sekolah.alamat+' '+sekolah.desa} - Kode Pos ${sekolah.kode_pos}</h5>
                                    <h5>Telp: ${sekolah.telp}, Email: ${sekolah.email}, Website: ${sekolah.website}</h5>
                                </td>
                            </tr>
                        </table>
                    </header>
                    <main>
                        <h2>DATA JADWAL</h2>
                        ${table}
                    </main>
                </body>
            </html>
            `
            win.document.write(html)
            setTimeout(() => {
                win.print()
            }, 500)

        })
    })

// Manajemen Guru/User
// Datatable Guru/User
    var tguru = $('#tableguru').DataTable({
        serverSide: true,
        ajax: {
            url: '/admin/guru?req=dt',
            type: 'post',
            headers: headers
        },
        columns: [
            {"data": "DT_RowIndex"},
            {"data": "nip"},
            {"data": "username"},
            {"data": "email"},
            {"data": "fullname"},
            {"data": "level"},
            {"data": "role"},
            {"data": "hp"},
            {"data": null, render: (data) => {
                return `
                    <button class="btn btn-sm btn-warning btn-outlined btnEditGuru" data-id="`+data.id+`" data-nama="`+data.fullname+`"><i class="mdi mdi-pencil"></i></button>
                    <button class="btn btn-sm btn-danger btn-outlined btnHapusGuru" data-id="`+data.id+`" data-nama="`+data.fullname+`"><i class="mdi mdi-delete"></i></button>
                `
            }},
        ]
    })
// Tambah Guru
    $('#btnTambahGuru').click(function(){
        $('#modalUser .modal-header .modal-title').html('<h3>Buat Data Guru</h3>')
        $('#modalUser form').prop({'action': '/admin/guru/tambah', 'method': 'POST'})
        $('#modalUser').modal()

    })

// Expor Guru
$('#btnEksporGuru').click(function(){
    $.ajax({
        type: 'get',
        url: '/admin/users/ekspor',
        xhrFields: { responseType: 'blob'},
        success: function(res) {
          var blob = res
          const a = document.createElement('a')
          var filename = 'Data-Guru-'+$('#app-npsn').text()+'.xlsx'
          document.body.appendChild(a)
          a.href = window.URL.createObjectURL(blob)
          a.download = filename
          a.target = '_blank'
          a.click()
          a.remove()
        }
      })
})
// Cetak Data Guru
$('#btnCetakGuru').click(function(){
    $.ajax({
        type: 'get',
        url: '/admin/users?req=cetak',
        dataType: 'json',
        success: function(res) {
          var data = res.gurus;
          var win = window.open('', '', 'width=600');
          var tr = ''
          var sekolah = res.sekolah
          console.log(sekolah)
          data.forEach((guru, index) => {
            tr += `<tr>
              <td>${index+1}</td>
              <td>${guru.nip}</td>
              <td>${guru.username}</td>
              <td>${guru.fullname}</td>
              <td>${guru.email}</td>
              <td>${guru.hp}</td>
              <td>${guru.level}</td>
              <td>${guru.role}</td>
            </tr>`
          })
          var table = `
            <table>
              <thead>
                <tr>
                  <th>No</th>
                  <th>NIP</th>
                  <th>Username</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>No. HP</th>
                  <th>Level</th>
                  <th>Role</th>
                </tr>
              </thead>
              <tbody>
                ${tr}
              </tbody>
            </table>
          `

          var html = `
            <!doctype html>
            <html>
              <head>
                <title>Data Guru dan Staf Sekolah ${sekolah.nama_sekolah}</title>
                <style>
                  table, th, td {
                    border: 1px solid black;
                    border-collapse: collapse;
                  }
                  th {
                    text-align: center;
                  }

                  td {
                    padding: 5px;
                  }
                  h2 {
                    text-align:center;
                    margin: 5px;
                  }
                  table#kop,
                  table#kop th,
                  table#kop td {
                      border-top: 0;
                      border-right: 0;
                      border-bottom: 3px double black;
                      border-left: 0;
                  }
                  table {
                      width: 100%;
                      font-size: 10pt;
                  }
                  table#kop tr td {
                      text-align:center;
                  }
                  table#kop tr td h3,
                  table#kop tr td h5 {
                      margin: 0;
                  }
                  @media print {
                    html,body {
                      margin: 0;
                    }

                    main {
                        margin: 20px 1cm 1cm 1cm;
                    }


                  }
                </style>
              </head>
              <body>
                  <header>
                      <table id="kop">
                          <tr>
                              <td>
                                  <span id="logo-kab">
                                  <img class="img" src="../images/malangkab.png" height="100px" />
                              </span>
                              </td>
                              <td>
                                  <h3>PEMERINTAH KABUPATEN ${sekolah.kab.toUpperCase()} </h3>
                                  <h3>DINAS PENDIDIKAN </h3>
                                  <h3>KOORDINATOR WILAYAH DINAS PENDIDIKAN KEC. ${sekolah.kec.toUpperCase()}</h3>
                                  <h3>${sekolah.nama_sekolah.toUpperCase()}</h3>
                                  <h5>${sekolah.alamat+' '+sekolah.desa} - Kode Pos ${sekolah.kode_pos}</h5>
                                  <h5>Telp: ${sekolah.telp}, Email: ${sekolah.email}, Website: ${sekolah.website}</h5>
                              </td>
                          </tr>
                      </table>
                  </header>
                  <main>
                      <h2>DATA GURU DAN STAF ${sekolah.nama_sekolah}</h2>
                      ${table}
                  </main>
              </body>
            </html>
          `
          win.document.write(html)
          setTimeout(() => {
              win.print()
          }, 500)
        }
      })
})
// Hapus Guru
    $(document).on('click', '.btnHapusGuru', function(){
        var id = $(this).data('id')
        var data = tguru.row($(this).parents('tr')).data();
        if(data == undefined) {
            var selected_row = $(this).parents('tr');
            if(selected_row.hasClass('child')) {
                selected_row = selected_row.prev();
                data = tguru.row(selected_row).data();
            }
        }

        swal({
            title: "Yakin menghapus data guru:",
            text: data.fullname,
            icon: 'warning',
            buttons: true,
            dangerMode: true
        })
        .then(hapus => {
            if ( hapus ) {
                $.ajax({
                    type: 'delete',
                    url: '/admin/guru/'+data.id,
                    headers: headers
                }).done(res => {
                    swal({text: res.msg})
                    tguru.draw()
                }).catch(err => {
                    swal({text: err.response.msg})
                })
            } else {
                swal("Data tidak dihapus")
            }
        })
    })
// Edit Guru
    $(document).on('click', '.btnEditGuru', function(){
        var id = $(this).data('id')
        var data = tguru.row($(this).parents('tr')).data();
        if(data == undefined) {
            var selected_row = $(this).parents('tr');
            if(selected_row.hasClass('child')) {
                selected_row = selected_row.prev();
                data = tguru.row(selected_row).data();
            }
        }

        $('#modalUser .modal-header .modal-title').html('<h3>Edit Data '+data.fullname+'</h3>')
        $('#modalUser form').prop({'action': '/admin/guru/'+data.id, 'method': 'POST'}).prepend('<input type="hidden" name="_method" value="put" />')
        $('#formUser input[name="nip"]').val(data.nip)
        $('#formUser input[name="username"]').val(data.username)
        $('#formUser input[name="email"]').val(data.email)
        $('#formUser input[name="password"]').prop("placeholder", "Password")
        $('#formUser input[name="fullname"]').val(data.fullname)
        $('#formUser select[name="level"]').val(data.level)
        $('#formUser input[name="role"]').val(data.role)
        $('#formUser input[name="hp"]').val(data.hp)
        $('#modalUser').modal()
    })
    // Manajemen Pembelajaran
    // Datatable Pembelajaran
    var tpembelajaran = $('#tablepembelajaran').DataTable({
        serverSide: true,
        ajax: {
            url: '/admin/pembelajaran?req=dt',
            type: 'post',
            headers: headers
        },
        columns: [
            {"data": "DT_RowIndex"},
            {"data": "kode_pembelajaran"},
            {"data": "rombels.nama_rombel"},
            {"data": "mapels.nama_mapel"},
            {"data": "jamke"},
            {"data": "gurus.fullname"},
            {"data": "status"},
            {"data": "mode"},
            {"data": "ket"},
            {"data": null, render: (data) => {
                return (data.tematik == true ) ? 'Tematik' : 'Mapel'
            }},
            {"data": null, render: (data) => {
                return "Opsi"
            }},
        ]
    })

    // AKtifkan Jadwal
    $('#btnAktifkanPembelajaran').on('click', function(){
        $.ajax({
            headers: headers,
            type: 'post',
            url: '/admin/pembelajaran/aktifkan',
            dataType: 'json',
            success: (res) => {
                swal(res.msg);
                tpembelajaran.ajax.reload();
            }
        })
    })

    $('#btnTutupPembelajaran').on('click', function() {
        $.ajax({
            type: 'post',
            url: '/admin/pembelajaran/tutup',
            headers: headers
        }).done(res=>{
            swal('Info', res.msg, 'info')
            tpembelajaran.ajax.reload()

        }).catch(err => {
            swal('error', err.response.msg)
        })
    })
    $('#btnResetPembelajaran').click(function(){
        swal({
            title: 'Yakin mereset pembelajaran?',
            text: 'Data Pembelajaran Hari Ini Akan Dihapus.',
            buttons: true,
            dangerMode: true
        }).then(reset => {
            if ( reset ) {
                $.ajax({
                    url: '/admin/pembelajaran',
                    type: 'delete',
                    headers: headers,
                    dataType: 'json'
                }).done(res => {
                    swal('info', res.msg, 'info')
                    tpembelajaran.ajax.reload()
                }).catch(err=>{
                    swal('error', err.response.msg, 'error')
                })
            } else {
                swal('info', 'Pembelajaran hari ini tidak jadi direset', 'info')
            }
        })


    })

    var tpemetaan = $('#tablepemetaan')
        .on('init.dt', function(){
            $('.card-title i.mdi').removeClass('mdi-loading mdi-spin').addClass('mdi-map')
        })
        .on('draw.dt', function(){
            $('.card-title i.mdi').removeClass('mdi-loading mdi-spin').addClass('mdi-map')
        })
        .DataTable({
            serverSide: true,
            ajax: {
                url: '/admin/pemetaan?req=dt',
                type: 'post',
                headers: headers,
                beforeSend: function(){
                    $('.card-title i.mdi').removeClass('mdi-map').addClass('mdi-loading mdi-spin')
                }
            },
            columns: [
                {"data": "DT_RowIndex"},
                {"data": "tingkat"},
                {"data": "mapel_id"},
                {"data": "subtema_id"},
                {"data": "kd_id"},
                {"data": "semester_id"},
                {"data": "keyword"},
                {"data": "sekolah_id"},
                {"data": null, render: (data) => {
                    return "Opsi";
                }},
            ]
    })

});
