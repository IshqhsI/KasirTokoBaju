<?php
$title = 'Kasir';
include "../layouts/header.php";

$query = "SELECT * FROM `tb_kasir` ORDER BY `id_kasir` ASC";

if (isset($_POST['carikasir'])) {

    $kataKunci = $_POST['kataKunci'];

    $query = "SELECT * FROM `tb_kasir` WHERE 
    `nama_kasir` LIKE '%$kataKunci%' OR
    `alamat` LIKE '%$kataKunci%' ORDER BY `id_kasir` ASC";
}

$rows = query($query);
?>

<!-- Preloader -->
<!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="<?= BASEURL ?>/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60"
        width="60">
</div> -->

<?php include "../layouts/navbar.php";
include "../layouts/sidebar.php";
include "../app/alert.php"; ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-1">
                <div class="col-sm-6">
                    <h2 class="mx-2">Kasir</h2>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Kasir</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Form -->
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Tambah Kasir</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="tambahkasir.php" method="post">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="namakasir">Nama Kasir</label>
                                    <input type="text" class="form-control" name="namakasir" id="namakasir"
                                        placeholder="Nama Kasir">
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" class="form-control" name="alamat" id="alamat"
                                        placeholder="alamat">
                                </div>


                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" name="tambah">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- /.card -->
            <!-- Tabel -->
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Data Kasir</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="d-block mb-4">
                                <form action="" method="post" class="d-flex">
                                    <input type="text" name="kataKunci" class="form-control w-50"
                                        placeholder="Masukkan Kata Kunci" autocomplete="off" autofocus>
                                    <button type="submit" class="btn btn-warning ml-2" name="carikasir"> Cari
                                    </button>
                                </form>
                            </div>

                            <table id="" class="table table-bordered table-hover mt-4">
                                <thead>
                                    <tr>
                                        <th>No. </th>
                                        <th>Id Kasir</th>
                                        <th>Nama Kasir</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($rows[0])) { ?>
                                    <?php $i = 1 ?>
                                    <?php foreach ($rows as $kasir): ?>
                                    <tr>
                                        <td>
                                            <?= $i++ ?>
                                        </td>
                                        <td>
                                            <?= $kasir['id_kasir'] ?>
                                        </td>
                                        <td>
                                            <?= $kasir['nama_kasir'] ?>
                                        </td>
                                        <td>
                                            <?= $kasir['alamat'] ?>
                                        </td>
                                        <td>
                                            <a href="hapuskasir.php?id=<?= $kasir['id_kasir'] ?>" class="confirm"> <i
                                                    class="fas fa-trash-alt btn btn-danger"></i></a> |
                                            <a href="formeditkasir.php?id=<?= $kasir['id_kasir'] ?>"> <i
                                                    class="far fa-edit btn btn-secondary"></i></a>

                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php } ?>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
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