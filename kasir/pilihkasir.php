<?php


session_start();

$title = '';

require "../layouts/header.php";

if (isset($_POST['pilih'])) {
    $_SESSION['id_kasir'] = $_POST['idKasir'];
    Header('Location: ' . BASEURL . '/../kasir');
    exit;
}

?>