<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php $url_dir ?>../vendor/AdminLTE/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php $url_dir ?>https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?php $url_dir ?>../vendor/AdminLTE/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php $url_dir ?>../vendor/AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php $url_dir ?>../vendor/AdminLTE/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php $url_dir ?>../vendor/AdminLTE/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php $url_dir ?>../vendor/AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php $url_dir ?>../vendor/AdminLTE/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php $url_dir ?>../vendor/AdminLTE/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
<?php
  include('../layouts/alert.php');
?>
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="<?php $url_dir ?>../vendor/AdminLTE/#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php $url_dir ?>../vendor/AdminLTE/index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php $url_dir ?>../vendor/AdminLTE/#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        </div>
        <div class="info">
          <p class="d-block" style="color:white;">Xin Chào <?php
           if($role == "owner"){
            echo $_SESSION['username'];
           }else{
            echo "Admin";
           }
           ?></p>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-header"><?php 
            if ($role == "owner") {
              echo "Quản lý khách sạn";
            }else{
              echo "Quản lý website";
            }
          ?></li>
          <?php
            if($role == "owner"):
          ?>
                <li class="nav-item">
            <a href="<?php $url_dir ?>index.php" class="nav-link <?php if($page == "hotelManagement") echo "active"; ?>">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Quản lý khách sạn
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php $url_dir ?>booking.php" class="nav-link <?php if($page == "booking") echo "active"; ?>">
              <i class="nav-icon far fa-image"></i>
              <p>
                Booking
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php $url_dir ?>typeRoom.php" class="nav-link <?php if($page == "typeRoom") echo "active"; ?>">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                Type Room
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php $url_dir ?>roomMan.php" class="nav-link <?php if($page == "room") echo "active"; ?>">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Room
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php $url_dir ?>discount.php" class="nav-link <?php if($page == "discount") echo "active"; ?>">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Discount
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php $url_dir ?>../action/logout.php" class="nav-link">
              <i class="nav-icon far fa-plus-square"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
          <?php
            else:
          ?>
          <li class="nav-item">
            <a href="<?php $url_dir ?>owners.php" class="nav-link <?php if($page == "ownerManagement") echo "active"; ?>">
              <i class="nav-icon far fa-plus-square"></i>
              <p>
                Quản lý owners
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php $url_dir ?>reviews.php" class="nav-link <?php if($page == "rvManagement") echo "active"; ?>">
              <i class="nav-icon far fa-plus-square"></i>
              <p>
                Quản lý reviews
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php $url_dir ?>users.php" class="nav-link <?php if($page == "usersManagement") echo "active"; ?>">
              <i class="nav-icon far fa-plus-square"></i>
              <p>
                Quản lý Users
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php $url_dir ?>hotels.php" class="nav-link <?php if($page == "hotelManagement") echo "active"; ?>">
              <i class="nav-icon far fa-plus-square"></i>
              <p>
                Quản lý trạng thái khách sạn
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php $url_dir ?>../action/logout.php" class="nav-link">
              <i class="nav-icon far fa-plus-square"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
          <?php
            endif;
          ?>
          
        </ul>
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
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php $url_dir ?>../vendor/AdminLTE/#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      
    