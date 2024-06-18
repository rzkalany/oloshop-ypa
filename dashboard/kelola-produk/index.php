<?php
require_once '../../config/koneksi.php';
require_once '../../config/function.php';

$queryKategori = "SELECT * FROM `tb_kategori`";
$resultKategori = mysqli_query($koneksi, $queryKategori);

$query = "SELECT * FROM `tb_produk` INNER JOIN `tb_kategori` USING(`id_kategori`)";
$result = mysqli_query($koneksi, $query);
$no = 1;

if (isset($_POST['submit'])) {
    $nama_produk = htmlspecialchars($_POST['nama_produk']);
    $kategori = htmlspecialchars($_POST['kategori']);
    $harga = htmlspecialchars($_POST['harga']);
    $deskripsi = htmlspecialchars($_POST['deskripsi']);
    $foto_produk = upload();

    if (!$foto_produk) {
        return false;
    } else {
        $query = "INSERT INTO `tb_produk` VALUES (null,'$nama_produk','$kategori','$harga','$deskripsi','$foto_produk',CURRENT_DATE)";
        $result = mysqli_query($koneksi, $query);
        if ($result > 0) {
            echo "
            <script>
                alert('Data Berhasil Ditambahkan!');
                window.location.href = '';
            </script>
        ";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
        }

        mysqli_close($koneksi);
    }
}

if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $nama_produk = htmlspecialchars($_POST['nama_produk']);
    $kategori = htmlspecialchars($_POST['kategori']);
    $harga = htmlspecialchars($_POST['harga']);
    $deskripsi = htmlspecialchars($_POST['deskripsi']);
    $foto_produk_lama = $_POST['foto_produk_lama'];


    if ($_FILES['foto_produk']['error'] === 4) {
        $foto_produk = $foto_produk_lama;
    } else {
        $foto_produk = upload();
    }

    $query = "UPDATE `tb_produk` SET `nama_product`='$nama_produk',`id_kategori`='$kategori',`harga`='$harga',`deskripsi`='$deskripsi',`foto_product`='$foto_produk' WHERE `id_product`='$id'";
    $result = mysqli_query($koneksi, $query);
    if ($result > 0) {
        echo "
            <script>
                alert('Data Berhasil Diperbaharui!');
                window.location.href = '';
            </script>
        ";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }

    mysqli_close($koneksi);
}

if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    $query = "DELETE FROM `tb_produk` WHERE `id_product` = '$id'";
    $result = mysqli_query($koneksi, $query);
    if ($result > 0) {
        echo "
            <script>
                alert('Data Berhasil Dihapuskan!');
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
                        <h1 class="h3 mb-0 text-gray-800">Kelola Produk</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Produk</h6>
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
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <label for="nama_produk" class="col-sm-2 col-form-label">Nama Produk</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="Nama Produk" autocomplete="off" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                                                    <div class="col-sm-10">
                                                        <select class="custom-select" name="kategori">
                                                            <?php foreach ($resultKategori as $data) : ?>
                                                                <option value="<?= $data['id_kategori'] ?>"><?= $data['nama_kategori'] ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="harga" name="harga" placeholder="Harga" autocomplete="off" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                                                    <div class="col-sm-10">
                                                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Deskripsi"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="foto_produk" class="col-sm-2 col-form-label">Foto Produk</label>
                                                    <div class="col-sm-10">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="foto_produk" name="foto_produk">
                                                            <label class="custom-file-label" for="foto_produk">Choose file</label>
                                                        </div>
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
                                            <th>Gambar</th>
                                            <th>Nama Produk</th>
                                            <th>Kategori</th>
                                            <th>Harga</th>
                                            <th>Deskripsi</th>
                                            <th>Tanggal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($result as $row) : ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><img src="<?= $base_url ?>assets/images/<?= $row['foto_product'] ?>" width="150px"></td>
                                                <td><?= $row['nama_product'] ?></td>
                                                <td><?= $row['nama_kategori'] ?></td>
                                                <td><?= $row['harga'] ?></td>
                                                <td><?= $row['deskripsi'] ?></td>
                                                <td><?= $row['tanggal'] ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editModal-<?= $row['id_product'] ?>">Edit</button>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapusModal-<?= $row['id_product'] ?>">Delete</button>
                                                </td>
                                            </tr>

                                            <!-- Modal Edit -->
                                            <div class="modal fade" id="editModal-<?= $row['id_product'] ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel">Tambah Data</h5>
                                                        </div>
                                                        <form action="" method="post" enctype="multipart/form-data">
                                                            <div class="modal-body">
                                                                <input type="hidden" name="foto_produk_lama" value="<?= $row['foto_product'] ?>">
                                                                <input type="hidden" name="id" value="<?= $row['id_product'] ?>">
                                                                <div class="form-group row">
                                                                    <label for="nama_produk" class="col-sm-2 col-form-label">Nama Produk</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="Nama Produk" value="<?= $row['nama_product'] ?>" autocomplete="off" required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                                                                    <div class="col-sm-10">
                                                                        <select class="custom-select" name="kategori">
                                                                            <?php foreach ($resultKategori as $data) : ?>
                                                                                <option value="<?= $data['id_kategori'] ?>" <?php if ($row['id_kategori'] == $data['id_kategori']) echo "selected" ?>><?= $data['nama_kategori'] ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" class="form-control" id="harga" name="harga" placeholder="Harga" value="<?= $row['harga'] ?>" autocomplete="off" required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                                                                    <div class="col-sm-10">
                                                                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Deskripsi"><?= $row['deskripsi'] ?></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="foto_produk" class="col-sm-2 col-form-label">Foto Produk</label>
                                                                    <div class="col-sm-10">
                                                                        <div class="custom-file">
                                                                            <input type="file" class="custom-file-input" id="foto_produk" name="foto_produk">
                                                                            <label class="custom-file-label" for="foto_produk">Choose file</label>
                                                                        </div>
                                                                        <picture>
                                                                            <img src="<?= $base_url ?>assets/images/<?= $row['foto_product'] ?>" class="img-fluid img-thumbnail w-100 mt-2" alt="...">
                                                                        </picture>
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
                                            <div class="modal fade" id="hapusModal-<?= $row['id_product'] ?>" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="hapusModalLabel">Hapus Data</h5>
                                                        </div>
                                                        <form action="" method="post">
                                                            <div class="modal-body h4 text-danger text-center">
                                                                <input type="hidden" name="id" value="<?= $row['id_product'] ?>">
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
                                        <?php endforeach ?>
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