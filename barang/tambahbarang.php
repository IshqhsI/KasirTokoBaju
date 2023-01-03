<?php

$title = 'Tambah Barang';

require "../layouts/header.php";


if (isset($_POST['tambah'])) {

    $kodeBarang = $_POST['kodeBarang'];
    $namaBarang = $_POST['namaBarang'];
    $harga = $_POST['harga'];
    $tanggalInput = $_POST['tanggalInput'];
    $ukuran = ' - ' . $_POST['ukuran'];
    $gambar = upload();

    $namaBarang .= $ukuran;


    $query = "INSERT INTO `tb_barang` VALUES (
        '', '$kodeBarang', '$namaBarang', $harga, '$gambar', '$tanggalInput'
    )";

    mysqli_query($conn, $query);

    if (mysqli_affected_rows($conn) > 0) {
        $_SESSION['tambahBarang'] = true;
        header('Location: ' . BASEURL . '/../barang');
        exit;
    }
} else {
    echo "
    <script> 
        alert('anda belum menginput data');
    </script>
    ";
    Header('Location: ' . BASEURL . '/../barang');

}