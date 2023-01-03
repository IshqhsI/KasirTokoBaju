<?php

require 'koneksi.php';

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $row = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    if (!empty($rows)) {
        return $rows;
    } else {
        return [[]];
    }
}

function FormatRibuan($nilai)
{
    return number_format($nilai, 2, ',', '.');
}

function upload()
{

    $namafile = $_FILES["gambar"]["name"];
    $ukuranfile = $_FILES["gambar"]["size"];
    // $error = $_FILES["gambar"]["error"];
    $tmp_Name = $_FILES["gambar"]["tmp_name"];

    // Cek Ekstensi
    $ekstensi = ["jpg", "jpeg", "png", "avif", "webp"];

    $eksfile = explode('.', $namafile);
    $eksfile = strtolower($eksfile[1]);

    if (!in_array($eksfile, $ekstensi)) {
        echo "
                    <script>
                        alert('Tetot, Anda tidak mengupload gambar');
                    </script>
                ";
        return false;
    }

    // Cek Ukuran File
    if ($ukuranfile > 10000000) {
        echo "
                    <script>
                        alert('Tetot, Ukuran File Terlalu Besar');
                    </script>
                ";
        return false;
    }

    // Buat Nama FIle Baru
    $namafilebaru = uniqid();
    $namafilebaru .= '.';
    $namafilebaru .= $eksfile;

    move_uploaded_file($tmp_Name, $_SERVER["DOCUMENT_ROOT"] . '/int2sbd/c4e/assets/img/' . $namafilebaru);
    return $namafilebaru;
}