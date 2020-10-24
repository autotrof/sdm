@extends('layout')

@section('css')

@stop

@section('content')
	<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Pengguna</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Pengguna</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Data Pengguna</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12" style="margin-bottom: 10px;">
              <button class="btn btn-primary" type="button" onclick="tambahUser()">Tambah User</button>
              <button class="btn btn-danger" type="button" id="button-hapus-beberapa" onclick="hapusBeberapaUser()" disabled>Hapus User</button>
            </div>
            <div class="col-md-12">
              <table class="table table-bordered" id="table">
                <thead>
                  <tr>
                    <th>
                      <input type="checkbox" id="head-cb">
                    </th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Dibuat Pada</th>
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


  <div class="modal fade" id="modal-create">
    <div class="modal-dialog modal-lg">
      <form method="post" id="form-create" action="{{url('user')}}" enctype="multipart/form-data" class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Data User Baru</h4>
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
              <label>Email</label>
              <input type="email" name="email" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label>Password</label>
              <input type="password" name="password" value="12345" class="form-control" required>
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
      <form method="post" id="form-create" action="{{url('user')}}/edit" enctype="multipart/form-data" class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Data User</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {{csrf_field()}}
          <input type="hidden" name="id">
          <div class="row">
            <div class="col-md-12">
              <label>Nama <small class="text-danger">*</small></label>
              <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label>Email</label>
              <input type="email" name="email" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label>Password</label>
              <input type="password" name="password" value="" placeholder="kosongkan jika tidak ingin mengganti password" class="form-control">
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
      url: "{{url('')}}/user/data",
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
          if(row.id!={{Auth::user()->id}}){
            return `<input type="checkbox" class="cb-child" value="${row.id}">`;
          }else{
            return ''
          }
        }
      },
      {
        "targets": 1,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          list_user[row.id] = row;
          return row.nama;
        }
      },
      {
        "targets": 2,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          return row.email;
        }
      },
      {
        "targets": 3,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          return row.created_at;
        }
      },
      {
        "targets": 4,
        "sortable":false,
        "render": function(data, type, row, meta){
          let tampilan = `
            <button class="btn btn-warning" type="button" onclick="editUser(${row.id})">Edit</button>
          `;
          if(row.id!={{Auth::user()->id}}){
            tampilan+=`<button class="btn btn-danger" type="button" onclick="hapus(${row.id})">Hapus</button>`
          }
          return tampilan
        }
      }
      
    ]
  });

  function tambahUser() {
    $("#modal-create").modal('show')
  }

  $("#modal-create form").on('submit',function(e){
    e.preventDefault()
    $(this).ajaxSubmit({
      success:function(res){
        table.ajax.reload(null,false)
        $("#modal-create").modal('hide')
        $("#modal-create input").val('')
        $("#modal-create input[name='password']").val('12345')
      }
    })
  })

  $("#modal-edit form").on('submit',function(e){
    e.preventDefault()
    $(this).ajaxSubmit({
      success:function(res){
        table.ajax.reload(null,false)
        $("#modal-edit").modal('hide')
        $("#modal-edit input").val('')
      }
    })
  })

  function hapus(id) {
    const user = list_user[id]
    if(user){
      const _c = confirm('apakah anda yakin akan menghapus user '+user.nama+' ?')
      if(_c===true){
        $.ajax({
          url:"{{url('')}}/user/delete/"+id,
          success:function(res){
            if(res){
              table.ajax.reload(null,false)
            }else{
              alert("Terjadi kesalahan")
            }
          }
        })
      }
    }
  }

  function editUser(id) {
    const user = list_user[id]
    $("#modal-edit input[name='nama']").val(user.nama)
    $("#modal-edit input[name='email']").val(user.email)
    $("#modal-edit input[name='id']").val(id)
    $("#modal-edit").modal('show')
  }

  $("#head-cb").on('click',function(){
    var isChecked = $("#head-cb").prop('checked')
    $(".cb-child").prop('checked',isChecked)
    $("#button-hapus-beberapa").prop('disabled',!isChecked)
  })

  $("#table tbody").on('click','.cb-child',function(){
    if($(this).prop('checked')!=true){
      $("#head-cb").prop('checked',false)
    }

    let semua_checkbox = $("#table tbody .cb-child:checked")
    let button_hapus_terpilih = (semua_checkbox.length>0)
    $("#button-hapus-beberapa").prop('disabled',!button_hapus_terpilih)
  })

  function hapusBeberapaUser() {
    const _c = confirm("Anda yakin akan menghapus beberapa user tersebut ?")
    if(_c===true){
      let semua_id = []
      let checkbox_terpilih = $("#table tbody .cb-child:checked")
      $.each(checkbox_terpilih,function(index,elm){
        semua_id.push(elm.value)
      })
      $.ajax({
        url:"{{url('')}}/user/hapus_beberapa",
        method:'post',
        data:{ids:semua_id},
        success:function(res){
          table.ajax.reload(null,false)
          $("#button-hapus-beberapa").prop('disabled',true)
          $("#head-cb").prop('checked',false)
        }
      })
    }
    
  }

  function nonAktifkanTerpilih () {
    
    let semua_id = []
    $.each(checkbox_terpilih,function(index,elm){
      semua_id.push(elm.value)
    })
    $("#button-hapus-beberapa").prop('disabled',true)
    $.ajax({
      url:"{{url('')}}/karyawan/non-aktifkan",
      method:'post',
      data:{ids:semua_id},
      success:function(res){
        table.ajax.reload(null,false)
        $("#button-nonaktif-all").prop('disabled',false)
        $("#head-cb").prop('checked',false)
      }
    })
  }
</script>
@stop