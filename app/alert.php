<?php
if (isset($_SESSION)) {
    if (isset($_SESSION['tambahBarang']) && $_SESSION['tambahBarang'] == true) {
        echo "
        <script>
            Swal.fire(
            'Tambah Barang Berhasil',
            'Chintya4ever Ni Boss',
            'success'
            )
        </script>
    ";
        unset($_SESSION['tambahBarang']);
    } else if (isset($_SESSION['hapusBarang']) && $_SESSION['hapusBarang'] == true) {
        echo "
        <script>
            Swal.fire(
            'Hapus Barang Berhasil',
            'Chintya4ever Ni Boss',
            'success'
            )
        </script>
    ";
        unset($_SESSION['hapusBarang']);
    } else if (isset($_SESSION['editBarang']) && $_SESSION['editBarang'] == true) {
        echo "
        <script>
            Swal.fire(
            'Edit Barang Berhasil',
            'Chintya4ever Ni Boss',
            'success'
            )
        </script>
    ";
        unset($_SESSION['editBarang']);
    } else if (isset($_SESSION['tambahKasir']) && $_SESSION['tambahKasir'] == true) {
        echo "
        <script>
            Swal.fire(
            'Tambah Kasir Berhasil',
            'Chintya4ever Ni Boss',
            'success'
            )
        </script>
    ";
        unset($_SESSION['tambahKasir']);
    } else if (isset($_SESSION['editKasir']) && $_SESSION['editKasir'] == true) {
        echo "
        <script>
            Swal.fire(
            'Edit Kasir Berhasil',
            'Chintya4ever Ni Boss',
            'success'
            )
        </script>
    ";
        unset($_SESSION['editKasir']);

    } else if (isset($_SESSION['hapusKasir']) && $_SESSION['hapusKasir'] == true) {
        echo "
        <script>
            Swal.fire(
            'Hapus Kasir Berhasil',
            'Chintya4ever Ni Boss',
            'success'
            )
        </script>
    ";
        unset($_SESSION['hapusKasir']);

    } else if (isset($_SESSION['bayar']) && $_SESSION['bayar'] == true) {
        echo "
        <script>
            Swal.fire(
            'Pembayaran Berhasil',
            'Chintya4ever Ni Boss',
            'success'
            )
        </script>
    ";
        unset($_SESSION['bayar']);

    }

}
?>