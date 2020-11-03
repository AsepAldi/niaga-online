<?php $this->extend('layout/template') ?>

<?php $this->section('konten') ?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Pembeli</h1>
            </div>            
        </div>
    </div>
</div>
<section class="content">
        <div class="container-fluid">       
            <div class="row">
                <div class="col-12">
                    <div class="card">                                                                      
                        <div class="row mt-4 mr-4">
                            <div class="col-md-4 ml-4">
                                <!-- SEARCH FORM -->
                                <form class="form-inline" action="" method="POST">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" placeholder="Cari.." name="keyword">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit" id="button-addon2">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Tanggal Lahir</th>
                                <th>Email</th>
                                <th>Nomor Telepon</th>
                                <th>Jenis Kelamin</th>
                                <th>Daftar Sejak</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $currentPage -= 1;
                                $i = 1 + (6 * $currentPage);
                                foreach ($pembeli as $user) : ?>    
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $user['nama'] ?></td>
                                        <td><?= $user['tanggal_lahir'] ?></td>
                                        <td><?= $user['email'] ?></td>
                                        <td><?= $user['nomor_telepon'] ?></td>
                                        <td><?= $user['jenis_kelamin'] ?></td>                                        
                                        <td><?= $user['created_at'] ?></td>
                                    </tr>           
                                <?php endforeach; ?>
                            </tbody>                  
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                        <?= $pager->links('pembeli', 'my_pager') ?>  
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /col -->
            </div>  
        </div>
        <!-- /.row -->    
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
<?php $this->endSection() ?>