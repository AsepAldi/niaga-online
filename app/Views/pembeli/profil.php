<?php $this->extend('layout/pembeli_template') ?>

<?php $this->section('konten') ?>
<section class="konten pt-2">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Profil</h1>
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
                            <form action="<?= base_url('/pembeli/edit_profil') ?>" method="POST" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                                <input type="hidden" name="gambarlama" value="<?= $user['foto'] ?>">
                                <div class="form-group row">
                                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : '' ?>" id="nama" name="nama" value="<?= (old('nama')) ? old('nama') : $user['nama'] ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('nama'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>" id="email" name="email" value="<?= (old('email')) ? old('email') : $user['email'] ?>" readonly>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('email'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="jenis_kelamin" class="col-sm-2 col-form-label">Nomor Telepon</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control <?= ($validation->hasError('nomor_telepon')) ? 'is-invalid' : '' ?>" id="nomor_telepon" name="nomor_telepon" value="<?= (old('nomor_telepon')) ? old('nomor_telepon') : $user['nomor_telepon'] ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('nomor_telepon'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                    <div class="col-sm-10">
                                        <input type="<?= $user['tanggal_lahir'] == '0000-00-00' ? 'date' : 'text' ?>" class="form-control <?= ($validation->hasError('tanggal_lahir')) ? 'is-invalid' : '' ?>" id="tanggal_lahir" name="tanggal_lahir" value="<?= (old('tanggal_lahir')) ? old('tanggal_lahir') : $user['tanggal_lahir'] ?>" <?= $user['tanggal_lahir'] == '0000-00-00' ? '' : 'readonly' ?>>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('tanggal_lahir'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control <?= ($validation->hasError('jenis_kelamin')) ? 'is-invalid' : '' ?>" id="jenis_kelamin" name="jenis_kelamin" value="<?= (old('jenis_kelamin')) ? old('jenis_kelamin') : $user['jenis_kelamin'] ?>" readonly>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('jenis_kelamin'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">                                    
                                    <div class="col-sm-4">
                                        <img src="/img/profil/<?= $user['foto'] ?>" id="imgPreview" class="img-thumbnail">
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input <?= ($validation->hasError('foto')) ? 'is-invalid' : '' ?>" id="foto" name="foto" onchange="gantifoto()">
                                            <label class="custom-file-label" for="foto">Choose file</label>      
                                        </div>
                                        <small>Maksimal ukuran : 1MB</small>
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
</section>
<?php $this->endSection() ?>