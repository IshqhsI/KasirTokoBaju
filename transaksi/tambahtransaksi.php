<?php

define('BASEURL', 'http://' . $_SERVER['SERVER_NAME'] . ':8080/int2sbd/c4e/app_style');


require '../app/functions.php';

if (isset($_POST['simpan'])) {

    // Cek Apakah ada data dengan barang yang sama

    // Get Nilai Id_Kasir
    $idKasir = $_POST['id_kasir'];
    // Get Quantity
    $qty = $_POST['qty'];
    // Get Nama Barang
    $namaBarang = $_POST['namaBarang'];

    // Get Harga Barang
    $hargaBarang = $_POST['harga'];

    // Get Kode Barang
    $kodeBarang = $_POST['kodeBarang'];

    // Get Subtotal
    $subTotal = $qty * $hargaBarang;

    $noTransaksi = query("SELECT no_transaksi FROM keranjang")[0]['no_transaksi'];
    if (empty($noTransaksi)) {
        $kodeTransaksi = date("ymjGi");
        $noTransaksi = 'C4E' . $kodeTransaksi;
    }

    // Cek adakah Barang Yang sama
    $rows = mysqli_query($conn, "SELECT * FROM keranjang WHERE kode_barang='$kodeBarang'");
    $cekkode = mysqli_num_rows($rows);
    if ($cekkode > 0) {

        // Get Data yang sudah ada
        $barang = query("SELECT * FROM keranjang WHERE kode_barang = '$kodeBarang'")[0];
        $qtyold = $barang['qty'];
        $qty = $qty + $qtyold;
        // Get Subtotal
        $subTotal = $qty * $hargaBarang;

        $query = "UPDATE keranjang SET qty = $qty, sub_total = $subTotal WHERE `kode_barang` = '$kodeBarang'";
    } else {
        // Insert 
        $query = "INSERT INTO `keranjang` (`no_transaksi`, `nama_barang`, `harga`, `kode_barang`, `qty`, `sub_total`, `id_kasir`)  VALUES (
       '$noTransaksi', '$namaBarang', $hargaBarang, '$kodeBarang', $qty, $subTotal, $idKasir
    )";
    }

    // Jalankan Query
    mysqli_query($conn, $query);


    // // Insert 
    // $query = "INSERT INTO `tb_transaksi` (`nama_barang`, `harga`, `kode_barang`, `qty`, `sub_total`, `id_kasir`)  VALUES (
    //     '$namaBarang', $hargaBarang, '$kodeBarang', $qty, $subTotal, $idKasir
    // )";

    // // Jalankan Query
    // mysqli_query($conn, $query);


    $dataKeranjang = query("SELECT * FROM `keranjang`");
    // Get GrandTotal
    $grandTotal = 0;
    foreach ($dataKeranjang as $data) {
        $subTotal = $data['sub_total'];
        $grandTotal += $subTotal;
    }

    // Get Diskon
    if ($grandTotal >= 1000000) {
        $diskon = 5 / 100;
        $jumlahDiskon = $grandTotal * $diskon;
        $grandTotal = $grandTotal - $jumlahDiskon;
    } else {
        $jumlahDiskon = 0;
    }

    // Update
    $query = "UPDATE `keranjang` SET `grand_total` = $grandTotal, `diskon` = $jumlahDiskon";

    // Jalankan Query
    mysqli_query($conn, $query);

    if (mysqli_affected_rows($conn) > 0) {
        Header('Location: ' . BASEURL . '/../transaksi');
    }



}

?>