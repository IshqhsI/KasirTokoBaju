<?php
session_start();

$title = 'Tambah Kasir';

require "../layouts/header.php";


if (isset($_POST['tambah'])) {
    $namakasir = $_POST['namakasir'];
    $alamat = $_POST['alamat'];

    $query = "INSERT INTO `tb_kasir`  VALUES ('', '$namakasir', '$alamat');";

    $tes = mysqli_query($conn, $query);

    if (mysqli_affected_rows($conn) > 0) {
        $_SESSION['tambahKasir'] = true;
        header('Location: ' . BASEURL . '/../kasir');
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