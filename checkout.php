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
$ongkir = 20000;
$showPembayaran = mysqli_query($koneksi, "SELECT * FROM `tb_pembayaran`");

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

if (isset($_POST['checkout'])) {
    $id_pembayaran = $_POST['id_pembayaran'];
    $status = "Pembayaran";

    if ($_FILES['upload_bukti']['error'] === 4) {
        $bukti_upload = "0";
    } else {
        $bukti_upload = upload_bukti();
    }

    $query = "UPDATE `tb_cart` SET `status`='$status',`id_payment`='$id_pembayaran',`bukti_pembayaran`='$bukti_upload' WHERE `id_order`='$getIDOrder'";
    $result = mysqli_query($koneksi, $query);
    if ($result) {
        echo "
            <script>
                alert('Barang Berhasil Dicheckout');
                window.location.href = '';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Barang Gagal Dicheckout');
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
                    <div class="col-12 mb-2 text-center text-uppercase">
                        <h2>KERANJANG BELANJA</h2>
                    </div>
                </div>

                <main class="row">
                    <div class="col-12 bg-white py-3 mb-3">
                        <div class="row">
                            <div class="col-lg-6 col-md-8 col-sm-10 mx-auto table-responsive">
                                <div class="row">
                                    <form action="" method="post" enctype="multipart/form-data">
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
                                                                <input type="hidden" name="id_product" value="<?= $data['id_product'] ?>">
                                                                <button class="btn btn-link text-danger" type="submit" name="delete"><i class="fas fa-times"></i></button>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                        $totalHarga += $data['harga'] * $data['qty'];
                                                        ?>
                                                    <?php endforeach; ?>
                                                    <?php
                                                    $subtotal = $ongkir + $totalHarga;
                                                    ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="3" class="text-right">Total</th>
                                                        <th>Rp <?= number_format($totalHarga, 0, ",", ".") ?></th>
                                                        <th></th>
                                                    </tr>
                                                    <tr>
                                                        <th colspan="3" class="text-right">Ongkir</th>
                                                        <th>Rp <?= number_format($ongkir, 0, ",", ".") ?></th>
                                                        <th></th>
                                                    </tr>
                                                    <tr>
                                                        <th colspan="3" class="text-right">Subtotal</th>
                                                        <th>Rp <?= number_format($subtotal, 0, ",", ".") ?></th>
                                                        <th></th>
                                                    </tr>
                                                    <tr>
                                                        <th colspan="3">No Resi</th>
                                                        <th colspan="2"><?= $fetchKeranjang['id_order'] ?></th>
                                                    </tr>
                                                    <tr>
                                                        <th colspan="3">Pilih Metode Pembayaran</th>
                                                        <th colspan="2">
                                                            <select class="form-select form-select-sm" aria-label="Default select example" name="id_pembayaran">
                                                                <?php foreach ($showPembayaran as $data) : ?>
                                                                    <option value="<?= $data['id_pembayaran'] ?>"><?= $data['nama_bank'] ?> - <?= $data['no_rekening'] ?> a/n <?= $data['atas_nama'] ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th colspan="3">
                                                            Upload Bukti Pembayaran
                                                            <div id="emailHelp" class="form-text h6">(kosongkan jika metode pembayaran COD)</div>
                                                        </th>
                                                        <th colspan="2">
                                                            <input class="form-control form-control-sm" id="formFileSm" name="upload_bukti" type="file" required>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5" class="text-center">
                                                            Harap melampirkan bukti pembayaran sebelum menekan tombol Selesaikan Pembayaran.
                                                            <div>Jika tidak melampirkan bukti pembayaran maka otomatis pesanan anda akan ditolak.</div>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <div class="col-12 text-right">
                                            <a href="cart.php" class="btn btn-outline-secondary ">Kembali Kekeranjang</a>
                                            <button type="submit" name="checkout" class="btn btn-outline-success">Selesaikan Pembayaran</button>
                                        </div>
                                    </form>
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