<?php $this->extend('layout/template') ?>

<?php $this->section('konten') ?>
<div class="content-header">
<div class="container-fluid">
    <div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">Tambah Admin</h1>
    </div>        
    </div>
</div>
</div>

<div class="content">
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
        <form action="<?= base_url() ?>/admin_pengguna/create" method="post">
            <div class="card">
            <div class="card-body">
                <?= session()->getFlashdata('pesan') ? session()->getFlashdata('pesan') : '' ?>

                <div class="form-group">
                    <label for="">Nama</label>
                    <input type="text" class="form-control <?= $validation->hasError('nama') ? 'is-invalid' : '' ?>" name="nama" placeholder="Masukan Nama" value="<?= old('nama') ?>">
                    <?= $validation->hasError('nama') ? '<small class="text-danger">' . $validation->getError('nama') . '</small>' : '' ?>
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" class="form-control <?= $validation->hasError('email') ? 'is-invalid' : '' ?>" name="email" placeholder="Masukan Email" value="<?= old('email') ?>">
                    <?= $validation->hasError('email') ? '<small class="text-danger">' . $validation->getError('email') . '</small>' : '' ?>
                </div>
                <div class="form-group">
                    <label for="">Nomor Telepon</label>
                    <input type="text" class="form-control <?= $validation->hasError('no_telp') ? 'is-invalid' : '' ?>" name="no_telp" placeholder="Masukan Nomor Telepom" value="<?= old('no_telp') ?>">
                    <?= $validation->hasError('no_telp') ? '<small class="text-danger">' . $validation->getError('no_telp') . '</small>' : '' ?>
                </div>
                <div class="form-group">
                    <label for="level">Level</label>
                    <select name="level" id="level" class="form-control <?= $validation->hasError('level') ? 'is-invalid' : '' ?>">
                        <option value="">Pilih Kategori</option>
                        <option value="admin_pengguna">Admin Pengguna</option>
                        <option value="admin_laporan">Admin Laporan</option>
                    </select>
                    <?= $validation->hasError('level') ? '<small class="text-danger">' . $validation->getError('level') . '</small>' : '' ?>
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" class="form-control <?= $validation->hasError('password') ? 'is-invalid' : '' ?>" name="password" placeholder="Masukan Password">
                    <?= $validation->hasError('password') ? '<small class="text-danger">' . $validation->getError('password') . '</small>' : '' ?>
                </div>  
                <div class="form-group">
                    <label for="">Masukan Ulang Password</label>
                    <input type="password" class="form-control <?= $validation->hasError('password2') ? 'is-invalid' : '' ?>" name="password2" placeholder="Masukan Ulang Password">
                    <?= $validation->hasError('password2') ? '<small class="text-danger">' . $validation->getError('password2') . '</small>' : '' ?>              
                </div>           
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary float-right">Simpan</button>
            </div>
            </div>
        </form>
        </div>
    </div>
</div>
</div>
<?php $this->endSection() ?>