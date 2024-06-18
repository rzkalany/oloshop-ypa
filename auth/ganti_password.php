<?php
require_once '../config/koneksi.php';
session_start();

if (isset($_POST['submit'])) {
    $password_baru = $_POST['password_baru'];
    $konfirmasi_password_baru = $_POST['konfirmasi_password_baru'];

    $id = $_SESSION['id'];

    if ($password_baru !== $konfirmasi_password_baru) {
        echo "
            <script>
                alert('Password baru dan konfirmasi password tidak cocok!');
                window.location.href = 'ganti_password.php';
            </script>
        ";
        exit;
    }

    $query = "UPDATE `tb_users` SET password='$password_baru' WHERE `id_user`='$id'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "
            <script>
                alert('Password berhasil diperbarui!');
                window.location.href = 'login.php';
            </script>
        ";
    } else {
        echo "Error : " . $sql . "<br>" . mysqli_error($koneksi);
    }

    mysqli_close($koneksi);
}
?>

<!doctype html>
<html lang="en">

<head>
    <?php require_once '../partikel/head.php'; ?>
</head>

<body>
    <div class="container-fluid">
        <div class="row min-vh-100">
            <?php require_once '../partikel/navbar.php'; ?>

            <div class="col-12">
                <!-- Main Content -->
                <div class="row">
                    <div class="col-12 mt-3 text-center text-uppercase">
                        <h2>Ubah Password</h2>
                    </div>
                </div>

                <main class="row">
                    <div class="col-lg-4 col-md-6 col-sm-8 mx-auto bg-white py-3 mb-4">
                        <div class="row">
                            <div class="col-12">
                                <form action="" method="POST">
                                    <div class="mb-3">
                                        <label for="password_baru" class="form-label">Password Baru</label>
                                        <input type="text" id="password_baru" name="password_baru" class="form-control" autocomplete="off" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="konfirmasi_password_baru" class="form-label">Konfirmasi Password</label>
                                        <input type="text" id="konfirmasi_password_baru" name="konfirmasi_password_baru" class="form-control" autocomplete="off" required>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="submit" class="btn btn-outline-dark w-100">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </main>
                <!-- Main Content -->
            </div>

            <!-- Footer -->
            <?php require_once '../partikel/footer.php'; ?>
            <!-- Footer -->

        </div>
    </div>

    <?php require_once '../partikel/javascript.php'; ?>
</body>

</html>