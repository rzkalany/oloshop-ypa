<?php
require_once '../config/koneksi.php';

session_start();

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = "SELECT * FROM `tb_users` WHERE `email` = '$email' AND `password` = '$password'";
    $result = mysqli_query($koneksi, $query);
    $cek = mysqli_num_rows($result);

    if ($cek > 0) {

        $cekRole = mysqli_fetch_array($result);

        if ($cekRole['role'] == 'member') {
            $_SESSION['id'] = $cekRole['id_user'];
            $_SESSION['nama'] = $cekRole['nama_lengkap'];
            $_SESSION['no_telp'] = $cekRole['no_telp'];
            $_SESSION['role'] = $cekRole['role'];
            $_SESSION['login'] = true;

            echo "
                <script>
                    alert('Anda Berhasil Login');
                    document.location.href = '../index.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Selamat Datang Kembali Admin');
                    document.location.href = '../dashboard/index.php';
                </script>
            ";
        }
    } else {
        echo "
            <script>
                alert('Mohon Maaf! Data Anda Tidak Ada Di Sistem Kami');
                document.location.href = 'login.php';
            </script>
        ";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <?php
    require_once '../partikel/head.php';
    ?>
</head>

<body>
    <div class="container-fluid">
        <div class="row min-vh-100">
            <?php
            require_once '../partikel/navbar.php';
            ?>

            <div class="col-12">
                <!-- Main Content -->
                <div class="row">
                    <div class="col-12 mt-3 text-center text-uppercase">
                        <h2>Login</h2>
                    </div>
                </div>

                <main class="row">
                    <div class="col-lg-4 col-md-6 col-sm-8 mx-auto bg-white py-3 mb-4">
                        <div class="row">
                            <div class="col-12">
                                <form action="" method="POST">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" id="email" name="email" class="form-control" autocomplete="off" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" id="password" name="password" class="form-control" autocomplete="off" required>
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" name="submit" class="btn btn-outline-dark w-100">Login</button>
                                    </div>
                                    <div class="mb-3 text-end">
                                        <a href="<?= $base_url ?>auth/lupa_password.php" class="text-decoration-none text-secondary">Lupa Password</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </main>
                <!-- Main Content -->
            </div>

            <?php
            require_once '../partikel/footer.php'
            ?>

        </div>

        <?php
        require_once '../partikel/javascript.php';
        ?>
</body>

</html>