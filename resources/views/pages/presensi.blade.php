@extends('layout')

@section('css')

@stop

@section('content')
	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Presensi</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Presensi</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Data Presensi</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12" style="margin-bottom: 10px;">
              <button class="btn btn-warning" data-toggle="modal" data-target="#modal-import">Import Presensi Excel</button>
              <button class="btn btn-danger" type="button" id="button-hapus-beberapa" onclick="hapusBeberapaPresensi()" disabled>Hapus Presensi</button>
            </div>
            <div class="col-md-12">
              <table class="table table-bordered" id="table">
                <thead>
                  <tr>
                    <th>
                      <input type="checkbox" id="head-cb">
                    </th>
                    <th>Tanggal</th>
                    <th>Karyawan</th>
                    <th>Masuk</th>
                    <th>Pulang</th>
                    <th>Status</th>
                    <th width="130"></th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    </section>

    <div class="modal fade" id="modal-import">
      <div class="modal-dialog modal-lg">
        <form method="post" id="form-import" action="{{url('presensi')}}" enctype="multipart/form-data" class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Import Data Presensi</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            {{method_field('PUT')}}
            {{csrf_field()}}
            <div class="row">
              <div class="col-md-12">
                <p>Import data presensi sesuai format contoh berikut.<br/><a href="{{url('')}}/excel-presensi.xlsx"><i class="fas fa-download"></i> File Contoh Excel Presensi</a></p>
              </div>
              <div class="col-md-12">
                <label>File Excel Presensi</label>
                <input type="file" name="excel-presensi" required>
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
<script>
  let list_user = [];
  
  const table = $('#table').DataTable({
    "pageLength": 100,
    "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'semua']],
    "bLengthChange": true,
    "bFilter": true,
    "bInfo": true,
    "processing":true,
    "bServerSide": true,
    "order": [[ 1, "desc" ]],
    "autoWidth": false,
    "ajax":{
      url: "{{url('')}}/presensi/data",
      type: "POST"
    },
    "initComplete": function(settings, json) {
      const all_checkbox_view = $("#row-tampilan div input[type='checkbox']")
      $.each(all_checkbox_view,function(key,checkbox){
        let kolom = $(checkbox).data('kolom')
        let is_checked = checkbox.checked
        table.column(kolom).visible(is_checked)
      })
      setTimeout(function(){
        table.columns.adjust().draw();
      },3000)
    },
    columnDefs: [
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
          list_user[row.id] = row;
          return row.tanggal;
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
          return row.masuk.substr(11,5);
        }
      },
      {
        "targets": 4,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          return row.pulang.substr(11,5);
        }
      },
      {
        "targets": 5,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          return row.status;
        }
      },
      {
        "targets": 6,
        "sortable":false,
        "render": function(data, type, row, meta){
          let tampilan = `
            <button class="btn btn-warning" type="button" onclick="editPresensi(${row.id})">Edit</button>
          `;
          if(row.id!={{Auth::user()->id}}){
            tampilan+=`<button class="btn btn-danger" type="button" onclick="hapus(${row.id})">Hapus</button>`
          }
          return tampilan
        }
      }
      
    ]
  });
</script>
@stop