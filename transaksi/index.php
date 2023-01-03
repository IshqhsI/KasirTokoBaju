<?php
$title = 'Transaksi';
include "../layouts/header.php";

// Mengambil Kode Barang
$kodBar = query("SELECT `kode_barang` FROM `tb_barang`");

// Mengambil Data Kasir



// Mengambil Data Tabel Transaksi
$query = "SELECT * FROM `keranjang` ORDER BY `no_transaksi` ASC";
$rows = query($query);

if (!empty($rows[0])) {
    // Get Grand Total
    $grandTotal = $rows[0]['grand_total'];

    // Get Diskon
    $diskon = $rows[0]['diskon'];

    $dataTransaksi = query("SELECT * FROM `keranjang`");

    // Get GrandTotal
    $totalHarga = 0;
    foreach ($dataTransaksi as $data) {
        $subTotal = $data['sub_total'];
        $totalHarga += $subTotal;
    }


} else {
    $rows = [[]];
    $grandTotal = 0;
    $totalHarga = 0;
    $diskon = 0;
}


$tanggal = date("Y-m-d");
$waktu = date("h:i:s");
$tanggalwaktu = date("h:i:s Y-m-d");
@$noTransaksi = $dataTransaksi[0]['no_transaksi'];

?>

<?php include "../layouts/navbar.php";
include "../layouts/sidebar.php";
include "../app/alert.php"; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper bg-light">

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary mt-3">
                        <div class="card-header">
                            <h3 class="card-title">Data Edit Transaksi</h3>
                        </div>
                        <div class="card-body">
                            <form action="tambahtransaksi.php" method="post">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input type="hidden" id="idKasir" class="form-control" name="id_kasir"
                                            value="<?= $kasir['id_kasir'] ?>">
                                        <div class="form-group">
                                            <label>Kode Barang</label>
                                            <select name="kodeBarang" class="form-control select2" style="width: 100%;"
                                                id="kodeBarang">
                                                <option selected="selected">...</option>
                                                <?php if (!empty($kodBar[0])) { ?>

                                                <?php foreach ($kodBar as $kode): ?>
                                                <option>
                                                    <?= $kode['kode_barang'] ?>
                                                </option>
                                                <?php endforeach ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="namaBarang">Nama Barang</label>
                                            <input type="text" name="namaBarang" id="namaBarang" class="form-control"
                                                readonly>
                                        </div>
                                        <input type="hidden" name="harga" id="harga" class="form-control" readonly>

                                        <div class="form-group">
                                            <label for="harga">Harga</label>
                                            <input type="text" name="hargaBarang" id="hargaBarang" class="form-control"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="tglInput">Tanggal</label>
                                            <input type="text" name="tanggalInput" id="tglInput" class="form-control"
                                                value="<?= $tanggal ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="waktuInput">Waktu</label>
                                            <input type="text" name="waktuInput" id="waktuInput" class="form-control"
                                                value="<?= $waktu ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="qty">Qty</label>
                                            <input type="number" id="qty" class="form-control" name="qty">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="simpan"> Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card card-primary mt-3">
                        <div class="card-header">
                            <h3 class="card-title">Data Transaksi</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="d-flex mb-4 ">
                                <h3 class="mr-5">
                                    Kasir : <?= $kasir['nama_kasir'] ?>
                                </h3>
                                <h3>
                                    No Transaksi : <?= $noTransaksi ?>
                                </h3>
                            </div>
                            <div class="table-responsive">
                                <table id="" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Harga</th>
                                            <th>Qty</th>
                                            <th>Subtotal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1 ?>
                                        <?php if (!empty($rows[0])): ?>
                                        <?php foreach ($rows as $transaksi): ?>
                                        <tr>
                                            <td>
                                                <?= $i++ ?>
                                            </td>
                                            <td>
                                                <?= $transaksi['kode_barang'] ?>
                                            </td>
                                            <td>
                                                <?= $transaksi['nama_barang'] ?>
                                            </td>
                                            <td>
                                                <?='Rp. ' . FormatRibuan($transaksi['harga']) ?>
                                            </td>
                                            <td>
                                                <?= $transaksi['qty'] ?>
                                            </td>
                                            <td>
                                                <?='Rp. ' . FormatRibuan($transaksi['sub_total']) ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="hapustransaksi.php?id=<?= $transaksi['id_keranjang'] ?>"
                                                    class="confirm"> <i class="fas fa-trash-alt btn btn-danger"></i></a>

                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php endif; ?>


                                    </tbody>
                                </table>
                            </div>

                            <?php

                            $grandTotalwithFormat = number_format($grandTotal, 2, ',', '.');
                            $totalHargawithFormat = number_format($totalHarga, 2, ',', '.');
                            $diskonwithFormat = number_format($diskon, 2, ',', '.');

                            ?>
                            <div class="row mt-2    ">
                                <div class="col-lg-8">
                                    <p class="font-weight-bold">Keterangan : Diskon 5% Jika Total Harga Lebih dari Rp.
                                        1.000.000</p>
                                </div>
                                <div class=" col-lg-4 justify-content-end">
                                    <table>
                                        <tr>
                                            <td>
                                                <h4 class="mx-3"> Total Harga </h4>
                                            </td>
                                            <td>
                                                <h4>
                                                    <?=': Rp. ' . $totalHargawithFormat ?>
                                                </h4>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h4 class="mx-3"> Diskon </h4>
                                            </td>
                                            <td>
                                                <h4>
                                                    <?=': Rp. ' . $diskonwithFormat ?>
                                                </h4>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h4 class="mx-3 font-weight-bold"> Total Pembayaran </h4>
                                            </td>
                                            <td>
                                                <h4 class="font-weight-bold">
                                                    <?=': Rp. ' . $grandTotalwithFormat ?>
                                                </h4>
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                            </div>
                            <hr>
                            <div class="row">
                                <form action="bayar.php" method="post" class="row">
                                    <input type="hidden" name="grandTotal" value="<?= $grandTotal ?>" id="totalharga">
                                    <input type="hidden" name="totalharga" value="<?= $totalHarga ?>" id="totalharga">
                                    <input type="hidden" id="tanggal" class="form-control" name="tanggal"
                                        value="<?= $tanggal ?>">
                                    <input type="hidden" id="jam" class="form-control" name="jam" value="<?= $waktu ?>">
                                    <div class="col-lg-4">
                                        <div class="form-group px-2">
                                            <label for="pembayaran">Pembayaran :</label>
                                            <input type="text" id="pembayaran" class="form-control form-control-lg"
                                                name="pembayaran" autocomplete="off">
                                        </div>

                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="kembalian">Kembalian :</label>
                                            <input type="hidden" id="kembalian" class="form-control" name="kembalian">
                                            <input type="text" id="kembalian2" class="form-control form-control-lg"
                                                name="kembalian2" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 d-flex justify-content-center align-items-center">
                                        <button class="btn btn-lg btn-primary mx-5" type="submit" name="bayar"><i
                                                class=" fas fa-shopping-cart"></i>
                                            Bayar</button>
                                    </div>
                                </form>



                            </div>



                            <!-- /.card-body -->
                            <!-- <div class="card-body">
                            <form action="bayar.php" method="post">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input type="hidden" id="tanggal" class="form-control" name="tanggal"
                                            value="<?= $tanggal ?>">
                                        <input type="hidden" id="jam" class="form-control" name="jam"
                                            value="<?= $waktu ?>">
                                        <div class="form-group">
                                            <label for="totalharga">Total Harga :</label>
                                            <input type="text" id="totalhargawithformat" class="form-control"
                                                name="totalharga" value="<?='Rp. ' . $totalHargawithFormat ?>"
                                                readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="diskon">Diskon</label>
                                            <input type="hidden" id="diskon" class="form-control" name="diskon"
                                                value="<?= $diskon ?>">
                                            <input type="text" id="diskon" class="form-control" name="diskon"
                                                value="<?='Rp. ' . $diskonwithFormat ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="grandTotal">GrandTotal :</label>
                                            <input type="hidden" id="grandTotal" class="form-control" name="grandTotal"
                                                value="<?= $grandTotal ?>">
                                            <input type="text" id="grandTotal2" class="form-control" name="grandTotal2"
                                                value="<?='Rp. ' . $grandTotalwithFormat ?>" readonly>

                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="totalharga">Total Harga :</label>
                                            <input type="text" id="totalhargawithformat" class="form-control"
                                                name="totalhargadua" value="<?='Rp. ' . $grandTotalwithFormat ?>"
                                                readonly>
                                            <input type="hidden" id="totalharga" class="form-control" name="totalharga"
                                                value="<?= $grandTotal ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="pembayaran">Pembayaran :</label>
                                            <input type="text" id="pembayaran" class="form-control" name="pembayaran">
                                        </div>
                                        <div class="form-group">
                                            <label for="kembalian">Kembalian :</label>
                                            <input type="hidden" id="kembalian" class="form-control" name="kembalian">
                                            <input type="text" id="kembalian2" class="form-control" name="kembalian2"
                                                readonly>

                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-default" data-toggle="modal"
                                    data-target="#modal-default">
                                    Launch Default Modal
                                </button>
                                <button type="submit" class="btn btn-primary" name="bayar">Bayar</button>
                            </form>
                        </div> -->
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<!-- Main Footer -->
<?php
include "../layouts/footer.php";
?>