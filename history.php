<?php
require_once 'config/koneksi.php';
session_start();

$id_user = $_SESSION['id'];
$queryKeranjang = mysqli_query($koneksi, "SELECT * FROM `tb_cart`, `tb_users`,`tb_pembayaran` WHERE `tb_users`.`id_user` = '$id_user' AND `tb_cart`.`id_payment` = `tb_pembayaran`.`id_pembayaran` AND `tb_cart`.`id_user` = `tb_users`.`id_user` AND `status` != 'cart' AND `status` != 'Selesai' ORDER BY `id_cart` ASC");
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
                                        <th>No Resi</th>
                                        <th>Tanggal Order</th>
                                        <th>Total Belanja</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($queryKeranjang as $data) : ?>
                                        <?php
                                        $id_orders = $data['id_order'];
                                        $result = mysqli_query($koneksi, "SELECT SUM(`tb_detail_order`.`qty` * `tb_produk`.`harga` + 20000) AS `count` FROM `tb_detail_order`, `tb_produk` WHERE `id_order` = '$id_orders' AND `tb_produk`.`id_product` = `tb_detail_order`.`id_product` ORDER BY `tb_detail_order`.`id_product` ASC");
                                        $row = mysqli_fetch_assoc($result);
                                        $count = $row['count'];
                                        ?>
                                        <tr>
                                            <td><a href="<?= $base_url ?>historyDetail.php?id=<?= $data['id_order'] ?>" class="text-decoration-none"><?= $data['id_order'] ?></a></td>
                                            <td><?= $data['tgl_order'] ?></td>
                                            <td>Rp <?= number_format($count, 0, ",", ".") ?></td>
                                            <td><?= $data['status'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
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