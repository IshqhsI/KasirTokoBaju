<?php
session_start();

$title = 'Edit kasir';

require "../layouts/header.php";

if (isset($_POST['edit'])) {

    $id = $_POST['id_kasir'];
    $namaKasir = $_POST['namakasir'];
    $alamat = $_POST['alamat'];



    $query = "UPDATE `tb_kasir` SET `nama_kasir` = '$namaKasir', `alamat` = '$alamat' WHERE `id_kasir` = $id";
    mysqli_query($conn, $query);
    if (mysqli_affected_rows($conn) > 0) {
        $_SESSION['editKasir'] = true;
        Header('Location: ' . BASEURL . '/../kasir');
        exit;
    }
} else {
    echo "
    <script> 
        alert('anda belum menginput data');
    </script>
    ";
    Header('Location: ' . BASEURL . '/../kasir');

}