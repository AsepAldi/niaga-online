<?php $this->extend('layout/auth_template') ?>

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
      <p class="login-box-msg">Lupa Password</p>
      <?= session()->getFlashdata('pesan') ? session()->getFlashdata('pesan') : '' ?>
      <form action="<?= base_url() ?>/auth/gantipassword" method="post">
        <div class="input-group mb-3">
          <?= $validation->hasError('email') ? '<small class="text-danger">' . $validation->getError('email') . '</small>' : '' ?>
          <input type="text" class="form-control <?= $validation->hasError('email') ? 'is-invalid' : '' ?>" name="email" placeholder="Masukan Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <?= $validation->hasError('level') ? '<small class="text-danger">' . $validation->getError('level') . '</small>' : '' ?>
        <div class="form-group">
          <label for="">Level akun anda sebagai..</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="level" value="pembeli">
                <label class="form-check-label">Pembeli</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="level" value="penjual">
                <label class="form-check-label">Penjual</label>
            </div>            
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Kirim</button>
          </div>
          <!-- /.col -->
        </div>                      
      </form>

      <div class="row">
        <p class="mt-2 mb-1 ml-2">
          <a href="<?= base_url('/auth/formloginpenjual') ?>">Login Penjual</a>
        </p>
      </div>
      <div class="row">
        <p class="ml-2 mb-0">
          <a href="<?= base_url() ?>/auth/formloginpembeli" class="text-center">Login Pembeli</a>
        </p>
      </div>
      
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
<?php $this->endSection(); ?>