<?php

require '../app/koneksi.php';
require '../app/functions.php';


$brg = query("SELECT * FROM tb_barang ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <title>Chintya 4 Ever | Home</title>
</head>

<body>
    <section id="header">
        <h4 class="logo flash">C4E</h4>
        <ul id="navbar">
            <li><a href="#" class="active">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href="../"><i class="fa fa-shopping-bag"></i></a></li>
        </ul>
    </section>

    <!-- <section id="hero">
        <h4 class="bounce-in"><span style="color: #088178;">C</span>hintya<i style="color: #088178;">4E</i>ver</h4>
        <h5 class="bounce-in">LARIS MANIS !!!</h5>
        
    </section> -->

    <section id="banner">
        <h4>Info Terbaru Diskon</h4>
        <h2>Diskon <span>5%</span> Jika pembelian di atas nominal <span> Rp. 1.000.000</span></h2>
        <button class="normal" href="../">Order Now</button>
    </section>

    <section id="product" class="section-p1">
        <h2>PRODUCT</h2>
        <p>LARIS MANIS !!!</p>
        <div class="pro-container">
            <?php foreach ($brg as $baju): ?>
            <div class="pro">
                <img src="../assets/img/<?= $baju['gambar'] ?>" alt="" style="100%">
                <div class="des">
                    <h4 class="mt-2"><?= $baju['nama_barang'] ?></h4>
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h4><?='Rp. ' . number_format($baju['harga'], 2, ',', '.') ?></h4>
                </div>
                <a href="../transaksi/"><i class="fal fa-shopping-cart cart"></i></a>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section id="product" class="section-p1 mt-5">
        <h2 id="about">About</h2>
        <p>Cynthia4ever</p>
        <div class="pro-container">
            <div class="pro">
                <img src="img/one.avif" alt="">
                <div class="des">
                    <h5>Muhammad Ridhwan</h5>
                    <h4>20041030</h4>
                </div>
            </div>
            <div class="pro">
                <img src="img/andi.avif" alt="">
                <div class="des">
                    <h5>Muhammad Andi</h5>
                    <h4>20041035</h4>
                </div>
            </div>
            <div class="pro">
                <img src="img/sugi.avif" alt="">
                <div class="des">
                    <h5>Sugianoor</h5>
                    <h4>20041037</h4>
                </div>
            </div>
            <div class="pro">
                <img src="img/fiz.avif" alt="">
                <div class="des">
                    <h5>Muhammad Hafiz R</h5>
                    <h4>20041003</h4>
                </div>
            </div>
    </section>

    <section id="banner2">
        <h4>Info Terbaru Diskon</h4>
        <h2>Diskon <span>5%</span> Jika pembelian di atas nominal <span> Rp. 1.000.000</span></h2>
        <button class="normal">Order Now</button>
    </section>


    <section id="contact" class="section-p1">
        <h2>Contact</h2>
        <p>Info-Info Loker!!</p>
        <div class="contact-detail">
            <form action="">
                <h1>Hubungi Segera !</h1>
                <div class="form-group">
                    <div id="input-name" class="input-group">
                        <label for="">Nama</label>
                        <input type="text" placeholder="Nama">
                    </div>
                    <div id="input-subject" class="input-group">
                        <label for="">Judul</label>
                        <input type="text" placeholder="Judul">
                    </div>
                    <div id="input-email" class="input-group">
                        <label for="">Email</label>
                        <input type="email" placeholder="Email">
                    </div>
                    <div id="input-phone" class="input-group">
                        <label for="">Nomer HP/WA</label>
                        <input type="tel" placeholder="Nomer HP/WA">
                    </div>
                    <div id="input-message" class="input-group">
                        <label for="">Pesan</label>
                        <input type="text" placeholder="Isi Pesan">
                    </div>
                </div>
                <button class="btn">Submit</button>
            </form>
            <div>
                <h1>Our Location</h1>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3983.1944101945364!2d114.6063638742813!3d-3.30201004115032!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x54444526b832f6d%3A0xc87afe8dc44cafa3!2sSTMIK%20Indonesia%20Banjarmasin!5e0!3m2!1sen!2sid!4v1672198074111!5m2!1sen!2sid"
                    width="500" height="350" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>

    <footer id="footer">
        <div>
            <h5>Copyright © 2022 Chintya4Ever. All rights reserved.</h5>
        </div>
    </footer>

    <script src="script.js"></script>
</body>

</html>