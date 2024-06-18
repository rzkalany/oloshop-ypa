<div class="col-12">
    <header class="row">
        <!-- Top Nav -->
        <div class="col-12 bg-dark py-2 d-md-block d-none">
            <div class="row">
                <div class="col-auto me-auto">
                    <ul class="top-nav">
                        <li>
                            <a href="tel:+628978826548"><i class="fa fa-phone-square me-2"></i>+628978826548</a>
                        </li>
                        <li>
                            <a href="mailto:rizkamaelani0504@gmail.com"><i class="fa fa-envelope me-2"></i>rizkamaelani0504@gmail.com</a>
                        </li>
                    </ul>
                </div>
                <div class="col-auto">
                    <ul class="top-nav">
                        <?php if (!isset($_SESSION['login'])) : ?>
                            <li>
                                <a href="<?= $base_url ?>auth/register.php"><i class="fas fa-user-edit me-2"></i>Register</a>
                            </li>
                            <li>
                                <a href="<?= $base_url ?>auth/login.php"><i class="fas fa-sign-in-alt me-2"></i>Login</a>
                            </li>
                        <?php else : ?>
                            <li>
                                <a href="<?= $base_url ?>auth/ganti_password.php"><i class="fas fa-key me-2"></i>Ganti Password</a>
                            </li>
                            <li>
                                <a href="<?= $base_url ?>auth/logout.php"><i class="fas fa-sign-out-alt me-2"></i>Logout</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Top Nav -->

        <!-- Header -->
        <div class="col-12 bg-white pt-4">
            <div class="row">
                <div class="col-lg-auto">
                    <div class="site-logo text-center text-lg-left">
                        <a href="<?= $base_url ?>">YPA.CO Beauty</a>
                    </div>
                </div>
            
                <div class="col-lg-auto ms-auto text-center text-lg-left header-item-holder">
                    <?php
                    if (isset($_SESSION['login'])) {
                        $id_user = $_SESSION['id'];
                        $cariKeranjang = mysqli_query($koneksi, "SELECT * FROM `tb_cart` WHERE `id_user` = '$id_user' AND `status` = 'cart'");
                        $fetchKeranjang = mysqli_fetch_assoc($cariKeranjang);
                        $getIDOrder = $fetchKeranjang['id_order'];
                        $showKeranjang = mysqli_query($koneksi, "SELECT * FROM `tb_detail_order`, `tb_produk` WHERE `id_order` = '$getIDOrder' AND `tb_detail_order`.`id_product`=`tb_produk`.`id_product` ORDER by `tb_detail_order`.`id_product` ASC");
                        $getRow = mysqli_num_rows($showKeranjang);
                    } else {
                        $getRow = '0';
                    }
                    ?>
                    <?php if (!isset($_SESSION['login'])) : ?>
                    <?php else : ?>
                        <a href="<?= $base_url ?>cart.php" class="header-item">
                            <i class="fas fa-shopping-bag me-2"></i><span id="header-qty" class="me-3"><?= $getRow ?></span>
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Nav -->
            <div class="row">
                <nav class="navbar navbar-expand-lg navbar-light bg-white col-12">
                    <button class="navbar-toggler d-lg-none border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="mainNav">
                        <ul class="navbar-nav mx-auto mt-2 mt-lg-0">
                            <li class="nav-item active">
                                <a class="nav-link" href="<?= $base_url ?>">Home <span class="sr-only">(current)</span></a>
                            </li>
                            <!-- <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="electronics" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Kategori Menu</a>
                                <div class="dropdown-menu" aria-labelledby="electronics">
                                    <?php
                                    $menu = mysqli_query($koneksi, "SELECT * FROM `tb_kategori` ORDER BY `tb_kategori`.`nama_kategori` ASC");
                                    foreach ($menu as $key) :
                                    ?>
                                        <a class="dropdown-item" href="<?= $base_url ?>"><?= $key['nama_kategori'] ?></a>
                                    <?php endforeach; ?>
                                </div>
                            </li> -->
                            <?php if (!isset($_SESSION['login'])) : ?>

                            <?php else : ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= $base_url ?>history.php">History Pesanan </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </nav>
            </div>
            <!-- Nav -->

        </div>
        <!-- Header -->

    </header>
</div>