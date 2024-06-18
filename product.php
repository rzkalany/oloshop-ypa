<?php
require_once 'config/koneksi.php';
session_start();

$id = $_GET['id'];
$showProduct = mysqli_query($koneksi, "SELECT * FROM `tb_produk` INNER JOIN `tb_kategori` USING(`id_kategori`) WHERE `id_product` = '$id'");
$data = mysqli_fetch_assoc($showProduct);

if (isset($_POST['warning'])) {
    echo "
        <script>
            alert('Ops! Mohon Maaf Anda Harus Login Terlebih Dahulu');
            window.location.href = 'auth/login.php';
        </script>
    ";
}

if (isset($_POST['addproduct'])) {
    $id_user = $_SESSION['id'];
    $qty = $_POST['qty'];
    $cekKeranjang = mysqli_query($koneksi, "SELECT * FROM `tb_cart` WHERE `id_user` = '$id_user' AND `status` = 'cart'");
    $getRow = mysqli_num_rows($cekKeranjang);
    $fetchKeranjang = mysqli_fetch_assoc($cekKeranjang);
    $getIDOrder = $fetchKeranjang['id_order'];

    if ($getRow > 0) {
        $cekBarang = mysqli_query($koneksi, "SELECT * FROM `tb_detail_order` WHERE `id_product` = '$id' AND `id_order` = '$getIDOrder'");
        $getBarang = mysqli_num_rows($cekBarang);
        $fetchBarang = mysqli_fetch_assoc($cekBarang);
        $getQTY = $fetchBarang['qty'];

        if ($getBarang > 0) {
            $newQTY = $getQTY + $qty;

            $updateQTY = mysqli_query($koneksi, "UPDATE `tb_detail_order` SET `qty`='$newQTY' WHERE `id_order`='$getIDOrder' AND `id_product`='$id'");
            if ($updateQTY > 0) {
                echo "
                    <script>
                        alert('Barang sudah pernah dimasukkan kekeranjang, Jumlah akan ditambahkan.');
                        window.location.href = 'product.php?id=" . $id . "';
                    </script>
                ";
            } else {
                echo "
                    <script>
                        alert('Gagal menambahkan kekeranjang.');
                        window.location.href = 'product.php?id=" . $id . "';
                    </script>
                ";
            }
        } else {
            $tambahData = mysqli_query($koneksi, "INSERT INTO `tb_detail_order`(`id_order`, `id_product`, `qty`) VALUES ('$getIDOrder','$id','$qty')");
            if ($tambahData > 0) {
                echo "
                    <script>
                        alert('Berhasil ditambahkan kekeranjang');
                        window.location.href = 'product.php?id=" . $id . "';
                    </script>
                ";
            } else {
                echo "
                    <script>
                        alert('Gagal menambahkan kekeranjang.');
                        window.location.href = 'product.php?id=" . $id . "';
                    </script>
                ";
            }
        }
    } else {
        // Generate ID ORDER
        $id_order = crypt(rand(22, 999), time());

        $addCart = mysqli_query($koneksi, "INSERT INTO `tb_cart`(`id_order`, `id_user`) VALUES ('$id_order','$id_user')");
        if ($addCart > 0) {
            $addDetailOrder = mysqli_query($koneksi, "INSERT INTO `tb_detail_order`(`id_order`, `id_product`, `qty`) VALUES ('$id_order','$id','$qty')");
            if ($addDetailOrder > 0) {
                echo "
                    <script>
                        alert('Berhasil ditambahkan kekeranjang');
                        window.location.href = 'product.php?id=" . $id . "';
                    </script>
                ";
            } else {
                echo "
                    <script>
                        alert('Gagal menambahkan kekeranjang.');
                        window.location.href = 'product.php?id=" . $id . "';
                    </script>
                ";
            }
        }
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <?php
    require_once 'partikel/head.php'
    ?>
</head>

<body>
    <div class="container-fluid">

        <div class="row min-vh-100">
            <?php
            require_once 'partikel/navbar.php';
            ?>

            <div class="col-12">
                <!-- Main Content -->
                <main class="row">
                    <div class="col-12 bg-white py-3 my-3">
                        <div class="row">

                            <!-- Product Images -->
                            <div class="col-lg-5 col-md-12 mb-3">
                                <div class="col-12 mb-3">
                                    <div class="img-large border" style="background-image: url('<?= $base_url ?>assets/images/<?= $data['foto_product'] ?>')">
                                    </div>
                                </div>
                            </div>
                            <!-- Product Images -->

                            <!-- Product Info -->
                            <div class="col-lg-5 col-md-9">
                                <div class="col-12 product-name large">
                                    <?= $data['nama_product'] ?>
                                </div>
                                <div class="col-12 px-0">
                                    <hr>
                                </div>
                                <div class="col-12">
                                    <?= $data['deskripsi'] ?>
                                </div>
                            </div>
                            <!-- Product Info -->

                            <!-- Sidebar -->
                            <div class="col-lg-2 col-md-3 text-center">
                                <div class="col-12 sidebar h-100">
                                    <div class="row">
                                        <div class="col-12">
                                            <span class="detail-price">
                                                Rp<?= number_format($data['harga'], 0, ",", ".") ?>
                                            </span>
                                        </div>
                                        <?php if (!isset($_SESSION['login'])) : ?>
                                            <form action="" method="post">
                                                <div class="col-xl-5 col-md-9 col-sm-3 col-5 mx-auto mt-3">
                                                    <div class="mb-3">
                                                        <label for="qty">Quantity</label>
                                                        <input type="number" id="qty" name="qty" min="1" value="1" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-12 mt-3">
                                                    <input type="hidden" name="id_product" value="<?= $id ?>">
                                                    <button class="btn btn-outline-dark" name="warning" type="submit"><i class="fas fa-cart-plus me-2"></i>Add to cart</button>
                                                </div>
                                            </form>
                                        <?php else : ?>
                                            <form action="" method="post">
                                                <div class="col-xl-5 col-md-9 col-sm-3 col-5 mx-auto mt-3">
                                                    <div class="mb-3">
                                                        <label for="qty">Quantity</label>
                                                        <input type="number" id="qty" name="qty" min="1" value="1" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-12 mt-3">
                                                    <input type="hidden" name="id_product" value="<?= $id ?>">
                                                    <button class="btn btn-outline-dark" name="addproduct" type="submit"><i class="fas fa-cart-plus me-2"></i>Add to cart</button>
                                                </div>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <!-- Sidebar -->

                        </div>
                    </div>

                </main>
                <!-- Main Content -->
            </div>

            <?php
            require_once 'partikel/footer.php'
            ?>
        </div>

    </div>
    <?php
    require_once 'partikel/javascript.php'
    ?>
</body>

</html>