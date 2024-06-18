<?php
require_once 'config/koneksi.php';
session_start();

$id_user = $_SESSION['id'];
$getIDOrders = $_GET['id'];
$queryKeranjang = mysqli_query($koneksi, "SELECT * FROM `tb_cart`, `tb_detail_order`, `tb_produk` WHERE `tb_cart`.`id_order` = '$getIDOrders' AND `tb_cart`.`id_order` = `tb_detail_order`.`id_order` AND `tb_detail_order`.`id_product`=`tb_produk`.`id_product` ORDER by `tb_detail_order`.`id_product` ASC");
$fetchKeranjang = mysqli_fetch_assoc($queryKeranjang);
$no = 1;
$ongkir = 20000;
$totalHarga = 0;
?>

<!doctype html>
<html lang="en">

<head>
    <?php
    require_once 'partikel/head.php'
    ?>

<body>
    <div class="container-fluid">

        <div class="row min-vh-100">
            <?php
            require_once 'partikel/navbar.php';
            ?>

            <div class="col-12">
                <!-- Main Content -->
                <div class="row">
                    <div class="col-12 mt-2 mb-2 text-center text-uppercase">
                        <h2>HISTORY BELANJA</h2>
                    </div>
                </div>

                <main class="row">
                    <div class="col-12 bg-white py-3 mb-3">
                        <div class="col-12">
                            <table class="table table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Produk</th>
                                        <th>Nama Produk</th>
                                        <th>Jumlah</th>
                                        <th>Harga Satuan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($queryKeranjang as $data) : ?>
                                        <?php
                                        $totalHarga += $data['harga'] * $data['qty'];
                                        ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><img src="<?= $base_url ?>assets/images/<?= $data['foto_product'] ?>" class="img-fluid"></td>
                                            <td><?= $data['nama_product'] ?></td>
                                            <td><?= $data['qty'] ?></td>
                                            <td>Rp<?= number_format($data['harga'], 0, ",", ".") ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <?php
                                    $subtotal = $ongkir + $totalHarga;
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="text-right">Total</th>
                                        <th>Rp <?= number_format($totalHarga, 0, ",", ".") ?></th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <th class="text-right">Ongkir</th>
                                        <th>Rp <?= number_format($ongkir, 0, ",", ".") ?></th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <th class="text-right">Subtotal</th>
                                        <th>Rp <?= number_format($subtotal, 0, ",", ".") ?></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
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