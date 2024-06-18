<?php
require_once 'config/koneksi.php';
session_start();

$id_user = $_SESSION['id'];
$cariKeranjang = mysqli_query($koneksi, "SELECT * FROM `tb_cart` WHERE `id_user` = '$id_user' AND `status` = 'cart'");
$fetchKeranjang = mysqli_fetch_assoc($cariKeranjang);
$getIDOrder = $fetchKeranjang['id_order'];
$showKeranjang = mysqli_query($koneksi, "SELECT * FROM `tb_detail_order`, `tb_produk` WHERE `id_order` = '$getIDOrder' AND `tb_detail_order`.`id_product`=`tb_produk`.`id_product` ORDER by `tb_detail_order`.`id_product` ASC");
$no = 1;
$totalHarga = 0;

if (isset($_POST["delete"])) {
    $id_product = $_POST['id_product'];
    $result = mysqli_query($koneksi, "DELETE FROM `tb_detail_order` WHERE `id_product` = '$id_product' AND `id_order` = '$getIDOrder'");
    if ($result) {
        echo "
            <script>
                alert('Barang Berhasil Dihapuskan');
                window.location.href = '';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Barang Gagal Dihapuskan');
                window.location.href = '';
            </script>
        ";
    }
}
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
                    <div class="col-12 mt-3 mb-3 text-center text-uppercase">
                        <h2>KERANJANG BELANJA</h2>
                    </div>
                </div>

                <main class="row">
                    <div class="col-12 bg-white py-3 mb-3">
                        <div class="row">
                            <div class="col-lg-6 col-md-8 col-sm-10 mx-auto table-responsive">
                                <div class="row">
                                    <div class="col-12">
                                        <table class="table table-hover table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Harga Satuan</th>
                                                    <th>Qty</th>
                                                    <th>Total Harga</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($showKeranjang as $data) : ?>
                                                    <tr>
                                                        <td>
                                                            <img src="<?= $base_url ?>assets/images/<?= $data['foto_product'] ?>" class="img-fluid">
                                                        </td>
                                                        <td>Rp <?= number_format($data['harga'], 0, ",", ".") ?></td>
                                                        <td><?= $data['qty'] ?></td>
                                                        <td>Rp <?= number_format(($data['harga'] * $data['qty']), 0, ",", ".") ?></td>
                                                        <td>
                                                            <form action="" method="POST">
                                                                <input type="hidden" name="id_product" value="<?= $data['id_product'] ?>">
                                                                <button type="submit" name="delete" class="btn btn-danger"><i class="fas fa-times"></i></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $totalHarga += $data['harga'] * $data['qty'];
                                                    ?>
                                                <?php endforeach; ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="3" class="text-right">Total</th>
                                                    <th>Rp <?= number_format($totalHarga, 0, ",", ".") ?></th>
                                                    <th></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="col-12 text-right">
                                        <a href="index.php" class="btn btn-outline-secondary ">Lanjut Belanja</a>
                                        <a href="checkout.php" class="btn btn-outline-success">Pembayaran</a>
                                    </div>
                                </div>
                            </div>
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