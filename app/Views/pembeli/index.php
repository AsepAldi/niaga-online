<?php $this->extend('layout/pembeli_template') ?>

<?php $this->section('konten') ?>
<section class="konten pt-2">
    <div class="content">
        <div class="container">            
            <div class="row justify-content-center">
                <?php 
                $currentPage -= 1;
                $i = 1 + (6 * $currentPage);
                foreach($barang as $item) : ?>                
                    <div class="col-md-3 col-5">
                        <div class="card">
                            <img src="/img/barang/<?= $item['foto_barang'] ?>" class="card-img-top img-fluid" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?= $item['nama_barang'] ?></h5>
                                <p class="card-text"><span class="badge badge-pill badge-info">IDR <?= $item['harga_barang'] ?></span></p>
                                <a href="<?= base_url() ?>/pembeli/detail/<?= $item['id_barang'] ?>" class="btn btn-success mt-2">Detail</a>                                
                                <?php if(session()->get('email')) : ?>
                                <a href="#" class="btn btn-warning mt-2">+ Ke Keranjang</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="row justify-content-center">
                <div class="col-1">
                    <?= $pager->links('barang', 'my_pager') ?>                     
                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->endSection() ?>