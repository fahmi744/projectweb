<?php
// Panggil file koneksi
include '../model/Koneksi.php';

// Ambil objek koneksi
$conn = $koneksi->getConnection();

// Ambil ID dari URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Query produk berdasarkan ID
$query = $conn->query("SELECT * FROM produk WHERE id = $id");

// Cek apakah produk ditemukan
if ($query->num_rows > 0) {
    $produk = $query->fetch_assoc();
} else {
    echo "Produk tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce Layout</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>

        .container {
            display: flex;
            max-width: 1000px;
            margin: 40px auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            overflow: hidden;
        }
        .product-image {
            flex: 1;
            background-color: #fafafa;
            padding: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .product-image img {
            max-width: 100%;
            border-radius: 10px;
        }
        .product-content {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .product-name {
            font-size: 26px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .product-description {
            margin: 20px 0;
        }
        .product-description ul {
            padding-left: 20px;
            color: #444;
        }
        .right-panel {
            margin-top: 20px;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }
        .product-price {
            color: #d10000;
            font-size: 24px;
            font-weight: bold;
        }
        .quantity-selector {
            display: flex;
            align-items: center;
            margin: 20px 0;
        }
        .quantity-selector button {
            width: 32px;
            height: 32px;
            font-size: 18px;
            background-color: red;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        .quantity-selector input {
            width: 40px;
            text-align: center;
            margin: 0 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .add-to-cart {
            background-color: #d10000;
            color: white;
            padding: 12px 20px;
            border: none;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            border-radius: 5px;
            width: 100%;
        }
        .shipping-info {
            margin-top: 15px;
            font-size: 14px;
            color: #555;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            color: #0077cc;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

                <div class="header" style="
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 0 20px;
                background-color: white;
                font-family: Arial, sans-serif;
                gap: 20px;
                box-shadow: 0 2px 5px rgba(0,0,0,0.1);
                ">
                <!-- Konten di dalam header -->

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
            
            <div class="nav-item" style="position: relative; margin-bottom: 20px;">
            <a id="admin-toggle" style="cursor: pointer; color: #333; text-decoration: none; display: flex; align-items: center;">
                👤 User <i class="fas fa-caret-down" style="margin-left: 5px;"></i>
            </a>
            <div id="admin-dropdown" style="display: none; position: absolute; right: 0; background: white; border: 1px solid #ccc; margin-top: 5px; min-width: 150px; z-index: 10;">
                <a href="#" class="dropdown-link" style="padding: 10px 15px; text-decoration: none; display: block; color: #333;">👤 Profile</a>
                <a href="../admin/logout.php" class="dropdown-link" style="padding: 10px 15px; text-decoration: none; display: block; color: #333;">🚪 Logout</a>
            </div>
            </div>

            <!-- Account & Cart -->
            <div class="account-cart" style="margin-bottom:20x>
                <a href="add-kart.php">🛒 Keranjang</a>
            </div>
        </div>




<div style="padding: 30px 20px; margin: 0 30px 30px;">
  <div style="
      background-color: #fff;
      border-radius: 20px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
      padding: 5px 30px;
      font-size: 14px;
      color: #666;
      max-width: 100%;
      width: 100%;
      box-sizing: border-box;
    ">
    <div style="display: flex; align-items: center;">
      <a href="../user/index-user.php" style="
        text-decoration: none;
        color: #333;
        font-family: inherit;
        padding-bottom: 18px;
      ">Home</a>
      <span style="
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 18px;
        height: 18px;
        border-radius: 50%;
        background-color: rgba(229, 115, 115, 0.5);
        color: rgb(148, 47, 47);
        margin: 0 10px;
        font-size: 14px;
        font-weight: bold;
        line-height: 1;
        padding-top: 1px;
      ">&#10095;</span>
      <span style="color: #333; font-family: inherit;">Produk Rekomendasi</span>
    </div>
  </div>
</div>




<div class="container">
    <div class="product-image">
        <img src="../img/<?= htmlspecialchars($produk['gambar']) ?>" alt="<?= htmlspecialchars($produk['nama']) ?>">
    </div>
    <div class="product-content">
        <div>
            <div class="product-name"><?= htmlspecialchars($produk['nama']) ?></div>
            <div class="product-description">
                <strong>Deskripsi:</strong>
                <ul>
                    <li>Terbuat dari biji jagung pilihan</li>
                    <li>Digoreng dengan minyak kelapa sawit bermutu</li>
                    <li>Dapat dikonsumsi kapan dan di mana saja</li>
                </ul>
            </div>
        </div>

        <div class="right-panel">
            <div class="product-price">Rp <?= number_format($produk['harga'], 0, ',', '.') ?>.000</div>
            <div class="quantity-selector">
                <button onclick="kurangi()">-</button>
                <input type="text" id="jumlah" value="1" readonly>
                <button onclick="tambah()">+</button>
            </div>
            <button class="add-to-cart">+ Keranjang</button>
            <div class="shipping-info">
                🚚 Dikirim oleh <strong>SAPA Instant Delivery</strong><br>
                📦 Biaya Pengiriman <strong>Gratis</strong>
            </div>
            <a href="index.php">← Kembali ke daftar produk</a>
        </div>
    </div>
</div>



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

<script>
    function tambah() {
        let input = document.getElementById('jumlah');
        let val = parseInt(input.value);
        input.value = val + 1;
    }

    function kurangi() {
        let input = document.getElementById('jumlah');
        let val = parseInt(input.value);
        if (val > 1) input.value = val - 1;
    }


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
