<?php

// Data Pilih Kasir

require '../app/functions.php';

$idKasir = $_POST['idKasir'];

$rows = query("SELECT * FROM `tb_kasir` WHERE `id_kasir` = '$idKasir'")[0];

echo json_encode($rows);