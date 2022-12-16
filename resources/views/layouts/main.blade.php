<?php

  use App\Models\User;

  $session = session()->get('user');
  
  if ($session == ''){
    header('Location: /login');
    exit();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href='{{ asset("template/plugins/fontawesome-free/css/all.min.css") }}'>
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href='{{ asset("template/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css") }}'>
  <!-- iCheck -->
  <link rel="stylesheet" href='{{ asset("template/plugins/icheck-bootstrap/icheck-bootstrap.min.css") }}'>
  <!-- JQVMap -->
  <link rel="stylesheet" href='{{ asset("template/plugins/jqvmap/jqvmap.min.css") }}'>
  <!-- Theme style -->
  <link rel="stylesheet" href='{{ asset("template/dist/css/adminlte.min.css") }}'>
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href='{{ asset("template/plugins/overlayScrollbars/css/OverlayScrollbars.min.css") }}'>
  <!-- Daterange picker -->
  <link rel="stylesheet" href='{{ asset("template/plugins/daterangepicker/daterangepicker.css") }}'>
  <!-- summernote -->
  <link rel="stylesheet" href='{{ asset("template/plugins/summernote/summernote-bs4.min.css") }}'>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src='{{ asset("template/dist/img/AdminLTELogo.png") }}' alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/contact" class="nav-link">Tentang Kita</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src='{{ asset("template/dist/img/icon-gaji.jpg") }}' alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Website Penggajian</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src='{{ asset("template/dist/img/Logo_UPH.gif") }}' class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">KELOMPOK 3</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
           @include("layouts.sidebar") 
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">PENGGAJIAN KARYAWAN</h1>
          </div><!-- /.col -->
          <!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
 
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  @yield('header')
                </h3>
                <div class="card-tools">
                  
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                @yield('container')
                
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
     
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src='{{ asset("template/plugins/jquery/jquery.min.js") }}'></script>
<!-- jQuery UI 1.11.4 -->
<script src='{{ asset("template/plugins/jquery-ui/jquery-ui.min.js") }}'></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src='{{ asset("template/plugins/bootstrap/js/bootstrap.bundle.min.js") }}'></script>
<!-- ChartJS -->
<script src='{{ asset("template/plugins/chart.js/Chart.min.js") }}'></script>
<!-- Sparkline -->
<script src='{{ asset("template/plugins/sparklines/sparkline.js") }}'></script>
<!-- JQVMap -->
<script src='{{ asset("template/plugins/jqvmap/jquery.vmap.min.js") }}'></script>
<script src='{{ asset("template/plugins/jqvmap/maps/jquery.vmap.usa.js") }}'></script>
<!-- jQuery Knob Chart -->
<script src='{{ asset("template/plugins/jquery-knob/jquery.knob.min.js") }}'></script>
<!-- daterangepicker -->
<script src='{{ asset("template/plugins/moment/moment.min.js") }}'></script>
<script src='{{ asset("template/plugins/daterangepicker/daterangepicker.js") }}'></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src='{{ asset("template/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js") }}'></script>
<!-- Summernote -->
<script src='{{ asset("template/plugins/summernote/summernote-bs4.min.js") }}'></script>
<!-- overlayScrollbars -->
<script src='{{ asset("template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js") }}'></script>
<!-- AdminLTE App -->
<script src='{{ asset("template/dist/js/adminlte.js") }}'></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src='{{ asset("template/dist/js/pages/dashboard.js") }}'></script>
</body>
</html>