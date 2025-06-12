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
                <a href="#">🛒 Keranjang</a>
            </div>
        </div>


  

       <!-- isi disini -->
    <div class="body" style="margin: min-height: 800px; display: flex; flex-direction: column;">
    <div style="padding: 30px 20px; margin: 0 30px; margin-bottom: 30px;">
        <div style="
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            padding: 15px 30px;
            font-size: 14px;
            color: #666;
            max-width: 100%;
            width: 100%;
            box-sizing: border-box;
        ">
        <div style="display: flex; align-items: center;">
            <a href="index-user.php" style="text-decoration: none; color: #333;">Home</a>
            <span style="
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background-color: rgba(229, 115, 115, 0.5);
            color:rgb(148, 47, 47);
            margin: 0 10px;
            font-size: 14px;
            font-weight: bold;
            line-height: 1;
            padding-top: 1px; /* ini yang ngangkat dikit si ❯ */
            ">
            &#10095;
            </span>

            <span style="color: #333;">Organik</span>
        </div>
        </div>

        <div style="margin-top: 40px; magin-bottom: 20px; display: flex; align-items: center; gap: 20px;">
            <h2 style="font-weight: bold; color: #333; margin: 10px; magin-bottom: 8px;">Organik</h2>
        </div>


        <!-- Produk Grid -->`
<div style="padding: 0 40px 60px; font-family: sans-serif;">
    <div style="
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 30px;
    ">
        <!-- Dummy Produk -->
        <?php for ($i = 1; $i <= 12; $i++): ?>
        <div style="
            border: 1px solid #ddd;
            border-radius: 12px;
            background: #fff;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            transition: transform 0.2s;
        " onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='none'">
            <div>
                <h4 style="margin: 0 0 10px; font-size: 16px; color: #333;">Produk <?= $i ?></h4>
                <p style="margin: 0 0 15px; color: #e53935; font-weight: bold;">Rp <?= number_format(rand(10000, 100000), 0, ',', '.') ?></p>
            </div>
            <button style="
                padding: 10px;
                background-color: #e53935;
                color: #fff;
                border: none;
                border-radius: 6px;
                cursor: pointer;
                font-size: 14px;
                transition: background-color 0.3s;
            " onmouseover="this.style.backgroundColor='#d32f2f'" onmouseout="this.style.backgroundColor='#e53935'">
                Beli
            </button>
        </div>
        <?php endfor; ?>
    </div>
</div>

    </div>


        <!-- Footer -->
        <div class="footer" style="margin-top: auto; padding: 30px; font-size: 14px;">
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

