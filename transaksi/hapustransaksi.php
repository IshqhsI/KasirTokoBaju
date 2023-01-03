<?php
$title = 'Transaksi';

require "../layouts/header.php";

if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $query = "DELETE FROM `keranjang` WHERE `id_keranjang` = $id";
    $subTotal = query("SELECT sub_total FROM keranjang WHERE id_keranjang = $id")[0]['sub_total'];
    $grandTotal = query("SELECT grand_total FROM keranjang WHERE id_keranjang = $id")[0]['grand_total'];

    // Jalankan Delete
    mysqli_query($conn, $query);

    $grandTotal = $grandTotal - $subTotal;

    // Get Diskon
    if ($grandTotal >= 1000000) {
        $diskon = 5 / 100;
        $jumlahDiskon = $grandTotal * $diskon;
        $grandTotal = $grandTotal - $jumlahDiskon;
    } else {
        $jumlahDiskon = 0;
        $datakeranjang = query("SELECT * FROM `keranjang`");

        // Get GrandTotal
        $grandTotal = 0;
        foreach ($datakeranjang as $data) {
            $subTotal = $data['sub_total'];
            $grandTotal += $subTotal;
        }
    }

    // Update Grand Total Setelah dihapus
    $query = "UPDATE keranjang SET `grand_total` = $grandTotal, `diskon` = $jumlahDiskon";
    mysqli_query($conn, $query);

    if (empty($grandTotal)) {
        Header('Location:' . BASEURL . '/../transaksi');
    }


    if (mysqli_affected_rows($conn) > 0) {

        $_SESSION['hapusTrans'] = true;
        Header('Location:' . BASEURL . '/../transaksi');
    }


} else {
    Header('Location:' . BASEURL . '/../transaksi');
}