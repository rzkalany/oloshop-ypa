<?php
require_once '../config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Proses pengiriman email kepada admin
    $to = "rizkamaelani0504@gmail.com";
    $subject = "Permintaan Penggantian Password";
    $message = "Ada pengguna yang ingin mengganti password. Silakan lakukan tindakan yang diperlukan. Email pengguna: " . $email;
    $headers = "From:" . $email;

    // Kirim email
    mail($to, $subject, $message, $headers);

    // Redirect atau tampilkan pesan bahwa email telah dikirim
    // Contoh redirect ke halaman sukses
    header("Location: lupa_password_sukses.php");
    exit;
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
                        <h2>Lupa Password</h2>
                    </div>
                </div>

                <main class="row">
                    <div class="col-lg-4 col-md-6 col-sm-8 mx-auto bg-white py-3 mb-4">
                        <div class="row">
                            <div class="col-12">
                                <p>Jika Anda lupa password, silakan masukkan email Anda. Kami akan mengirim instruksi penggantian password ke admin.</p>
                                <form action="" method="POST">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" id="email" name="email" class="form-control" autocomplete="off" required>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-outline-dark w-100">Kirim</button>
                                    </div>
                                </form>
                                <p>Catatan: Proses penggantian password akan dilakukan oleh admin setelah menerima email Anda.</p>
                            </div>
                        </div>
                    </div>

                </main>
                <!-- Main Content -->
            </div>

            <?php require_once '../partikel/footer.php'; ?>

        </div>

        <?php require_once '../partikel/javascript.php'; ?>
</body>
</html>