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
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= count($pengguna) ?></h3>

                <p>Member</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-stalker"></i>
              </div>              
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= count($barang) ?></h3>

                <p>Barang yang dijual</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-pricetags"></i>
              </div>              
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>0</h3>

                <p>Transaksi berhasil</p>
              </div>
              <div class="icon">
                <i class="ion ion-checkmark-round"></i>
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