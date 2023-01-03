<?php

$title = 'Hapus Barang';

require "../layouts/header.php";


if (isset($_GET['id'])) {


    $id = $_GET['id'];

    $query = "DELETE FROM `tb_barang` WHERE `id_barang` = $id";

    mysqli_query($conn, $query);
    if (mysqli_affected_rows($conn) > 0) {
        $_SESSION['hapusBarang'] = true;
        Header('Location: ' . BASEURL . '/../barang');
    }
} else {
    Header('Location: ' . BASEURL . '/../barang');

}