<?php
require_once '../../config/koneksi.php';
require_once '../../assets/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();
ob_start();

// Show Data
$query = "SELECT * FROM `tb_cart`, `tb_detail_order`, `tb_produk` WHERE `tb_produk`.`id_product` = `tb_detail_order`.`id_product` AND `tb_cart`.`id_order` = `tb_detail_order`.`id_order` ORDER BY `tb_detail_order`.`id_detail` ASC;";
$result = mysqli_query($koneksi, $query);
$no = 1;

function tgl_indo($tanggal)
{
    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);

    // variabel pecahkan 0 = tanggal
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tahun

    return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}

function hari_ini()
{
    $hari = date("D");

    switch ($hari) {
        case 'Sun':
            $hari_ini = "Minggu";
            break;

        case 'Mon':
            $hari_ini = "Senin";
            break;

        case 'Tue':
            $hari_ini = "Selasa";
            break;

        case 'Wed':
            $hari_ini = "Rabu";
            break;

        case 'Thu':
            $hari_ini = "Kamis";
            break;

        case 'Fri':
            $hari_ini = "Jumat";
            break;

        case 'Sat':
            $hari_ini = "Sabtu";
            break;

        default:
            $hari_ini = "Tidak di ketahui";
            break;
    }

    return $hari_ini;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Report E-Commerce</title>
</head>

<body>
    <h2 align="center">Laporan Data Penjualan</h2>
    <table border="1" style="border-collapse: collapse; width: 100%;" cellspacing="2">
        <thead>
            <tr>
                <th style="font-size: 12px; padding: 10px;">No</th>
                <th style="font-size: 12px; padding: 10px;">No Resi</th>
                <th style="font-size: 12px; padding: 10px;">Nama Produk</th>
                <th style="font-size: 12px; padding: 10px;">Jumlah</th>
                <th style="font-size: 12px; padding: 10px;">Harga Satuan</th>
                <th style="font-size: 12px; padding: 10px;">Tanggal Order</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($result as $data) : ?>
                <tr>
                    <td style="font-size: 12px; padding: 10px;"><?= $no++ ?></td>
                    <td style="font-size: 12px; padding: 10px;"><?= $data['id_order'] ?></td>
                    <td style="font-size: 12px; padding: 10px;"><?= $data['nama_product'] ?></td>
                    <td style="font-size: 12px; padding: 10px;"><?= $data['qty'] ?></td>
                    <td style="font-size: 12px; padding: 10px;"><?= $data['harga'] ?></td>
                    <td style="font-size: 12px; padding: 10px;"><?= $data['tgl_order'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div style="position: absolute; bottom: 100px;width: 100%; margin-right: 100px; text-align: right;">
        Jakarta, <?= hari_ini() . " " .  tgl_indo(date('Y-m-d')) ?>
        <div style="margin-right: 50px;">Mengetahui,</div>
        <div style="margin-top: 100px; margin-right: 50px;">PT TingTong</div>
    </div>
</body>

</html>
<?php
$html = ob_get_contents();
ob_end_clean();
$mpdf->WriteHTML("<img src='kop.png' width='100%'>");
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output('report-penjualan.pdf', 'D');
?>