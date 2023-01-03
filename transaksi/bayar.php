<?php

$title = 'Bayar';

require "../layouts/header.php";


if (isset($_POST['bayar'])) {
    $bayar = $_POST['pembayaran'];
    $bayar = str_replace(',', '', $bayar);
    $kembali = $_POST['kembalian'];
    $tanggal = $_POST['tanggal'];
    $jam = $_POST['jam'];

    $tanggalTrans = str_replace('-', '', $tanggal);


    $query = "UPDATE keranjang SET `bayar` = $bayar, `kembali` = $kembali, `tanggal` = '$tanggal', `waktu` = '$jam'";
    mysqli_query($conn, $query);

    // Insert ke keranjang
    mysqli_query($conn, "INSERT INTO `tb_transaksi` SELECT * FROM keranjang");

    // Insert Ke Transaksi Detail
    $query = "INSERT INTO `tb_transaksi_detail` (id_transaksi, no_transaksi, id_barang, jumlah, total) SELECT * FROM detail";
    mysqli_query($conn, $query);

    $noTransaksi = query("SELECT no_transaksi FROM keranjang")[0]['no_transaksi'];

    mysqli_query($conn, "DELETE FROM `keranjang`");



    if (mysqli_affected_rows($conn) > 0) {
        $_SESSION['bayar'] = true;
        Header("Location: " . BASEURL . "/../detail/detail.php?no_transaksi=$noTransaksi");
    }

}





?>