<?php $this->extend('layout/template') ?>
<?php $uri = service('uri') ?>
<?php $this->section('header') ?>
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
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar elevation-4 sidebar-light-primary">
    <!-- Brand Logo -->
    <a href="<?= session()->get('level') == 'admin' ? base_url('/admin') : base_url('/pengguna') ?>#" class="brand-link navbar-white">
      <img src="<?= base_url('/img/logo/icon-keranjang.png') ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-dark">Niaga 11</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url() ?>/adminlte/dist/img/avatar.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= $nama['nama_pengguna'] ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">  
          <?php if(session()->get('level') == 'admin_pengguna') : ?>
            <li class="nav-header">Data</li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Lihat Pengguna             
                </p>
                </a>
              </li>
              <li class="nav-item">
                  <a href="./index2.html" class="nav-link">
                  <i class="nav-icon fas fa-users-cog"></i>
                    <p>Tambah Admin</p>
                  </a>
                </li>                        
            </li>            
          <?php else : ?>
          <li class="nav-header">Menu</li>
          <li class="nav-item">
              <a href="#" class="nav-link">
              <i class="nav-icon fas fa-shopping-basket"></i>
              <p>
                Beli Barang                  
              </p>
              </a>
          </li>
          <li class="nav-item">
              <a href="<?= base_url() ?>/pengguna/jual" class="nav-link">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Jual Barang                  
              </p>
              </a>
          </li>
          <?php endif; ?>
        </ul>
        <hr>
        <ul class="nav nav-pills nav-sidebar flex-column">
            <li class="nav-item">
                <a href="<?= base_url('/auth/logout') ?>" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                    Log Out
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
<?php $this->endSection() ?>