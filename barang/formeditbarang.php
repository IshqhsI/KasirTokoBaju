<?php
$title = 'Edit Barang';
include "../layouts/header.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $rows = query("SELECT * FROM `tb_barang` WHERE `id_barang` = $id");

    $namaBarang = $rows[0]['nama_barang'];
    $gambar = $rows[0]['gambar'];
    $kodeBarang = $rows[0]['kode_barang'];
    $harga = $rows[0]['harga'];
    $tanggal = $rows[0]['created_at'];

    $arrBarang = explode('-', $namaBarang);
    $ukuran = $arrBarang[3];

    $namaBarang = $arrBarang[0] . '-' . $arrBarang[1] . ' - ' . $arrBarang[2];
}

$allSize = ['S', 'M', 'L', 'XL', 'XXL'];


?>

<!-- Preloader
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="<?= BASEURL ?>/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60"
        width="60">
</div> -->

<?php include "../layouts/navbar.php" ?>
<?php include "../layouts/sidebar.php" ?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary mt-3">
                    <div class="card-header">
                        <h3 class="card-title">Edit Barang</h3>
                    </div>
                    <div class="card-body">
                        <form action="editbarang.php" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="card">
                                        <img class="card-img-top img-edit"
                                            src="<?= BASEURL ?>/../assets/img/<?= $gambar ?>" alt="Card image cap">
                                        <div class="card-body">
                                            <h5 class="card-title"><?= $namaBarang ?></h5>
                                            <p class="card-text"><?= $kodeBarang ?></p>
                                            <a href="#" class="btn btn-primary"><?='Rp. ' . FormatRibuan($harga) ?></a>
                                        </div>
                                    </div>
                                </div>
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
                                    <button type="submit" class="btn btn-success mt-4" name="edit"> Edit
                                        Barang </button>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label for="namaBarang">Nama Barang</label>
                                        <input type="text" id="namaBarang" class="form-control" name="namaBarang"
                                            value="<?= $namaBarang ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="harga">Harga</label>
                                        <input type="number" id="harga" class="form-control" name="harga"
                                            value="<?= $harga ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="ukuran">Ukuran </label>
                                        <select name="ukuran" id="ukuran" class="form-control select2">
                                            <?php foreach ($allSize as $size):
                                                if ($size == $ukuran) {
                                                    $val = ' selected';
                                                } else {
                                                    $val = '';
                                                }
                                            ?>
                                            <option value="<?= $size ?>" <?= $val ?>>
                                                <?= $size ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <input type="hidden" name="id_barang" value="<?= $_GET['id'] ?>">
                                </div>

                            </div>
                        </form>
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
//  Main Footer 
include "../layouts/footer.php";
?>