<?php $this->extend('layout/template') ?>

<?php $this->section('konten') ?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit Barang</h1>
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
                        <form action="<?= base_url('/penjual/update_barang') ?>" method="POST" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                            <input type="hidden" name="id_barang" value="<?= $barang['id_barang'] ?>">
                            <input type="hidden" name="id_penjual" value="<?= $barang['id_penjual'] ?>">
                            <input type="hidden" name="gambarlama" value="<?= $barang['foto_barang'] ?>">
                            <div class="form-group row">
                            <label for="nama_barang" class="col-sm-2 col-form-label">Nama Barang</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control <?= ($validation->hasError('nama_barang')) ? 'is-invalid' : '' ?>" id="nama_barang" name="nama_barang" value="<?= (old('nama_barang')) ? old('nama_barang') : $barang['nama_barang'] ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('nama_barang'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="harga_barang" class="col-sm-2 col-form-label">Harga Barang</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control <?= ($validation->hasError('harga_barang')) ? 'is-invalid' : '' ?>" id="harga_barang" name="harga_barang" value="<?= (old('harga_barang')) ? old('harga_barang') : $barang['harga_barang'] ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('harga_barang'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="banyak_barang" class="col-sm-2 col-form-label">Stok</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control <?= ($validation->hasError('banyak_barang')) ? 'is-invalid' : '' ?>" id="banyak_barang" name="banyak_barang" value="<?= (old('banyak_barang')) ? old('banyak_barang') : $barang['banyak_barang'] ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('banyak_barang'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">                                    
                                <div class="col-sm-4">
                                    <img src="/img/barang/<?= $barang['foto_barang'] ?>" id="imgPreview" class="img-thumbnail">
                                </div>
                                <div class="col-sm-8">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input <?= ($validation->hasError('foto')) ? 'is-invalid' : '' ?>" id="foto" name="foto_barang" onchange="gantifoto()">
                                        <label class="custom-file-label" for="foto">Choose file</label>      
                                    </div>                                    
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="deskripsi_barang" class="col-sm-2 col-form-label">Deskripsi</label>
                                <textarea class="form-control" name="deskripsi_barang" id="deskripsi_barang" cols="30" rows="10"><?= $barang['deskripsi_barang'] ?></textarea>
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