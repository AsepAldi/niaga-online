<?php $this->extend('layout/template'); ?>

<?php $this->section('konten') ?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
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
            <div class="col-md-8">                
                <h3 class="text-center">Selamat Datang di Niaga 11.</h3>
                <p class="text-center">Di Niaga 11 anda bisa membeli barang yang di jual oleh pengguna lain disini.</p>
                <div class="row justify-content-center">
                    <div class="col-md-2 col-4">
                        <a href="<?= base_url('/pengguna/beli') ?>" class="btn btn-success">Beli Barang</a>
                    </div>
                </div>
                <hr>
                <p class="text-center">Anda juga dapat menjual barang yang anda jual disini, jadi Niaga 11 bisa menjadi platform untuk meluaskan pasar anda.</p>           
                <div class="row justify-content-center">
                    <div class="col-md-2 col-4">
                        <a href="<?= base_url('/pengguna/jual') ?>" class="btn btn-success">Jual Barang</a>
                    </div>
                </div>     
            </div>
        </div>
        <!-- /.row -->    
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
<?php $this->endSection() ?>