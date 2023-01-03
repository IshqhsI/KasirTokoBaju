<?php


$title = 'Data Barang';
include "../layouts/header.php";

$query = "SELECT * FROM `tb_barang` ORDER BY `id_barang` ASC";

if (isset($_POST['cari'])) {
    $kataKunci = $_POST['kataKunci'];

    $query = "SELECT * FROM `tb_barang` WHERE 
        `nama_barang` LIKE '%$kataKunci%' OR 
        `kode_barang` LIKE '%$kataKunci%' OR 
        `harga` LIKE '%$kataKunci%' ORDER BY `id_barang` ASC";
}
@$rows = query($query);


@$barang = query("SELECT kode_barang FROM tb_barang ORDER BY id_barang DESC LIMIT 1")[0]['kode_barang'];

if (empty($barang)) {
    $barang = 1;
} else {
    $barang = substr($barang, 3) + 1;
}

@$kodeBarang = 'C4E' . $barang;
$tanggal = date("Y:m:d h:i:s");

?>



<!-- Preloader
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="<?= BASEURL ?>/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60"
        width="60">
</div> -->

<?php include "../layouts/navbar.php";
include "../layouts/sidebar.php";
include "../app/alert.php"; ?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- header -->
    <section class="content-header pb-0">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h2 class="mx-2">Barang</h2>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right ">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Barang</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-lg-12">
                <div class="card card-success mt-3">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Barang</h3>
                    </div>
                    <div class="card-body">
                        <form action="tambahbarang.php" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="kodeBarang">Kode Barang</label>
                                        <input type="text" id="kodeBarang" class="form-control" name="kodeBarang"
                                            value="<?= $kodeBarang ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="tglInput">Tanggal Input</b></label>
                                        <input type="text" name="tanggalInput" id="tglInput" class="form-control"
                                            value="<?= $tanggal ?>" readonly>
                                    </div>
                                    <button type="submit" class="btn btn-success" name="tambah"> Tambah
                                        Barang </button>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="namaBarang">Nama Barang</label>
                                        <input type="text" id="namaBarang" class="form-control" name="namaBarang">
                                    </div>
                                    <div class="form-group">
                                        <label for="harga">Harga</label>
                                        <input type="number" id="harga" class="form-control" name="harga">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="ukuran">Ukuran</label>
                                        <select name="ukuran" id="ukuran" class="form-control select2">
                                            <option value="S">S</option>
                                            <option value="M">M</option>
                                            <option value="L">L</option>
                                            <option value="XL">XL</option>
                                            <option value="XXL">XXL</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="gambar">Gambar</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="gambar" name="gambar">
                                                <label class="custom-file-label" for="gambar">Pilih Gambar</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                        </form>
                    </div>

                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-12">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Data Barang</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <!-- <div class="row">
                            <div class="col-lg-6">
                                <form action="" method="post">
                                    <input type="text" name="kataKunci" class="form-control"
                                        placeholder="Masukkan Kata Kunci">
                                    <button type="submit" class="btn btn-warning mt-2 mb-3" name="cari"> Cari </button>
                                </form>
                            </div>
                        </div> -->
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Harga</th>
                                    <th>Tanggal Diinput</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1 ?>
                                <?php if (!empty($rows[0])) { ?>
                                <?php foreach ($rows as $barang): ?>
                                <tr>
                                    <td>
                                        <?= $i++ ?>
                                    </td>
                                    <td>
                                        <?= $barang['kode_barang'] ?>
                                    </td>
                                    <td>
                                        <?= $barang['nama_barang'] ?>
                                    </td>
                                    <td> Rp. <?= $barang['harga'] ?>
                                    </td>
                                    <td>
                                        <?= $barang['created_at'] ?>
                                    </td>
                                    <td>
                                        <a href="hapusbarang.php?id=<?= $barang['id_barang'] ?>" class="confirm"> <i
                                                class="fas fa-trash-alt btn btn-danger"></i></a> |
                                        <a href="formeditbarang.php?id=<?= $barang['id_barang'] ?>"> <i
                                                class="far fa-edit btn btn-secondary"></i></a>

                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php } ?>
                            </tbody>
                            <!-- <tfoot>
                                    <tr>
                                        <th>Rendering engine</th>
                                        <th>Browser</th>
                                        <th>Platform(s)</th>
                                        <th>Engine version</th>
                                        <th>CSS grade</th>
                                    </tr>
                                </tfoot> -->
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>




<?php

include "../layouts/footer.php";
?>