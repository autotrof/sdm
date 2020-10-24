<!DOCTYPE html>
<html>
<head>
  <?php
  $PARENTTAG = isset($PARENTTAG)?$PARENTTAG:'';
  $CHILDTAG = isset($CHILDTAG)?$CHILDTAG:'';
  ?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{$TITLE??'SDM'}}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url('')}}/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{url('')}}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{url('')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{url('')}}/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('')}}/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{url('')}}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  {{-- DATATABLE --}}
  <link rel="stylesheet" href="{{url('')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{url('')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{url('')}}/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="{{url('')}}/plugins/summernote/summernote-bs4.css">
  <!-- select2 -->
  <link rel="stylesheet" type="text/css" href="{{url('')}}/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" type="text/css" href="{{url('')}}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{url('')}}/plugins/orgchart/css/jquery.orgchart.min.css">
  <style type="text/css">
    .divider{
      width: 100%;
      height: 1px;
      background: #BBB;
      margin: 1rem 0;
    }
    .select2-selection.select2-selection--single{
      height: 40px;
    }
  </style>
  @yield('css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      {{-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
      <span class="brand-text font-weight-light">SDM</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        {{-- <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div> --}}
        <div class="info">
          <a href="#" class="d-block">Admin</a>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item has-treeview <?=$PARENTTAG=='karyawan'?'menu-open':''?>">
            <a href="#" class="nav-link <?=$PARENTTAG=='karyawan'?'active':''?>">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Karyawan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('')}}/karyawan/aktif" class="nav-link <?=$CHILDTAG=='aktif'?'active':''?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Karyawan Aktif</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('')}}/karyawan/non-aktif" class="nav-link <?=$CHILDTAG=='non-aktif'?'active':''?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Karyawan Non Aktif</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{url('')}}/presensi" class="nav-link <?=$PARENTTAG=='presensi'?'active':''?>">
              <i class="nav-icon fas fa-chevron-right"></i>
              <p>
                Presensi
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('')}}/struktur_organisasi" class="nav-link <?=$PARENTTAG=='organisasi'?'active':''?>">
              <i class="nav-icon fas fa-chevron-right"></i>
              <p>
                Struktur Organisasi
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('')}}/user" class="nav-link <?=$PARENTTAG=='user'?'active':''?>">
              <i class="nav-icon fas fa-chevron-right"></i>
              <p>
                User
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('')}}/pengaturan" class="nav-link <?=$PARENTTAG=='pengaturan'?'active':''?>">
              <i class="nav-icon fas fa-chevron-right"></i>
              <p>
                Pengaturan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('')}}/logout" class="nav-link">
              <i class="nav-icon fas fa-chevron-right"></i>
              <p>
                Keluar
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    @yield('content')
    
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.5
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{url('')}}/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{url('')}}/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{url('')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="{{url('')}}/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="{{url('')}}/plugins/sparklines/sparkline.js"></script>
<!-- jQuery Knob Chart -->
<script src="{{url('')}}/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="{{url('')}}/plugins/moment/moment.min.js"></script>
<script src="{{url('')}}/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{url('')}}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="{{url('')}}/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{url('')}}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
{{-- DATATABLE --}}
<script src="{{url('')}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{url('')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{url('')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{url('')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="{{url('')}}/dist/js/adminlte.js"></script>
<script type="text/javascript" src="{{url('')}}/plugins/select2/js/select2.full.min.js"></script>
<script type="text/javascript" src="{{url('')}}/dist/js/jquery.form.min.js">
</script>
<script type="text/javascript" src="{{url('')}}/plugins/orgchart/js/html2canvas.min.js"></script>
<script type="text/javascript" src="{{url('')}}/plugins/orgchart/js/jquery.orgchart.min.js"></script>
@yield('js')
</body>
</html>
