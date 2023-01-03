<?php 

require '../app/functions.php';

$kodeBarang = $_POST['kodeBarang'];

$rows = query("SELECT * FROM `tb_barang` WHERE `kode_barang` = '$kodeBarang'")[0];

echo json_encode($rows);








// $title = 'Get Barang';


// require "../layouts/header.php";

// if(isset($_POST['kodeBarang'])){
//     $kodeBarang = $_POST['kodeBarang'];

//     $barang = query("SELECT * FROM `tb_barang` WHERE `kode_barang` = $kodeBarang");

//     echo json_encode($barang);


// }

// ?>