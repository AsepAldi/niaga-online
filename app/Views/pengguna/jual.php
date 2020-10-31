<?php $this->extend('layout/template') ?>

<?php $this->section('konten') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Jual Barang</h1>
          </div><!-- /.col -->          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row justify-content-center">
            <div class="col-8">
                <?= session()->getFlashdata('pesan') ? session()->getFlashdata('pesan') : '' ?>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8 col">
                <!-- Horizontal Form -->
                <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Silahkan masukan barang yang akan anda jual.</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" action="<?= base_url() ?>/pengguna/jual_barang" method="POST" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                    <div class="card-body">
                        <input type="hidden" name="email" value="<?= session()->get('email') ?>">                        
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Barang</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control <?= $validation->hasError('nama_barang') ? 'is-invalid' : '' ?>" id="inputEmail3" name="nama_barang" placeholder="Masukan Nama Barang yang akan anda jual." value="<?= old('nama_barang') ?>">
                            <?= $validation->hasError('nama_barang') ? '<small class="text-danger">' . $validation->getError('nama_barang') . '</small>' : '' ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Foto Barang</label>
                            <div class="col-sm-9">
                                <div class="custom-file">
                                    <input type="file" name="foto_barang" class="custom-file-input <?= $validation->hasError('foto_barang') ? 'is-invalid' : '' ?>" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                    <?= $validation->hasError('nama_barang') ? '<small class="text-danger">' . $validation->getError('foto_barang') . '</small>' : '' ?>
                                </div>                            
                            </div>
                        </div>   
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Harga Barang</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control <?= $validation->hasError('harga_barang') ? 'is-invalid' : '' ?>" id="inputEmail3" name="harga_barang" placeholder="Masukan Harga Barang. contoh : 25000" value="<?= old('harga_barang') ?>">
                            <?= $validation->hasError('harga_barang') ? '<small class="text-danger">' . $validation->getError('harga_barang') . '</small>' : '' ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Banyak Barang</label>
                            <div class="col-sm-9">
                            <input type="number" min="1" class="form-control <?= $validation->hasError('banyak_barang') ? 'is-invalid' : '' ?>" id="inputEmail3" name="banyak_barang" placeholder="Masukan Banyak Barang yang akan anda jual." value="<?= old('banyak_barang') ?>">
                            <?= $validation->hasError('banyak_barang') ? '<small class="text-danger">' . $validation->getError('banyak_barang') . '</small>' : '' ?>
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Deskripsi Barang</label>
                            <div class="col-sm-9">                            
                                <textarea class="form-control <?= $validation->hasError('deskripsi_barang') ? 'is-invalid' : '' ?>" rows="3" placeholder="Masukan Deskripsi Barang yang anda jual." name="deskripsi_barang"></textarea>
                                <?= $validation->hasError('deskripsi_barang') ? '<small class="text-danger">' . $validation->getError('deskripsi_barang') . '</small>' : '' ?>
                            </div>
                        </div>               
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                    <button type="submit" class="btn btn-info">Jual</button>                    
                    </div>
                    <!-- /.card-footer -->
                </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->    
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
<?php $this->endSection() ?>