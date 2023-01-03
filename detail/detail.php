<?php

$title = 'Detail Transaksi';
include "../layouts/header.php";

if (isset($_GET['no_transaksi'])) {
    $noTransaksi = $_GET['no_transaksi'];
} else {
    $noTransaksi = $_POST['no_transaksi'];
}

if (!isset($noTransaksi)) {
    Header("Location: " . BASEURL . "/../detail/");

}



$detail = query("SELECT `tb_kasir`.`nama_kasir`, `tb_barang`.`nama_barang`, `tb_barang`.`harga`, `tb_transaksi_detail`.`jumlah`,`tb_transaksi_detail`.`total`, SUM(sub_total), tb_transaksi.diskon , `tb_transaksi`.`grand_total`, `tb_transaksi`.`bayar`, `tb_transaksi`.`kembali`, `tb_transaksi`.`tanggal`, `tb_transaksi`.`waktu` FROM `tb_transaksi` INNER JOIN tb_transaksi_detail ON `tb_transaksi`.`id_transaksi` = `tb_transaksi_detail`.`id_transaksi` INNER JOIN tb_kasir ON `tb_transaksi`.`id_kasir` = `tb_kasir`.`id_kasir` INNER JOIN tb_barang ON `tb_barang`.`id_barang` = `tb_transaksi_detail`.`id_barang` WHERE `tb_transaksi_detail`.`no_transaksi` = '$noTransaksi'");

$kasirDetail = $detail[0]['nama_kasir'];
$subTotal = $detail[0]['SUM(sub_total)'];
$diskon = $detail[0]['diskon'];
$grandTotal = $detail[0]['grand_total'];
$bayar = $detail[0]['bayar'];
$kembali = $detail[0]['kembali'];
$tanggal = $detail[0]['tanggal'];
$waktu = $detail[0]['waktu'];

// Get Semua Data dari Transaki Where No Transaksi = ..
$rows = query("SELECT * FROM `tb_transaksi` INNER JOIN tb_transaksi_detail ON `tb_transaksi`.`id_transaksi` = `tb_transaksi_detail`.`id_transaksi` INNER JOIN tb_kasir ON `tb_transaksi`.`id_kasir` = `tb_kasir`.`id_kasir` INNER JOIN tb_barang ON `tb_barang`.`id_barang` = `tb_transaksi_detail`.`id_barang` WHERE `tb_transaksi_detail`.`no_transaksi` = '$noTransaksi'")

    ?>

<!-- Preloader -->
<!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="<?= BASEURL ?>/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60"
        width="60">
</div> -->

<?php include "../layouts/navbar.php" ?>
<?php include "../layouts/sidebar.php" ?>

<div class="content-wrapper">

    <section class="content">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-lg-6 px-4 nota mt-5">
                    <div class="row" style="border: 1px solid #cecece; padding:8px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.6);
    z-index: 99; border-radius: 20px;">
                        <div class="col-lg-12 mt-3 text-center">
                            <h3 class="font-weight-bold"><span style="color: #088178;">C</span>hintya<i
                                    style="color: #088178;">4E</i>ver</h3>
                        </div>


                        <!-- No Invoice -->
                        <div class="col-lg-12 text-center my-3">
                            <h4>No Transaksi : <span class="font-weight-bold"><?= $noTransaksi ?></span></h4>
                        </div>

                        <!-- About Toko -->
                        <div class="col-lg-6 ">
                            <h5 class="">
                                KASIR : <?= $kasirDetail ?>
                            </h5>
                        </div>
                        <div class="col-lg-6 ">
                            <h5 class="justify-content-end d-flex">
                                TANGGAL : <?= $tanggal ?>
                            </h5>
                        </div>
                        <div class="col-lg-12 ">
                            <h5 class="justify-content-end d-flex">
                                JAM : <?= $waktu ?>
                            </h5>
                        </div>
                        <div class="table-responsive mt-3">
                            <table class="table table-bordered">
                                <tr>
                                    <th>No. </th>
                                    <th>Nama Barang</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                </tr>
                                <?php $i = 1 ?>
                                <?php foreach ($rows as $row): ?>
                                <tr>
                                    <td> <?= $i ?> </td>
                                    <td> <?= $row['nama_barang'] ?> </td>
                                    <td> <?='Rp. ' . number_format($row['harga'], 2, ',', '.') ?> </td>
                                    <td><?= $row['jumlah'] ?></td>
                                    <td><?='Rp. ' . number_format($row['total'], 2, ',', '.') ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                        <div class="col-lg-12 px-0 mx-0">
                            <div class="row">
                                <div class="col-lg-9">
                                    <h6 class="d-flex-start justify-content-end font-weight-bold">
                                        Sub Total
                                    </h6>
                                    <h6 class="d-flex-start justify-content-end font-weight-bold">
                                        Diskon
                                    </h6>
                                    <h6 class="d-flex-start justify-content-end font-weight-bold ">
                                        Grand Total
                                    </h6>
                                    <h6 class="d-flex-start justify-content-end font-weight-bold">
                                        Tunai
                                    </h6>
                                    <h6 class="d-flex-start justify-content-end font-weight-bold">
                                        Kembali
                                    </h6>
                                </div>
                                <div class="col-lg-3">
                                    <h6 class="d-flex-end justify-content-start font-weight-bold ml-3">
                                        <?=' Rp. ' . FormatRibuan($subTotal) ?>
                                    </h6>
                                    <h6 class="d-flex-end justify-content-start font-weight-bold ml-3">
                                        <?=' Rp. ' . FormatRibuan($diskon) ?>
                                    </h6>
                                    <h6 class="d-flex-end justify-content-start font-weight-bold ml-3">
                                        <?=' Rp. ' . FormatRibuan($grandTotal) ?>
                                    </h6>
                                    <h6 class="d-flex-end justify-content-start font-weight-bold ml-3">
                                        <?=' Rp. ' . FormatRibuan($bayar) ?>
                                    </h6>
                                    <h6 class="d-flex-end justify-content-start font-weight-bold ml-3">
                                        <?=' Rp. ' . FormatRibuan($kembali) ?>
                                    </h6>
                                </div>
                            </div>
                            <div>
                                <h5 class="ml-10"
                                    style="padding-left: 20%; margin: 10px; font-size: 20px; font-weight: bold;">
                                    *TERIMA
                                    KASIH TELAH BERBELANJA*</h5>
                                <div style="padding-left: 45%;">
                                    <button class="print"
                                        style="background: #088178; border: none; border-radius: 5px; padding: 6px;"><i
                                            class="fa fa-print"> </i><a href="#" target="_BLANK"
                                            onclick="window.print()" style="color: white;">
                                            Print
                                        </a></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>



<!-- Main Footer -->
<?php
//  Main Footer 
include "../app/alert.php";
include "../layouts/footer.php";
?>