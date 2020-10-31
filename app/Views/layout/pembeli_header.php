<?php $this->extend('layout/pembeli_template') ?>

<?php $this->section('pembeli_header') ?>    
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Niaga 11</a>
            <!-- SEARCH FORM -->
            <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Cari Barang..." aria-label="Search">
                    <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                    </div>
                </div>
            </form>            
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <?php if(session()->get('email')) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-user"></i> Profilku</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-shopping-cart"></i> Keranjang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-comment"></i> Chat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-clipboard-list"></i> Pesanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/auth/logout') ?>"><i class="fas fa-sign-out-alt"></i></a>
                    </li>
                    <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/auth/formloginadmin') ?>">Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/auth/formloginpenjual') ?>">Jadi Penjual</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/auth/formregispembeli') ?>">Daftar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/auth/formloginpembeli') ?>">Login</a>
                    </li>         
                    <?php endif; ?>    
                </ul>
            </div>
        </div>
    </nav>
<?php $this->endSection() ?>