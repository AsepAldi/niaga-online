<?php $this->extend('layout/auth_template') ?>
<?php 
$uri = service('uri');
$method = $uri->getSegment(2);
?>
<?php $this->section('konten') ?>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="row">
    <div class="col">
      <div class="login-logo">
        <a href="<?= base_url() ?>"><b>Niaga</b>11</a>
      </div>
    </div>
  </div>
  
  <!-- /.login-logo -->  
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign In <?= $method == 'formloginpembeli' ? '' : ($method == 'formloginadmin' ? 'Admin' : 'Penjual') ?></p>
      <?= session()->getFlashdata('pesan') ? session()->getFlashdata('pesan') : '' ?>
      <form action="<?= base_url() ?><?= $method == 'formloginpembeli' ? '/auth/loginpembeli' : ($method == 'formloginadmin' ? '/auth/loginadmin' : '/auth/loginpenjual') ?>" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="email" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>    
        <div class="row">
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Login</button>
          </div>
          <!-- /.col -->
        </div>                      
      </form>

      <div class="row">
        <p class="mt-2 mb-1 ml-2">
          <a href="#">Lupa Password</a>
        </p>
      </div>
      <div class="row">
        <p class="ml-2 mb-0">
          <a href="<?= base_url() ?><?= $method == 'formloginpembeli' ? '/auth/formregispembeli' : '/auth/formregispenjual' ?>" class="text-center"><?= $method == 'formloginadmin' ? '' : 'Belum memiliki akun?' ?></a>
        </p>
      </div>
      
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
<?php $this->endSection(); ?>