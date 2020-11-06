<?php $this->extend('layout/template') ?>

<?php $this->section('konten') ?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Ubah Password</h1>
        </div>        
        </div>
    </div>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">     
                        <?= session()->getFlashdata('pesan') ? session()->getFlashdata('pesan') : '' ?>
                        <form action="<?= base_url('/penjual/ubah_password') ?>" method="POST" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <input type="hidden" name="email" value="<?= $user['email'] ?>">                        
                            <div class="form-group row">
                                <label for="current_password" class="col-sm-4 col-form-label">Password Lama</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control <?= ($validation->hasError('current_password')) ? 'is-invalid' : '' ?>" id="current_password" name="current_password">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('current_password'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="new_password" class="col-sm-4 col-form-label">Password Baru</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control <?= ($validation->hasError('new_password')) ? 'is-invalid' : '' ?>" id="new_password" name="new_password">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('new_password'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password2" class="col-sm-4 col-form-label">Masukan Ulang Password</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control <?= ($validation->hasError('password2')) ? 'is-invalid' : '' ?>" id="password2" name="password2">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('password2'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>                         
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection() ?>