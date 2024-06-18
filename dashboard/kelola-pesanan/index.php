<?php
require_once '../../config/koneksi.php';

$queryKelolaPesanan = "SELECT * FROM `tb_cart`, `tb_users`,`tb_pembayaran` WHERE `tb_cart`.`id_payment` = `tb_pembayaran`.`id_pembayaran` AND `tb_cart`.`id_user` = `tb_users`.`id_user` AND `status` != 'cart' AND `status` != 'Selesai' ORDER BY `id_cart` ASC";
$showKelolaPesanan = mysqli_query($koneksi, $queryKelolaPesanan);
$no = 1;

if (isset($_POST['update'])) {
    $id_order = $_POST['id_order'];
    $status = $_POST['status'];

    $query = "UPDATE `tb_cart` SET `status`='$status' WHERE `id_order`='$id_order'";
    $result = mysqli_query($koneksi, $query);
    if ($result) {
        echo "
            <script>
                alert('Status Pengiriman Berhasil Diupdate');
                window.location.href = '';
            </script>
        ";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }

    mysqli_close($koneksi);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once '../../partikel/head-admin.php';
    ?>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
        require_once '../../partikel/sidebar-admin.php'
        ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php
                require_once '../../partikel/topbar-admin.php';
                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Kelola Pesanan</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Pesanan</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No Resi</th>
                                            <th>Nama Customer</th>
                                            <th>Tanggal Order</th>
                                            <th>Metode Pembayaran</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($showKelolaPesanan as $data) : ?>
                                            <?php
                                            $id_orders = $data['id_order'];
                                            $result = mysqli_query($koneksi, "SELECT SUM(`tb_detail_order`.`qty` * `tb_produk`.`harga` + 20000) AS `count` FROM `tb_detail_order`, `tb_produk` WHERE `id_order` = '$id_orders' AND `tb_produk`.`id_product` = `tb_detail_order`.`id_product` ORDER BY `tb_detail_order`.`id_product` ASC");
                                            $cekRow = mysqli_num_rows($result);
                                            $row = mysqli_fetch_assoc($result);
                                            $count = $row['count'];
                                            ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $data['id_order'] ?></td>
                                                <td><?= $data['nama_lengkap'] ?></td>
                                                <td><?= $data['tgl_order'] ?></td>
                                                <td><?= $data['nama_bank'] ?> - <?= $data['no_rekening'] ?> a/n <?= $data['atas_nama'] ?></td>
                                                <td>Rp
                                                    <?php
                                                    if ($cekRow > 0) {
                                                        echo number_format($count, 0, ",", ".");
                                                    } else {
                                                        echo 'No Data';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalStatus<?= $data['id_cart'] ?>">
                                                        Update Status
                                                    </button>
                                                </td>
                                            </tr>

                                            <!-- Modal -->
                                            <div class="modal fade" id="modalStatus<?= $data['id_cart'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Bukti Pembayaran & Update Status</h5>
                                                        </div>
                                                        <form action="" method="post">
                                                            <div class="modal-body">
                                                                <div class="mb-2">
                                                                    <?php if ($data['bukti_pembayaran'] == '0') : ?>
                                                                        <div class="form-group row">
                                                                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Pilih Status</label>
                                                                            <div class="col-sm-10">
                                                                                Sistem Pembayaran Anda COD
                                                                            </div>
                                                                        </div>
                                                                    <?php else : ?>
                                                                        <div class="text-center">
                                                                            <img src="<?= $base_url ?>assets/images/<?= $data['bukti_pembayaran'] ?>" class="img-fluid">
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Pilih Status</label>
                                                                    <div class="col-sm-10">
                                                                        <select class="form-control" id="exampleFormControlSelect1" name="status">
                                                                            <option value="Ditolak" <?php if ($data['status'] == 'Ditolak') echo 'selected' ?>>Ditolak</option>
                                                                            <option value="Pesanan Sedang Dikemas" <?php if ($data['status'] == 'Pesanan Sedang Dikemas') echo 'selected' ?>>Pesanan Sedang Dikemas</option>
                                                                            <option value="Pesanan Sedang Dipickup Kurir" <?php if ($data['status'] == 'Pesanan Sedang Dipickup Kurir') echo 'selected' ?>>Pesanan Sedang Dipickup Kurir</option>
                                                                            <option value="Pesanan Sedang Diantar Kealamat Tujuan" <?php if ($data['status'] == 'Pesanan Sedang Diantar Kealamat Tujuan') echo 'selected' ?>>Pesanan Sedang Diantar Kealamat Tujuan</option>
                                                                            <option value="Selesai" <?php if ($data['status'] == 'Selesai') echo 'selected' ?>>Selesai</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="hidden" name="id_order" value="<?= $data['id_order'] ?>">
                                                                <button type="submit" name="update" class="btn btn-primary">Save</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php
            require_once '../../partikel/footer-admin.php'
            ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <?php
    require_once '../../partikel/main_footer-admin.php';
    ?>

</body>

</html>