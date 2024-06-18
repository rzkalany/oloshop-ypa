<?php
require_once '../config/koneksi.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $no_telp = $_POST['no_telp'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = "member";

    $query = "INSERT INTO `tb_users` VALUES (NULL,'$name','$email','$password','$no_telp','$alamat','$role')";
    $result = mysqli_query($koneksi, $query);

    if ($result > 0) {
        echo "
            <script>
                alert('Selamat Akun Anda Berhasil Terdaftarkan!');
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
                        <h2>Register</h2>
                    </div>
                </div>

                <main class="row">
                    <div class="col-lg-4 col-md-6 col-sm-8 mx-auto bg-white py-3 mb-4">
                        <div class="row">
                            <div class="col-12">
                                <form action="" method="POST">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" id="name" name="name" class="form-control" autocomplete="off" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">No Telpon</label>
                                        <input type="text" id="no_telp" name="no_telp" class="form-control" autocomplete="off" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Alamat</label>
                                        <input type="text" id="alamat" name="alamat" class="form-control" autocomplete="off" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password-confirm" class="form-label">Email</label>
                                        <input type="email" id="email" name="email" class="form-control" autocomplete="off" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password-confirm" class="form-label">Password</label>
                                        <input type="text" id="password" name="password" class="form-control" autocomplete="off" required>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="submit" class="btn btn-outline-dark w-100">Register</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </main>
                <!-- Main Content -->
            </div>

            <!-- Footer -->
            <?php
            require_once '../partikel/footer.php'
            ?>
            <!-- Footer -->

        </div>
    </div>

    <?php
    require_once '../partikel/javascript.php';
    ?>
</body>

</html>