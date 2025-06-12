<?php
session_start();
require_once '../model/koneksi.php';
$conn = $koneksi->getConnection();

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce Layout</title>
    <link rel="stylesheet" href="../style.css">
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
            <div class="nav-item" style="position: relative;">
            <a id="admin-toggle" style="cursor: pointer; color: #333; text-decoration: none; display: flex; align-items: center;">
                👤 User <i class="fas fa-caret-down" style="margin-left: 5px;"></i>
            </a>
            <div id="admin-dropdown" style="display: none; position: absolute; right: 0; background: white; border: 1px solid #ccc; margin-top: 5px; min-width: 150px; z-index: 10;">
                <a href="#" class="dropdown-link" style="padding: 10px 15px; text-decoration: none; display: block; color: #333;">👤 Profile</a>
                <a href="../admin/logout.php" class="dropdown-link" style="padding: 10px 15px; text-decoration: none; display: block; color: #333;">🚪 Logout</a>
            </div>
            </div>

        <div class="account-cart">
            <a href="../cart/keranjang.php">🛒 Keranjang</a>
        </div>
    </div>

    <div class="kategori-container" style="display: flex; justify-content: center; align-items: center; gap: 10px; flex-wrap: nowrap; overflow-x: auto; padding: 10px;">
        
        <!-- Tombol Kiri -->
        <button class="kategori-nav">
            <i class="fas fa-chevron-left"></i>
        </button>

        <!-- Daftar Kategori -->
        <a href="k-dapur.php" class="kategori"><i class="fas fa-utensils"></i> Kebutuhan Dapur</a>
        <a href="k-ibuanak.php" class="kategori"><i class="fas fa-baby"></i> Kebutuhan Ibu & Anak</a>
        <a href="k-rumah.php" class="kategori"><i class="fas fa-home"></i> Kebutuhan Rumah</a>
        <a href="makanan.php" class="kategori"><i class="fas fa-hamburger"></i> Makanan</a>
        <a href="minuman.php" class="kategori"><i class="fas fa-wine-glass-alt"></i> Minuman</a>
        <a href="produksegar.php" class="kategori"><i class="fas fa-snowflake"></i> Produk Segar & Beku</a>
        <a href="organik.php" class="kategori"><i class="fas fa-leaf"></i> Organik</a>
        <a href="sayuran.php" class="kategori"><i class="fas fa-seedling"></i> Sayuran</a>

        <!-- Tombol Kanan -->
        <button class="kategori-nav">
            <i class="fas fa-chevron-right"></i>
        </button>
    </div>

    <div class="banner">
        <img id="banner-img" src="../img/iklann.gif" alt="Banner Promo">
    </div>

    <h2 class="section-title">Produk Rekomendasi</h2>

    <!-- Produk dari database -->
    <div class="product-container">
    <?php 
    $result = $conn->query("SELECT * FROM produk");
    while ($row = $result->fetch_assoc()):
        $gambar = '../img/' . htmlspecialchars($row['gambar']);
        $id_produk = $row['id'];
    ?>
        <div class="product">
            <div class="product-box">
                <a href="../produk/produk-detail.php?id=<?= $id_produk ?>" class="product-link">
                    <img src="<?= $gambar ?>" alt="<?= htmlspecialchars($row['nama']) ?>" />
                </a>
            </div>
            <p><?= htmlspecialchars($row['nama']) ?></p>
            <p class="price">Rp <?= number_format($row['harga'], 3, '.', ',') ?></p>
            
            <!-- Form Tambah ke Keranjang dengan User ID -->
            <form method="POST" action="../produk/add-kart.php">
                <input type="hidden" name="user_id" value="<?= $user_id ?>">
                <input type="hidden" name="produk_id" value="<?= $id_produk ?>">
                <input type="hidden" name="quantity" value="1">
                <button type="submit">Beli</button>
            </form>
        </div>
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

<script>
document.addEventListener("DOMContentLoaded", function () {
    const toggle = document.getElementById("admin-toggle");
    const dropdown = document.getElementById("admin-dropdown");

    toggle.addEventListener("click", function (e) {
        e.preventDefault();
        dropdown.style.display = (dropdown.style.display === "block") ? "none" : "block";
    });

    document.addEventListener("click", function (e) {
        if (!dropdown.contains(e.target) && !toggle.contains(e.target)) {
            dropdown.style.display = "none";
        }
    });

    // Efek hover manual
    const links = document.querySelectorAll(".dropdown-link");
    links.forEach(function (link) {
        link.addEventListener("mouseover", function () {
            link.style.backgroundColor = "#f1f1f1";
            link.style.color = "#000";
        });
        link.addEventListener("mouseout", function () {
            link.style.backgroundColor = "transparent";
            link.style.color = "#333";
        });
    });
});
</script>

</body>
</html>