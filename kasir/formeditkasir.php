<?php
$title = 'Edit kasir';
include "../layouts/header.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $rows = query("SELECT * FROM `tb_kasir` WHERE `id_kasir` = $id");

    $namaKasir = $rows[0]['nama_kasir'];
    $Alamat = $rows[0]['alamat'];
}


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
                        <h3 class="card-title">Edit kasir</h3>
                    </div>
                    <div class="card-body">
                        <form action="editkasir.php" method="post">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="namakasir">Nama Kasir</label>
                                        <input type="text" id="namakasir" class="form-control" name="namakasir"
                                            value="<?= $namaKasir ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat">Alamat</b></label>
                                        <input type="text" name="alamat" id="alamat" class="form-control"
                                            value="<?= $Alamat ?>">
                                    </div>
                                    <input type="hidden" name="id_kasir" value="<?= $_GET['id'] ?>">
                                    <button type="submit" class="btn btn-success" name="edit"> Edit
                                        Kasir </button>
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