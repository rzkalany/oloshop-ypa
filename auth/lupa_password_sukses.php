<?php
require_once '../config/koneksi.php';
?>

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
                                <div class="card">
                                    <div class="card-body">
                                        <h2 class="text-center">Permintaan Penggantian Password Telah Terkirim!</h2>
                                        <p class="text-center">Silakan tunggu instruksi selanjutnya dari admin melalui email.</p>
                                        <p class="text-center">Jika Anda tidak menerima email dalam beberapa menit, periksa folder spam atau junk email Anda.</p>
                                        <p class="text-center"><a href="<?= $base_url ?>">Kembali ke Halaman Utama</a></p>
                                    </div>
                                </div>
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