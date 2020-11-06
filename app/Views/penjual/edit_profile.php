<?php $this->extend('layout/template') ?>

<?php $this->section('konten') ?>
<div class="content-header">
    <div class="container-fluid">
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
                        <form action="<?= base_url('/penjual/ganti_profil') ?>" method="POST" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                            <input type="hidden" name="gambarlama" value="<?= $user['foto'] ?>">
                            <div class="form-group row">
                            <label for="nama_lengkap" class="col-sm-2 col-form-label">Nama Lengkap</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control <?= ($validation->hasError('nama_lengkap')) ? 'is-invalid' : '' ?>" id="nama_lengkap" name="nama_lengkap" value="<?= (old('nama_lengkap')) ? old('nama_lengkap') : $user['nama_lengkap'] ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('nama_lengkap'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                            <label for="nama_toko" class="col-sm-2 col-form-label">Nama Toko</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control <?= ($validation->hasError('nama_toko')) ? 'is-invalid' : '' ?>" id="nama_toko" name="nama_toko" value="<?= (old('nama_toko')) ? old('nama_toko') : $user['nama_toko'] ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('nama_toko'); ?>
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
                                <label for="nomor_telepon" class="col-sm-2 col-form-label">Nomor Telepon</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control <?= ($validation->hasError('nomor_telepon')) ? 'is-invalid' : '' ?>" id="nomor_telepon" name="nomor_telepon" value="<?= (old('nomor_telepon')) ? old('nomor_telepon') : $user['nomor_telepon'] ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('nomor_telepon'); ?>
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
<?php $this->endSection() ?>