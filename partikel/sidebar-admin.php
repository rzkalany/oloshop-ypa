<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= $base_url ?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-store"></i>
        </div>
        <div class="sidebar-brand-text mx-3">YPA.CO Beauty</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="<?= $base_url ?>dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->

    <li class="nav-item">
        <a class="nav-link" href="<?= $base_url ?>dashboard/kelola-pesanan/">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Kelola Pesanan</span></a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Kelola Toko</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?= $base_url ?>dashboard/kelola-kategori/">Kategori</a>
                <a class="collapse-item" href="<?= $base_url ?>dashboard/kelola-produk/">Produk</a>
                <a class="collapse-item" href="<?= $base_url ?>dashboard/kelola-metode-pembayaran/">Metode Pembayaran</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="<?= $base_url ?>dashboard/kelola-pelanggan">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Kelola Pelanggan</span></a>
    </li>

    <!-- <li class="nav-item">
        <a class="nav-link" href="<?= $base_url ?>dashboard/kelola-staff">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Kelola Staff</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="<?= $base_url ?>dashboard/kelola-website">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Kelola Website</span></a>
    </li> -->

    <hr class="sidebar-divider">

    <!-- <li class="nav-item">
        <a class="nav-link" target="_blank" href="<?= $base_url ?>dashboard/report/report-penjualan.php">
            <i class="fas fa-fw fa-file"></i>
            <span>Laporan Penjualan</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" target="_blank" href="<?= $base_url ?>dashboard/report/report-product.php">
            <i class="fas fa-fw fa-file"></i>
            <span>Laporan Produk</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" target="_blank" href="<?= $base_url ?>dashboard/report/report-pelanggan.php">
            <i class="fas fa-fw fa-file"></i>
            <span>Laporan Pelanggan</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" target="_blank" href="<?= $base_url ?>dashboard/report/report-pengiriman.php">
            <i class="fas fa-fw fa-file"></i>
            <span>Laporan Pengiriman</span></a>
    </li> -->

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>