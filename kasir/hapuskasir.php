<?php
$title = 'Tambah kasir';

require "../layouts/header.php";


if (isset($_GET['id'])) {


    $id = $_GET['id'];

    $query = "DELETE FROM `tb_kasir` WHERE `id_kasir` = $id";

    mysqli_query($conn, $query);
    if (mysqli_affected_rows($conn) > 0) {
        $_SESSION['hapusKasir'] = true;

        Header('Location: ' . BASEURL . '/../kasir');
    }
} else {
    Header('Location: ' . BASEURL . '/../kasir');

}