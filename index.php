<?php
session_start();
require_once 'model/koneksi.php';
$conn = $koneksi->getConnection();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce Layout</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body>

                <div class="header">
            <!-- Menu Icon -->
            <div class="menu-icon-box" style="background-color: #2373e2; color: white; padding: 5px 0; text-align: center; border-radius: 0px; width: 80px; height: 100%; flex-shrink: 0; margin: -10px; ">
                <div class="menu-icon-symbol" style="font-size: 25px;">☰</div>
                <div class="menu-icon-text" style="font-size: 9px; margin-top: 5px;">카테고리</div>
            </div>

            <!-- Brand -->
            <div class="brand-logo" style="font-size: 30px; font-weight: bold; font-family: Arial, sans-serif; display: flex; gap: 0px; flex-shrink: 0; padding-left: 30px;">
                <span class="brand-c" style="color:rgb(0, 0, 0);">c</span>
                <span class="brand-o" style="color:rgb(0, 0, 0);">o</span>
                <span class="brand-u" style="color:rgb(0, 0, 0);">u</span>
                <span class="brand-p" style="color: #ff5400;">p</span>
                <span class="brand-a" style="color:rgb(226, 190, 46);">a</span>
                <span class="brand-n" style="color: #3db39e;">n</span>
                <span class="brand-g" style="color:rgb(64, 128, 224);">g</span>
            </div>
  
            <!-- Search Bar -->
            <div class="search-container" style="
                flex-grow: 1; 
                display: flex; 
                width: 100%; 
                max-width: 700px; 
                justify-content: center; 
                margin: 0 auto; 
                border: 1px solid #1E90FF; 
                border-radius: 5px; 
                overflow: hidden;
            ">
                <input type="text" placeholder="찾고 싶은 상품을 검색해보세요!" style="
                    flex-grow: 1; 
                    border: none; 
                    padding: 10px; 
                    font-size: 16px;
                    outline: none;
                ">
 
            </div>


            <!-- Account & Cart -->
            <div class="account-cart">
                <a href="admin/login.php">👤 Akun</a>
                <a href="#">🛒 Keranjang</a>
            </div>
        </div>


            <div class="kategori-container" style="display: flex; justify-content: center; align-items: center; gap: 10px; flex-wrap: nowrap; overflow-x: auto; padding: 10px;">
            
            <!-- Tombol Kiri -->
            <button class="kategori-nav">
                <i class="fas fa-chevron-left"></i>
            </button>

            <!-- Daftar Kategori -->
            <a href="admin/login.php" class="kategori"><i class="fas fa-utensils"></i> Kebutuhan Dapur</a>
            <a href="admin/login.php" class="kategori"><i class="fas fa-baby"></i> Kebutuhan Ibu & Anak</a>
            <a href="admin/login.php" class="kategori"><i class="fas fa-home"></i> Kebutuhan Rumah</a>
            <a href="admin/login.php" class="kategori"><i class="fas fa-hamburger"></i> Makanan</a>
            <a href="admin/login.php" class="kategori"><i class="fas fa-wine-glass-alt"></i> Minuman</a>
            <a href="admin/login.php" class="kategori"><i class="fas fa-snowflake"></i> Produk Segar & Beku</a>
            <a href="admin/login.php" class="kategori"><i class="fas fa-leaf"></i> Organik</a>
            <a href="admin/login.php" class="kategori"><i class="fas fa-seedling"></i> Sayuran</a>

            <!-- Tombol Kanan -->
            <button class="kategori-nav">
                <i class="fas fa-chevron-right"></i>
            </button>

            </div>


        <div class="banner">
            <img id="banner-img" src="img/iklann.gif" alt="Banner Promo">
        </div>



        <h2 class="section-title">Produk Rekomendasi</h2>

        <!-- Produk dari database -->
        <div class="product-container">
            <?php 
            $result = $conn->query("SELECT * FROM produk");
            while ($row = $result->fetch_assoc()):
                $gambar = 'img/' . htmlspecialchars($row['gambar']);
                $id_produk = $row['id']; // pastikan kolom id ada
            ?>
                <a href="admin/login.php?id=<?= $id_produk ?>" class="product-link">
                    <div class="product">
                        <div class="product-box">
                            <img src="<?= $gambar ?>" alt="<?= htmlspecialchars($row['nama']) ?>" />
                        </div>
                        <p><?= htmlspecialchars($row['nama']) ?></p>
                        <p class="price">Rp <?= number_format($row['harga'], 3, '.', ',') ?></p>
                        <button>Beli</button>
                    </div>
                </a>
            <?php endwhile; ?>
        </div>


        <!-- Footer -->
        <div class="footer"> 
            <div class="footer-content">
                <div class="brand">
                    <p>Selamat datang di WINDATOPUPSTORE! Topup Game murah dan terpercaya</p>
                    <div class="socials">
                    </div>
                </div>

                <div class="links">
                    <h3>Kemitraan</h3>
                    <a href="#">Dashboard</a>
                    <a href="#">Deposit</a>
                    <a href="#">Daftar Harga</a>
                </div>

                <div class="links">
                    <h3>Peta Situs</h3>
                    <a href="#">Beranda</a>
                    <a href="#">Masuk</a>
                    <a href="#">Daftar</a>
                    <a href="#">Cek Transaksi</a>
                    <a href="#">Hubungi Kami</a>
                    <a href="#">Ulasan</a>
                </div>

                <div class="links">
                    <h3>Legalitas</h3>
                    <a href="#">Kebijakan Privasi</a>
                    <a href="#">Syarat & Ketentuan</a>
                </div>
            </div>
            <p class="copyright">© 2025 webcomerss</p>
        </div>

    </div> <!-- end of wrapper -->

</body>
</html>

