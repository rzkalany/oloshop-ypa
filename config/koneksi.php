<?php

require_once 'function.php';
$base_url = "http://localhost/app_ecommerce/";

$server = "localhost";
$user = "root";
$password = "";
$nama_database = "db_app";

$koneksi = mysqli_connect($server, $user, $password, $nama_database);

if (!$koneksi) {
    die("Gagal terhubung dengan database: " . mysqli_connect_error());
}

error_reporting(0);
