@extends('layout')

@section('css')

@stop

@section('content')
	<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Karyawan {{$jenis}}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Karyawan</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <button class="btn btn-primary" style="margin-bottom: 1rem;" data-toggle="modal" data-target="#modal-create">Tambah Karyawan</button>
          <button class="btn btn-warning" style="margin-bottom: 1rem;" data-toggle="modal" data-target="#modal-import">Import Karyawan Excel</button>
          <a download class="btn btn-success" style="margin-bottom: 1rem;" href="{{url('')}}/karyawan/export">Export Karyawan Excel</a>
          <button type="button" id="button-nonaktif-all" disabled onclick="nonAktifkanTerpilih()" class="btn btn-danger" style="margin-bottom: 1rem;">Non Aktifkan</button>
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Karyawan</h3>
            </div>
            <div class="card-body">
              <table id="table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>
                    <input type="checkbox" id="head-cb">
                  </th>
                  <th>NIK</th>
                  <th>Nama</th>
                  <th>KTP</th>
                  <th>TELP</th>
                  <th>ORG</th>
                  <th>###</th>
                </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="modal fade" id="modal-create">
    <div class="modal-dialog modal-lg">
      <form method="post" id="form-create" action="{{url('karyawan')}}" enctype="multipart/form-data" class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Data Karyawan Baru</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {{csrf_field()}}
          <div class="row">
            <div class="col-md-12">
              <label>Nama <small class="text-danger">*</small></label>
              <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label>Nomor KTP <small class="text-danger">*</small></label>
              <input type="text" name="nomor_ktp" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label>NIK <small class="text-danger">*</small></label>
              <input type="text" name="nik" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label>Telp <small class="text-danger">*</small></label>
              <input type="text" name="telp" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label>Email</label>
              <input type="email" name="email" class="form-control">
            </div>
            <div class="col-md-12">
              <label>Detail Alamat</label>
              <textarea class="form-control" name="detail_alamat"></textarea>
            </div>
            <div class="col-md-12">
              <label>Status</label>
              <select name="status" class="form-control" required>
                <option value="aktif">Aktif</option>
                <option value="non aktif">Non Aktif</option>
              </select>
            </div>
            <div class="col-md-12">
              <label>Nomor BPJS Kesehatan</label>
              <input type="text" name="nomor_bpjs_kesehatan" class="form-control">
            </div>
            <div class="col-md-12">
              <label>Nomor BPJS Ketenagakerjaan</label>
              <input type="text" name="nomor_bpjs_ketenagakerjaan" class="form-control">
            </div>
            <div class="col-md-12">
              <label>Organisasi</label>
              <select name="organisasi_id" class="form-control" required>
                <option value="">Pilih Organisasi</option>
                @foreach($list_organisasi as $organisasi)
                <option value="{{$organisasi->id}}">{{$organisasi->nama}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-12" style="margin-top: 4px;">
              <input type="file" name="foto" accept="image/*">
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>

  <div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-lg">
      <form method="post" id="form-edit" action="{{url('karyawan')}}" enctype="multipart/form-data" class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Data Karyawan Baru</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {{csrf_field()}}
          <input type="hidden" name="id">
          {{method_field('PATCH')}}
          <div class="row">
            <div class="col-md-12">
              <label>Nama <small class="text-danger">*</small></label>
              <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label>Nomor KTP <small class="text-danger">*</small></label>
              <input type="text" name="nomor_ktp" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label>NIK <small class="text-danger">*</small></label>
              <input type="text" name="nik" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label>Telp <small class="text-danger">*</small></label>
              <input type="text" name="telp" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label>Email</label>
              <input type="email" name="email" class="form-control">
            </div>
            <div class="col-md-12">
              <label>Detail Alamat</label>
              <textarea class="form-control" name="detail_alamat"></textarea>
            </div>
            <div class="col-md-12">
              <label>Status</label>
              <select name="status" class="form-control" required>
                <option value="aktif">Aktif</option>
                <option value="non aktif">Non Aktif</option>
              </select>
            </div>
            <div class="col-md-12">
              <label>Nomor BPJS Kesehatan</label>
              <input type="text" name="nomor_bpjs_kesehatan" class="form-control">
            </div>
            <div class="col-md-12">
              <label>Nomor BPJS Ketenagakerjaan</label>
              <input type="text" name="nomor_bpjs_ketenagakerjaan" class="form-control">
            </div>
            <div class="col-md-12">
              <label>Organisasi</label>
              <select name="organisasi_id" class="form-control" required>
                <option value="">Pilih Organisasi</option>
                @foreach($list_organisasi as $organisasi)
                <option value="{{$organisasi->id}}">{{$organisasi->nama}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-12" style="margin-top: 4px;">
              <input type="file" name="foto" accept="image/*">
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>

  <div class="modal fade" id="modal-import">
    <div class="modal-dialog modal-lg">
      <form method="post" id="form-import" action="{{url('karyawan')}}" enctype="multipart/form-data" class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Import Data Karyawan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {{method_field('PUT')}}
          {{csrf_field()}}
          <div class="row">
            <div class="col-md-12">
              <p>Import data karyawan sesuai format contoh berikut.<br/><a href="{{url('')}}/excel-karyawan.xlsx"><i class="fas fa-download"></i> File Contoh Excel Karyawan</a></p>
            </div>
            <div class="col-md-12">
              <label>File Excel Karyawan</label>
              <input type="file" name="excel-karyawan" required>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>

@stop

@section('js')
<script type="text/javascript">
  let list_karyawan = [];
  let yangDiCheck = 0;

  const table = $('#table').DataTable({
    "pageLength": 100,
    "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'semua']],
    "bLengthChange": true,
    "bFilter": true,
    "bInfo": true,
    "processing":true,
    "bServerSide": true,
    "order": [[ 1, "desc" ]],
    "ajax":{
      url: "{{url('')}}/karyawan/data/{{$jenis}}",
      type: "POST"
    },
    columnDefs: [
      { targets: '_all', visible: true },
      {
        "targets": 0,
        "class":"text-nowrap",
        "sortable":false,
        "render": function(data, type, row, meta){
          return `<input type="checkbox" class="cb-child" value="${row.id}">`;
        }
      },
      {
        "targets": 1,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          list_karyawan[row.id] = row;
          return row.nik;
        }
      },
      {
        "targets": 2,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          return row.nama;
        }
      },
      {
        "targets": 3,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          return row.nomor_ktp;
        }
      },
      {
        "targets": 4,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          return row.telp;
        }
      },
      {
        "targets": 5,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          return row.nama_organisasi;
        }
      },
      {
        "targets": 6,
        "sortable":false,
        "render": function(data, type, row, meta){
          let tampilan = `<button onclick="showDetailKaryawan('${row.id}')" class="btn btn-sm btn-warning btn-block">Edit</button>`;
          if(row.status=='aktif'){
            tampilan+=`<button onclick="toggleStatus('${row.id}')" class="btn btn-sm btn-danger btn-block">Nonaktifkan</button>`
          }else{
            tampilan+=`<button onclick="toggleStatus('${row.id}')" class="btn btn-sm btn-success btn-block">Aktifkan</button>`
          }
          return tampilan;
        }
      }
    ]
  });

  $("#form-create").on('submit',function(e){
    e.preventDefault()
    

    $("#form-create").ajaxSubmit({
      success:function(res){
        table.ajax.reload(null,false)
        // SET SEMUA KE DEFAULT
        $("#form-create input:not([name='_token'])").val('')
        $("#form-create textarea").val('')
        $("#form-create select:not([name='status'])").val('')


        $("#modal-create").modal('hide')
      }
    })
  })

  function showDetailKaryawan(id) {
    const karyawan = list_karyawan[id]
    $("#modal-edit").modal('show')
    // SET SEMUA KE DEFAULT
    $("#form-edit input:not([name='_token'])").val('')
    $("#form-edit textarea").val('')
    $("#form-edit select:not([name='status'])").val('')


    $("#form-edit [name='id']").val(id)
    $("#form-edit [name='nama']").val(karyawan.nama)
    $("#form-edit [name='nomor_ktp']").val(karyawan.nomor_ktp)
    $("#form-edit [name='nik']").val(karyawan.nik)
    $("#form-edit [name='telp']").val(karyawan.telp)
    $("#form-edit [name='email']").val(karyawan.email)
    $("#form-edit [name='detail_alamat']").val(karyawan.detail_alamat)
    $("#form-edit [name='status']").val(karyawan.status)
    $("#form-edit [name='nomor_bpjs_kesehatan']").val(karyawan.nomor_bpjs_kesehatan)
    $("#form-edit [name='nomor_bpjs_ketenagakerjaan']").val(karyawan.nomor_bpjs_ketenagakerjaan)
    $("#form-edit [name='organisasi_id']").val(karyawan.organisasi_id)
  }

  $("#form-edit").on('submit',function(e){
    e.preventDefault()
    $("#form-edit").ajaxSubmit({
      success:function(res){
        if(res===true){
          alert("BERHASIL UPDATE KARYAWAN")
          table.ajax.reload(null,false)
          $("#modal-edit").modal('hide')
        }
      }
    })
  })

  function toggleStatus(id) {
    const _c = confirm("Anda yakin akan melakukan operasi ini ?")
    if(_c===true){
      let karyawan = list_karyawan[id]
      let status_update = ''
      if(karyawan.status=='aktif'){
        status_update = 'non aktif'
      }else{
        status_update = 'aktif'
      }
      $.ajax({
        url:'{{url('')}}/karyawan/update_status',
        method:'POST',
        data:{id:id,status:status_update,_token:'{{csrf_token()}}'},
        success:function(res){
          if(res===true){
            table.ajax.reload(null,false)
          }
        }
      })
    }
  }

  $("#head-cb").on('click',function(){
    var isChecked = $("#head-cb").prop('checked')
    $(".cb-child").prop('checked',isChecked)
    $("#button-nonaktif-all").prop('disabled',!isChecked)
  })

  $("#table tbody").on('click','.cb-child',function(){
    if($(this).prop('checked')!=true){
      $("#head-cb").prop('checked',false)
    }

    let semua_checkbox = $("#table tbody .cb-child:checked")
    let button_non_aktif_status = (semua_checkbox.length>0)
    $("#button-nonaktif-all").prop('disabled',!button_non_aktif_status)
  })

  function nonAktifkanTerpilih () {
    let checkbox_terpilih = $("#table tbody .cb-child:checked")
    let semua_id = []
    $.each(checkbox_terpilih,function(index,elm){
      semua_id.push(elm.value)
    })
    $("#button-nonaktif-all").prop('disabled',true)
    $.ajax({
      url:"{{url('')}}/karyawan/non-aktifkan",
      method:'post',
      data:{ids:semua_id},
      success:function(res){
        table.ajax.reload(null,false)
        $("#button-nonaktif-all").prop('disabled',false)
      }
    })
    // console.log(semua_id)
    // console.log("YANG TERPILIH AKAN DINONAKTIFKAN")
  }
</script>
@stop