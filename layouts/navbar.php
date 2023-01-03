<?php
if (!isset($_SESSION['id_kasir'])) {
    $_SESSION['id_kasir'] = 1;
}

@$idkasir = $_SESSION['id_kasir'];

@$kasir = query("SELECT * FROM tb_kasir WHERE id_kasir = $idkasir")[0];


?>

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= BASEURL ?>/../home" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= BASEURL ?>/../home#about" class="nav-link">About Us</a>
        </li>

    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle second-text" href="#" id="dropdownMenu2" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user mr-2"></i>
                <?=@$kasir['nama_kasir'] ?>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item kasir" href="<?= BASEURL . '/../kasir' ?>">Data Kasir</a></li>
                <li><a class="dropdown-item kasir gantikasir" data-id="<?=@$kasir['id_kasir'] ?>" data-toggle="modal"
                        data-target="#modal-default">
                        Ganti Kasir
                    </a></li>
            </ul>
        </li>
    </ul>
</nav>

<!-- Modal Ganti Kasir -->
<div class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pilih Kasir</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                @$daftarKasir = query("SELECT id_kasir FROM tb_kasir");
                ?>
                <form action="<?= BASEURL ?> /../kasir/pilihkasir.php" method="post">
                    <div class="form-group">
                        <label>Id Kasir</label>
                        <select name="idKasir" class="form-control select2" style="width: 100%;" id="idKasir">
                            <?php if (!empty($daftarKasir[0])) { ?>

                            <?php foreach ($daftarKasir as $kasir): ?>
                            <option>
                                <?= $kasir['id_kasir'] ?>
                            </option>
                            <?php endforeach ?>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="namaKasir">Nama Kasir</label>
                        <input type="text" name="namaKasir" id="namaKasir" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" name="alamat" id="alamat" class="form-control" readonly>
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" name="pilih" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>

    </div>

</div>
<!-- /.navbar -->