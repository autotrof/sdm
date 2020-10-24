@extends('layout')

@section('css')

@stop

@section('content')
	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Organisasi</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Organisasi</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <button class="btn btn-primary" style="margin-bottom: 1rem;" data-toggle="modal" data-target="#modal-create">Tambah Organisasi</button>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Struktur Organisasi</h3>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <button class="btn btn-primary" type="button" onclick="editOrg()">Edit</button>
                    <button class="btn btn-danger" type="button" onclick="hapusOrg()">Hapus</button>
                    <div id="org"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <div class="modal fade" id="modal-create">
      <div class="modal-dialog modal-lg">
        <form method="post" id="form-create" action="{{url('struktur_organisasi')}}" class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Tambah Data Organisasi</h4>
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
                <label>Organisasi Induk</label>
                <select name="parent_id" id="org-induk" class="form-control">
                  <option value="">Pilih organisasi induk jika ada</option>
                </select>
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
        <form method="post" id="form-edit" action="{{url('struktur_organisasi')}}/edit" class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edit Data Organisasi</h4>
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
                <label>Organisasi Induk</label>
                <select name="parent_id" id="edit-org-induk" class="form-control">
                  <option value="">Pilih organisasi induk jika ada</option>
                </select>
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
  let list_organisasi = [];
  let focused_org = null
  let org_chart = $('#org').orgchart({
    'data' : '{{url('')}}/struktur_organisasi/data',
    'nodeContent': 'title',
    'exportButton': true,
    'exportFilename': 'Struktur Organisasi',
    'createNode': function($node, data) {
      $node[0].id = `org-${data.id}`
    }
  });

  org_chart.$chartContainer.on('click', '.node', function() {
    var $this = $(this);
    // $('#selected-node').val($this.find('.title').text()).data('node', $this);
    // console.log($this[0].id)
    const real_id = $this[0].id.substring(4)
    focused_org = real_id
  });


  $("#form-create").on('submit',function(e){
    e.preventDefault()
    

    $("#form-create").ajaxSubmit({
      success:function(res){
        // table.ajax.reload(null,false)
        // SET SEMUA KE DEFAULT
        $("#form-create input:not([name='_token'])").val('')
        $("#form-create textarea").val('')
        $("#form-create select:not([name='status'])").val('')
        $("#modal-create").modal('hide')
        org_chart.init({'data' : '{{url('')}}/struktur_organisasi/data'})
        focused_org = null
      }
    })
  })

  function editOrg() {
    if(focused_org){
      $.ajax({
        url:"{{url('')}}/struktur_organisasi/detail/"+focused_org,
        success:function(res){
          $("#modal-edit").modal('show')
          $("#modal-edit [name='nama']").val(res.nama)
          $("#modal-edit [name='id']").val(res.id)
          $("#modal-edit [name='parent_id']").append(`
            <option selected value="${res.parent_id}">${res.parents.nama}</option>
          `)
        }
      })
    }
  }

  $("#modal-edit form").on('submit',function(e){
    e.preventDefault()
    $(this).ajaxSubmit({
      success:function(res){
        $("#modal-edit").modal('hide')
        org_chart.init({'data' : '{{url('')}}/struktur_organisasi/data'})
        focused_org = null
      }
    })
  })

  function hapusOrg() {
    if(focused_org){
      $.ajax({
        url:'{{url('')}}/struktur_organisasi/delete/'+focused_org,
        success:function(res){
          org_chart.init({'data' : '{{url('')}}/struktur_organisasi/data'})
          focused_org = null
        }
      })
    }
  }

  $('#org-induk,#edit-org-induk').select2({
    ajax: {
      url: '{{url('')}}/struktur_organisasi/list',
      data: function (params) {
        var query = {
          search: params.term
        }
        return query;
      }
    }
  });
</script>
@stop