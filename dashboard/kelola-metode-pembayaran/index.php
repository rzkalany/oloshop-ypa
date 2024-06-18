<?php
require_once '../../config/koneksi.php';

$query = "SELECT * FROM `tb_pembayaran`";
$result = mysqli_query($koneksi, $query);
$no = 1;

if (isset($_POST['submit'])) {
    $nama_bank = $_POST['nama_bank'];
    $no_rekening = $_POST['no_rekening'];
    $atas_nama = $_POST['atas_nama'];

    $query = "INSERT INTO `tb_pembayaran` VALUES (NULL,'$nama_bank','$no_rekening','$atas_nama')";
    $result = mysqli_query($koneksi, $query);

    if ($result > 0) {
        echo "
            <script>
                alert('Data Berhasil Ditambahkan!');
                window.location.href = '';
            </script>
        ";
    } else {
        echo "Error : " . $sql . "<br>" . mysqli_error($koneksi);
    }

    mysqli_close($koneksi);
}

if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $nama_bank = $_POST['nama_bank'];
    $no_rekening = $_POST['no_rekening'];
    $atas_nama = $_POST['atas_nama'];

    $query = "UPDATE `tb_pembayaran` SET `nama_bank`='$nama_bank',`no_rekening`='$no_rekening',`atas_nama`='$atas_nama' WHERE `id_pembayaran`='$id'";
    $result = mysqli_query($koneksi, $query);

    if ($result > 0) {
        echo "
            <script>
                alert('Data Berhasil Diperbaharui!');
                window.location.href = '';
            </script>
        ";
    } else {
        echo "Error : " . $sql . "<br>" . mysqli_error($koneksi);
    }

    mysqli_close($koneksi);
}

if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    $query = "DELETE FROM `tb_pembayaran` WHERE `id_pembayaran` = '$id'";
    $result = mysqli_query($koneksi, $query);

    if ($result > 0) {
        echo "
            <script>
                alert('Data Berhasil Dihapuskan!');
                window.location.href = '';
            </script>
        ";
    } else {
        echo "Error : " . $query . "<br>" . mysqli_error($koneksi);
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
                        <h1 class="h3 mb-0 text-gray-800">Kelola Pembayaran</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar No Rekening</h6>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                Tambah Data
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                                        </div>
                                        <form action="" method="post">
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <label for="nama_bank" class="col-sm-2 col-form-label">Nama Bank</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="nama_bank" name="nama_bank" placeholder="Nama Bank" autocomplete="off" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="no_rekening" class="col-sm-2 col-form-label">No Rekening</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="no_rekening" name="no_rekening" placeholder="No Rekening" autocomplete="off" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="atas_nama" class="col-sm-2 col-form-label">Atas Nama</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="atas_nama" name="atas_nama" placeholder="Atas Nama" autocomplete="off" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Bank</th>
                                            <th>No Rekening</th>
                                            <th>Atas Nama</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($result as $data) : ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $data['nama_bank'] ?></td>
                                                <td><?= $data['no_rekening'] ?></td>
                                                <td><?= $data['atas_nama'] ?></td>
                                                <td>
                                                    <button class="btn btn-warning" data-toggle="modal" data-target="#editModal-<?= $data['id_pembayaran'] ?>">Edit</button>
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal-<?= $data['id_pembayaran'] ?>">Delete</button>
                                                </td>
                                            </tr>

                                            <!-- Modal Edit -->
                                            <div class="modal fade" id="editModal-<?= $data['id_pembayaran'] ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel">Tambah Data</h5>
                                                        </div>
                                                        <form action="" method="post">
                                                            <div class="modal-body">
                                                                <input type="hidden" name="id" value="<?= $data['id_pembayaran'] ?>">
                                                                <div class="form-group row">
                                                                    <label for="nama_bank" class="col-sm-2 col-form-label">Nama Bank</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" class="form-control" id="nama_bank" name="nama_bank" placeholder="Nama Bank" value="<?= $data['nama_bank'] ?>" autocomplete="off" required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="no_rekening" class="col-sm-2 col-form-label">No Rekening</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" class="form-control" id="no_rekening" name="no_rekening" placeholder="No Rekening" value="<?= $data['no_rekening'] ?>" autocomplete="off" required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="atas_nama" class="col-sm-2 col-form-label">Atas Nama</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" class="form-control" id="atas_nama" name="atas_nama" placeholder="Atas Nama" value="<?= $data['atas_nama'] ?>" autocomplete="off" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" name="edit" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal Delete -->
                                            <div class="modal fade" id="deleteModal-<?= $data['id_pembayaran'] ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModalLabel">Hapus Data</h5>
                                                        </div>
                                                        <form action="" method="post">
                                                            <div class="modal-body h4 text-danger text-center">
                                                                <input type="hidden" name="id" value="<?= $data['id_pembayaran'] ?>">
                                                                Apakah anda yakin ingin menghapus data ini?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-dark" data-dismiss="modal">No</button>
                                                                <button type="submit" name="delete" class="btn btn-danger">Yes</button>
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