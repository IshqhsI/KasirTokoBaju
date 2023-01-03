<?php

$title = 'Detail Transaksi';
include "../layouts/header.php";


$allTransaksiDetail = query("SELECT * FROM tb_transaksi_detail GROUP BY no_transaksi HAVING COUNT(*)");

?>

<!-- Preloader -->
<!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="<?= BASEURL ?>/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60"
        width="60">
</div> -->
<?php include "../layouts/navbar.php";
include "../layouts/sidebar.php";
include "../app/alert.php"; ?>

<div class="content-wrapper">
    <!-- header -->
    <section class="content-header pb-0">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h2 class="mx-2">Laporan</h2>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right ">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Laporan</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-12">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Laporan</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No. </th>
                                        <th>No Transaksi</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                        <th>Pembayaran</th>
                                        <th>Kembali</th>
                                        <th>Waktu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($allTransaksiDetail as $oneDetail):
                                        $noTransaksi = $oneDetail['no_transaksi'];

                                        $getTransaksi = query("SELECT *
                                                        FROM `tb_transaksi`
                                                        INNER JOIN tb_transaksi_detail ON `tb_transaksi`.`id_transaksi` = `tb_transaksi_detail`.`id_transaksi`
                                                        INNER JOIN tb_kasir ON `tb_transaksi`.`id_kasir` = `tb_kasir`.`id_kasir`
                                                        INNER JOIN tb_barang ON `tb_barang`.`id_barang` = `tb_transaksi_detail`.`id_barang` WHERE `tb_transaksi_detail`.`no_transaksi` = '$noTransaksi'");
                                        $qty = query("SELECT SUM(qty)
                                                        FROM `tb_transaksi`
                                                        INNER JOIN tb_transaksi_detail ON `tb_transaksi`.`id_transaksi` = `tb_transaksi_detail`.`id_transaksi`
                                                        INNER JOIN tb_kasir ON `tb_transaksi`.`id_kasir` = `tb_kasir`.`id_kasir`
                                                        INNER JOIN tb_barang ON `tb_barang`.`id_barang` = `tb_transaksi_detail`.`id_barang` WHERE `tb_transaksi_detail`.`no_transaksi` = '$noTransaksi'")[0]['SUM(qty)'];

                                    ?>

                                    <tr>
                                        <td><?= $i ?></td>
                                        <td>
                                            <form action="detail.php" method="post">
                                                <input type="hidden" name="no_transaksi" value="<?= $noTransaksi ?>">
                                                <button type="submit" style="border: 0; color: blue; background: none;">
                                                    <span color="blue">
                                                        <?= $noTransaksi ?> </span>
                                                </button>
                                            </form>
                                        </td>
                                        <td><?= $qty ?></td>
                                        <td> <?='Rp. ' . FormatRibuan($getTransaksi[0]['grand_total']) ?> </td>
                                        <td>
                                            <?='Rp. ' . FormatRibuan($getTransaksi[0]['bayar']) ?>
                                        </td>
                                        <td>
                                            <?='Rp. ' . FormatRibuan($getTransaksi[0]['kembali']) ?>
                                        </td>
                                        <td>
                                            <?= $getTransaksi[0]['tanggal'] . ' ' . $getTransaksi[0]['waktu'] ?>
                                        </td>
                                    </tr>
                                    </tr>
                                    <?php $i++ ?>
                                    <?php endforeach; ?>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
        </div>
    </section>

</div>



<!-- Main Footer -->
<?php
include "../layouts/footer.php";
?>