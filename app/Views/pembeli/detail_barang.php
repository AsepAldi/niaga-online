<?php $this->extend('layout/pembeli_template') ?>

<?php $this->section('konten') ?>
<div class="content-header">
    <div class="container">
        <div class="row mb-2">
        <div class="col-sm-6">
            <a href="#" onclick="history.go(-1);" class="btn btn-primary"><i class="fas fa-chevron-circle-left"></i> Kembali</a>
        </div>        
        </div>
    </div>
</div>
<div class="content">
    <div class="container">
        <div class="card card-solid">
            <div class="card-body">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <h3 class="d-inline-block d-sm-none">LOWA Men’s Renegade GTX Mid Hiking Boots Review</h3>
                  <div class="col-12">
                    <img src="/img/barang/<?= $barang['foto_barang'] ?>" class="product-image" alt="Product Image">
                  </div>
                  <!-- <div class="col-12 product-image-thumbs">
                    <div class="product-image-thumb active">
                        <img src="../../dist/img/prod-1.jpg" alt="Product Image">
                    </div>                
                  </div> -->
                </div>
                <div class="col-12 col-sm-6">
                  <h3 class="my-3"><?= $barang['nama_barang'] ?></h3>
                  <p>
                      Stok : <?= $barang['banyak_barang'] ?>
                  </p>
                  <p>
                      Deskripsi : <br>
                      <?= $barang['deskripsi_barang'] ?>
                  </p>
    
                  <hr>              
                  <div class="bg-gray py-2 px-3 mt-4">
                    <h2 class="mb-0">
                      IDR <?= $barang['harga_barang'] ?>
                    </h2>                    
                  </div>
    
                  <div class="mt-4">
                    <div class="btn btn-primary btn-lg btn-flat">
                      Tambah Ke Keranjang
                    </div>
    
                    <div class="btn btn-default btn-lg btn-flat">                       
                      Beli Langsung
                    </div>
                  </div>
                </div>
              </div>          
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
<?php $this->endSection() ?>