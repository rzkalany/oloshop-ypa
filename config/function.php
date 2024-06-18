<?php
require_once 'koneksi.php';

function upload()
{
    $nameFiles = $_FILES['foto_produk']['name'];
    $ukuranFiles = $_FILES['foto_produk']['size'];
    $error = $_FILES['foto_produk']['error'];
    $tmpFiles = $_FILES['foto_produk']['tmp_name'];

    if ($error === 4) {
        echo "
            <script>
                alert('Pilih gambar terlebih dahulu');
                window.location.href = '';
            </script>
        ";

        return false;
    }

    $ekstensiGambarValid = ['jpg', 'png', 'jpeg'];
    $ekstensiGambar = explode('.', $nameFiles);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "
            <script>
                alert('Ini bukan gambar!');
                window.location.href = '';
            </script>
        ";

        return false;
    }

    if ($ukuranFiles > 1000000) {
        echo "
            <script>
                alert('Ukuran terlalu besar!');
                window.location.href = '';
            </script>
        ";

        return false;
    }

    $nameFilesBaru = uniqid();
    $nameFilesBaru .= '.';
    $nameFilesBaru .= $ekstensiGambar;

    move_uploaded_file($tmpFiles, "../../assets/images/" . $nameFilesBaru);

    return $nameFilesBaru;
}

function upload_bukti()
{
    $nameFiles = $_FILES['upload_bukti']['name'];
    $ukuranFiles = $_FILES['upload_bukti']['size'];
    $error = $_FILES['upload_bukti']['error'];
    $tmpFiles = $_FILES['upload_bukti']['tmp_name'];

    if ($error === 4) {
        echo "
            <script>
                alert('Pilih gambar terlebih dahulu');
                window.location.href = '';
            </script>
        ";

        return false;
    }

    $ekstensiGambarValid = ['jpg', 'png', 'jpeg'];
    $ekstensiGambar = explode('.', $nameFiles);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "
            <script>
                alert('Ini bukan gambar!');
                window.location.href = '';
            </script>
        ";

        return false;
    }

    if ($ukuranFiles > 1000000) {
        echo "
            <script>
                alert('Ukuran terlalu besar!');
                window.location.href = '';
            </script>
        ";

        return false;
    }

    $nameFilesBaru = uniqid();
    $nameFilesBaru .= '.';
    $nameFilesBaru .= $ekstensiGambar;

    move_uploaded_file($tmpFiles, "assets/images/" . $nameFilesBaru);

    return $nameFilesBaru;
}
