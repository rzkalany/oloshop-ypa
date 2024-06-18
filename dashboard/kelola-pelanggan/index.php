<?php
require_once '../../config/koneksi.php';

$query = "SELECT * FROM `tb_users` WHERE `role` != 'admin'";
$result = mysqli_query($koneksi, $query);
$no = 1;

if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $nama_lengkap = $_POST['nama'];
    $no_telp = $_POST['no_telp'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "UPDATE `tb_users` SET `nama_lengkap`='$nama_lengkap',`email`='$email',`password`='$password',`no_telp`='$no_telp',`alamat`='$alamat' WHERE `id_user`='$id'";
    $result = mysqli_query($koneksi, $sql);
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

    $sql = "DELETE FROM `tb_users` WHERE `id_user` = '$id'";
    $result = mysqli_query($koneksi, $sql);
    if ($result > 0) {
        echo "
            <script>
                alert('Data Berhasil Dihapuskan!');
                window.location.href = '';
            </script>
        ";
    } else {
        echo "Error : " . $sql . "<br>" . mysqli_error($koneksi);
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
                        <h1 class="h3 mb-0 text-gray-800">Kelola Pelanggan</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Pelanggan</h6>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>No Telpon</th>
                                            <th>Alamat</th>
                                            <th>Email</th>
                                            <th>Password</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($result as $data) : ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $data['nama_lengkap'] ?></td>
                                                <td><?= $data['no_telp'] ?></td>
                                                <td><?= $data['alamat'] ?></td>
                                                <td><?= $data['email'] ?></td>
                                                <td><?= $data['password'] ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal-<?= $data['id_user'] ?>">Edit</button>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal-<?= $data['id_user'] ?>">Hapus</button>
                                                </td>
                                            </tr>

                                            <!-- Modal Edit -->
                                            <div class="modal fade" id="editModal-<?= $data['id_user'] ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
                                                        </div>
                                                        <form action="" method="post">
                                                            <input type="hidden" name="id" value="<?= $data['id_user'] ?>">
                                                            <div class="modal-body">
                                                                <div class="form-group row">
                                                                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" value="<?= $data['nama_lengkap'] ?>" autocomplete="off" required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="no_telp" class="col-sm-2 col-form-label">No Telpon</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="No Telpon" value="<?= $data['no_telp'] ?>" autocomplete="off" required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" value="<?= $data['alamat'] ?>" autocomplete="off" required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?= $data['email'] ?>" autocomplete="off" required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" class="form-control" id="password" name="password" placeholder="Password" value="<?= $data['password'] ?>" autocomplete="off" required>
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
                                            <div class="modal fade" id="deleteModal-<?= $data['id_user'] ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModalLabel">Hapus Data</h5>
                                                        </div>
                                                        <form action="" method="post">
                                                            <div class="modal-body h4 text-danger text-center">
                                                                <input type="hidden" name="id" value="<?= $data['id_user'] ?>">
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