<?php $this->extend('layout/template') ?>

<?php $this->section('konten') ?> 
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Barang Saya</h1>
            </div>            
        </div>
        <?= session()->getFlashdata('pesan') ? session()->getFlashdata('pesan') : '' ?>
        <?php if($validation->getErrors()) : ?>            
        <div class="row">
            <div class="col">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Tambah Barang Gagal. <br> Error: <br>
                    <blockquote class="bg bg-warning">
                    <?= $validation->hasError('nama_barang') ? $validation->getError('nama_barang') . '<br>' : '' ?>
                    <?= $validation->hasError('harga_barang') ? $validation->getError('harga_barang') . '<br>' : '' ?>
                    <?= $validation->hasError('banyak_barang') ? $validation->getError('banyak_barang') . '<br>' : '' ?>
                    <?= $validation->hasError('deskripsi_barang') ? $validation->getError('deskripsi_barang') . '<br>' : '' ?>
                    <?= $validation->hasError('foto_barang') ? $validation->getError('foto_barang') . '<br>' : '' ?>
                    </blockquote>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">                        
                        <!-- SEARCH FORM -->
                        <form class="form-inline" action="" method="POST">
                            <div class="input-group input-group-sm col-md-3 col-6">
                                <input type="text" class="form-control" placeholder="Cari.." name="keyword">
                                <div class="input-group-append">
                                    <button class="btn btn-info" type="submit" id="button-addon2">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-info ml-auto" data-toggle="modal" data-target="#exampleModal">
                            <i class="fas fa-plus"></i> Tambah Barang
                            </button>                        
                        </form>                                               
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>                            
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Deskripsi</th>
                            <th>Opsi</th>                            
                        </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $currentPage -= 1;
                            $i = 1 + (6 * $currentPage);
                            foreach ($barang as $item) : ?>    
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $item['nama_barang'] ?></td>                                    
                                    <td>IDR <?= $item['harga_barang'] ?></td>
                                    <td><?= $item['banyak_barang'] ?></td>
                                    <td><?= $item['deskripsi_barang'] ?></td>
                                    <td>
                                        <a href="<?= base_url() ?>/penjual/edit_barang/<?= $item['id_barang'] ?>" class="btn btn-primary"><i class="nav-icon fas fa-edit"></i> Edit</a>
                                        <a href="<?= base_url() ?>/penjual/hapus_barang/<?= $item['id_barang'] ?>" onclick="return confirm('Apakah Anda Yakin ?')" class="btn btn-warning"><i class="nav-icon fas fa-trash"></i> Hapus</a>
                                    </td>
                                </tr>           
                            <?php endforeach; ?>
                        </tbody>                  
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                    <?= $pager->links('barang', 'my_pager') ?>  
                    </div>
                </div>
            </div>
        </div>     
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="<?= base_url('/penjual/tambah_barang') ?>" method="POST" enctype="multipart/form-data">
            <?= csrf_field() ?>
                <input type="hidden" name="id_penjual" value="<?= $user['id_penjual'] ?>">
                <div class="form-group row">
                <label for="nama_barang" class="col-sm-3 col-form-label">Nama Barang</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nama_barang" name="nama_barang">                        
                    </div>
                </div>    
                <div class="form-group row">
                <label for="harga_barang" class="col-sm-3 col-form-label">Harga</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="harga_barang" name="harga_barang">                        
                    </div>
                </div>      
                <div class="form-group row">
                <label for="banyak_barang" class="col-sm-3 col-form-label">Stok</label>
                    <div class="col-sm-9">
                        <input type="number" min="1" class="form-control" id="banyak_barang" name="banyak_barang">                        
                    </div>
                </div>   
                <div class="form-group row">                                    
                    <div class="col-sm-4">
                        <img src="/img/img-not-found.png" id="imgPreview" class="img-thumbnail img-fluid">
                    </div>
                    <div class="col-sm-8">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="foto" name="foto_barang" onchange="gantifoto()">
                            <label class="custom-file-label" for="foto">Foto Barang</label>      
                        </div>                        
                    </div>
                </div> 
                <div class="form-group row">
                <label for="deskripsi_barang" class="col-sm-3 col-form-label">Deskripsi</label>
                    <div class="col-sm-9">
                        <textarea name="deskripsi_barang" class="form-control" id="deskripsi_barang" cols="30" rows="10" placeholder="Sertakan deskripsi disini, isi dengan keadaan barang yang anda jual atau juga kontak yang dapat dihubungi."></textarea>                                               
                    </div>
                </div>                                     
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection() ?>