<?php
$title = 'Dashboard';
include "layouts/header.php";

// Get Data Barang
$barang = query("SELECT * FROM tb_barang ORDER BY created_at DESC");

// Get Jumlah Barang
$jumlahBarang = Count($barang);


// Get Data Transaksi
$transaksi = query("SELECT * FROM tb_transaksi_detail GROUP BY no_transaksi HAVING COUNT(*)");


// Get Jumlah Transaksi
$jumlahTransaksi = Count($transaksi);

// Get Data Kasir
$allKasir = query("SELECT * FROM tb_kasir ORDER BY id_kasir");
$jumlahkasir = count($allKasir);


// var_dump($kasir);
// echo "<br>";
// var_dump($transaksi);
// die;

?>



<?php include "layouts/navbar.php" ?>
<?php include "layouts/sidebar.php" ?>

<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <section class="content">
        <div class="container-fluid">

            <div class="row">

                <div class="col-12 col-sm-6 col-md-5">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Barang</span>
                            <span class="info-box-number"><?= $jumlahBarang ?></span>
                        </div>
                    </div>
                    <div class="card card-danger">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Data Barang</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0">
                                    <thead>
                                        <tr>
                                            <th>No. </th>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($barang as $brg): ?>
                                        <tr>
                                            <td><?= $i ?></td>
                                            <td><?= $brg['kode_barang'] ?></td>
                                            <td><?= $brg['nama_barang'] ?></td>
                                            <td><?='Rp. ' . FormatRibuan($brg['harga']) ?></td>
                                        </tr>
                                        <?php $i++;
                                        endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>

                        <div class="card-footer clearfix">

                        </div>

                    </div>


                </div>


                <div class="clearfix hidden-md-up"></div>
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Transaksi</span>
                            <span class="info-box-number"><?= $jumlahTransaksi ?></span>
                        </div>

                    </div>
                    <div class="card card-success">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Data Transaksi</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0">
                                    <thead>
                                        <tr>
                                            <th>No. </th>
                                            <th>No Transaksi</th>
                                            <th>Qty</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($transaksi[0])):
                                            $i = 1; foreach ($transaksi as $trs):
                                                @$noTransaksi = $trs['no_transaksi'];

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
                                            <td><?= $trs['no_transaksi'] ?></td>
                                            <td>
                                                <?= $qty ?>
                                            </td>
                                            <td> <?='Rp. ' . FormatRibuan($getTransaksi[0]['grand_total']) ?> </td>
                                        </tr>
                                        <?php
                                                $i++;
                                            endforeach;
                                        endif; ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>

                        <div class="card-footer clearfix">
                        </div>

                    </div>

                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Kasir</span>
                            <span class="info-box-number"><?= $jumlahkasir ?></span>
                        </div>

                    </div>
                    <div class="card card-warning">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Data Kasir</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0">
                                    <thead>
                                        <tr>
                                            <th>No. </th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1 ?>
                                        <?php foreach ($allKasir as $kasir): ?>
                                        <tr>
                                            <td>
                                                <?= $i++ ?>
                                            </td>
                                            <td>
                                                <?= $kasir['nama_kasir'] ?>
                                            </td>
                                            <td>
                                                <?= $kasir['alamat'] ?>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

            </div>


            <div class="row">


            </div>
        </div>

</div>
</section>

</div>


<!-- Main Footer -->
<?php
include "layouts/footer.php";
?>