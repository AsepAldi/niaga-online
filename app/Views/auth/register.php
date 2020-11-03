<?php $this->extend('layout/auth_template') ?>
<?php 
$uri = service('uri');
$method = $uri->getSegment(2);
?>
<?php $this->section('konten') ?>
<body class="hold-transition login-page">
<div class="register-box">
  <div class="register-logo">
    <a href="<?= base_url() ?>"><b>Niaga</b>11</a>
    <br>
    <b><?= $method == 'formregispembeli' ? 'Pembeli' : 'Penjual' ?></b>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Sign Up</p>

      <form action="<?= base_url() ?><?= $method == 'formregispembeli' ? '/auth/daftarpembeli' : '/auth/daftarpenjual' ?>" method="post">
      <?php if ($method == 'formregispembeli') : ?>
        <?= $validation->hasError('nama') ? '<small class="text-danger">' . $validation->getError('nama') . '</small>' : '' ?>
        <div class="input-group mb-3">
          <input type="text" class="form-control <?= $validation->hasError('nama') ? 'is-invalid' : '' ?>" placeholder="Nama" name="nama" value="<?= old('nama') ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>          
        </div>

        <?= $validation->hasError('email') ? '<small class="text-danger">' . $validation->getError('email') . '</small>' : '' ?>
        <div class="input-group mb-3">
          <input type="text" class="form-control <?= $validation->hasError('email') ? 'is-invalid' : '' ?>" name="email" placeholder="Email" value="<?= old('email') ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        <?= $validation->hasError('jenis_kelamin') ? '<small class="text-danger">' . $validation->getError('jenis_kelamin') . '</small>' : '' ?>
        <div class="input-group mb-3">          
          <select name="jenis_kelamin" class="form-control <?= $validation->hasError('jenis_kelamin') ? 'is-invalid' : '' ?>" id="jk" value="<?= old('jenis_kelamin') ?>">
            <option value="">Jenis Kelamin</option>
            <option value="Pria">Pria</option>
            <option value="Wanita">Wanita</option>
          </select>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-venus-mars"></span>
            </div>
          </div>
        </div>

        <?= $validation->hasError('no_telp') ? '<small class="text-danger">' . $validation->getError('no_telp') . '</small>' : '' ?>
        <div class="input-group mb-3">
          <input type="text" class="form-control <?= $validation->hasError('no_telp') ? 'is-invalid' : '' ?>" name="no_telp" placeholder="Nomor Telepon" value="<?= old('no_telp') ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
        </div>

        <?= $validation->hasError('password') ? '<small class="text-danger">' . $validation->getError('password') . '</small>' : '' ?>
        <div class="input-group mb-3">
          <input type="password" class="form-control <?= $validation->hasError('password') ? 'is-invalid' : '' ?>" name="password" placeholder="Password (Minimal 5 karakter)">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        
        <?= $validation->hasError('password2') ? '<small class="text-danger">' . $validation->getError('password2') . '</small>' : '' ?>
        <div class="input-group mb-3">
          <input type="password" class="form-control <?= $validation->hasError('password2') ? 'is-invalid' : '' ?>" name="password2" placeholder="Masukan ulang password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <?php else : ?>

        <?= $validation->hasError('nama_lengkap') ? '<small class="text-danger">' . $validation->getError('nama_lengkap') . '</small>' : '' ?>
        <div class="input-group mb-3">
          <input type="text" class="form-control <?= $validation->hasError('nama_lengkap') ? 'is-invalid' : '' ?>" placeholder="Nama Lengkap" name="nama_lengkap" value="<?= old('nama_lengkap') ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>          
        </div>

        <?= $validation->hasError('nama_toko') ? '<small class="text-danger">' . $validation->getError('nama_toko') . '</small>' : '' ?>
        <div class="input-group mb-3">
          <input type="text" class="form-control <?= $validation->hasError('nama_toko') ? 'is-invalid' : '' ?>" placeholder="Nama Toko Anda" name="nama_toko" value="<?= old('nama_toko') ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-store"></span>
            </div>
          </div>          
        </div>

        <?= $validation->hasError('email') ? '<small class="text-danger">' . $validation->getError('email') . '</small>' : '' ?>
        <div class="input-group mb-3">
          <input type="text" class="form-control <?= $validation->hasError('email') ? 'is-invalid' : '' ?>" name="email" placeholder="Email" value="<?= old('email') ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>        

        <?= $validation->hasError('no_telp') ? '<small class="text-danger">' . $validation->getError('no_telp') . '</small>' : '' ?>
        <div class="input-group mb-3">
          <input type="text" class="form-control <?= $validation->hasError('no_telp') ? 'is-invalid' : '' ?>" name="no_telp" placeholder="Nomor Telepon" value="<?= old('no_telp') ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
        </div>

        <?= $validation->hasError('password') ? '<small class="text-danger">' . $validation->getError('password') . '</small>' : '' ?>
        <div class="input-group mb-3">
          <input type="password" class="form-control <?= $validation->hasError('password') ? 'is-invalid' : '' ?>" name="password" placeholder="Password (Minimal 5 karakter)">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        
        <?= $validation->hasError('password2') ? '<small class="text-danger">' . $validation->getError('password2') . '</small>' : '' ?>
        <div class="input-group mb-3">
          <input type="password" class="form-control <?= $validation->hasError('password2') ? 'is-invalid' : '' ?>" name="password2" placeholder="Masukan ulang password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <?php endif; ?>

        <div class="row">
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>          
        </div>
      </form>
  
      <div class="row">
        <p class="ml-4 mb-3">
          <a href="<?= base_url() ?><?= $method == 'formregispembeli' ? '/auth/formloginpembeli' : '/auth/formloginpenjual' ?>" class="text-center">Saya sudah registrasi</a>
        </p>
      </div>
      
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->
<?php $this->endSection() ?>