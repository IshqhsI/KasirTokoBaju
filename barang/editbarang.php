<?php

$title = 'Edit Barang';

require "../layouts/header.php";

if (isset($_POST['edit'])) {

    $id = $_POST['id_barang'];
    $namaBarang = $_POST['namaBarang'];
    $harga = $_POST['harga'];

    $ukuran = ' - ' . $_POST['ukuran'];
    $namaBarang .= $ukuran;

    if ($_FILES['gambar']['error'] === 4) {
        $row = mysqli_query($conn, "SELECT `gambar` FROM `tb_barang` WHERE `id_barang` = $id");
        $gambar = mysqli_fetch_assoc($row)["gambar"];
    } else {
        $gambar = upload();
    }



    $query = "UPDATE `tb_barang` SET `nama_barang` = '$namaBarang', `harga` = $harga, `gambar` = '$gambar' WHERE `id_barang` = $id";
    mysqli_query($conn, $query);
    if (mysqli_affected_rows($conn) > 0) {
        $_SESSION['editBarang'] = true;
        Header('Location: ' . BASEURL . '/../barang');
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