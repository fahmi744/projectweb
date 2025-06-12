<?php
// Membaca data produk dari file JSON
// Path disesuaikan untuk user/k-dapur.php mengakses data dari admin
$dataFile = 'produk_kdapur.json';

// Fungsi untuk membaca data produk
function readProduk() {
    global $dataFile;
    if (!file_exists($dataFile)) {
        return [];
    }
    $data = file_get_contents($dataFile);
    return json_decode($data, true) ?: [];
}

$produkList = readProduk();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kebutuhan Dapur - E-Commerce</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
.kdapur-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 30px;
}

.kdapur-card {
    border: 1px solid #e9ecef;
    border-radius: 16px;
    background: #fff;
    padding: 25px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.kdapur-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #e53935, #ff5722);
    transform: scaleX(0);
    transition: transform 0.3s ease;
}

.kdapur-card:hover::before {
    transform: scaleX(1);
}

.kdapur-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 40px rgba(229, 57, 53, 0.15);
    border-color: #e53935;
}

.kdapur-info {
    flex-grow: 1;
}

.kdapur-nama {
    margin: 0 0 12px;
    font-size: 20px;
    font-weight: 600;
    color: #2c3e50;
    line-height: 1.3;
}

.kdapur-harga {
    margin: 0 0 15px;
    color: #e53935;
    font-weight: 700;
    font-size: 24px;
}

.kdapur-deskripsi {
    color: #6c757d;
    font-size: 14px;
    line-height: 1.5;
    margin-bottom: 20px;
}

.kdapur-btn-beli {
    padding: 14px 20px;
    background: linear-gradient(135deg, #e53935, #d32f2f);
    color: #fff;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    font-size: 16px;
    font-weight: 600;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    position: relative;
    overflow: hidden;
}

.kdapur-btn-beli::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.kdapur-btn-beli:hover::before {
    left: 100%;
}

.kdapur-btn-beli:hover {
    background: linear-gradient(135deg, #d32f2f, #c62828);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(229, 57, 53, 0.3);
}

.kdapur-btn-beli:active {
    transform: translateY(0);
}

.no-products {
    grid-column: 1 / -1;
    text-align: center;
    padding: 60px 20px;
    background: #f8f9fa;
    border-radius: 16px;
    color: #666;
}

.no-products h3 {
    font-size: 24px;
    margin-bottom: 15px;
    color: #333;
}

.no-products p {
    font-size: 16px;
    margin-bottom: 20px;
}

.admin-link {
    display: inline-block;
    padding: 12px 24px;
    background: #e53935;
    color: white;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.admin-link:hover {
    background: #d32f2f;
    transform: translateY(-2px);
}
    </style>
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

    <!-- Main Content -->
    <div class="body" style="min-height: 800px; display: flex; flex-direction: column;">
        <div style="padding: 30px 20px; margin: 0 30px; margin-bottom: 30px;">
            <!-- Breadcrumb -->
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
                        padding-top: 1px;
                    ">
                        &#10095;
                    </span>
                    <span style="color: #333;">Kebutuhan Dapur</span>
                </div>
            </div>

            <!-- Page Title -->
            <div style="margin-top: 40px; margin-bottom: 20px; display: flex; align-items: center; gap: 20px;">
                <h2 style="font-weight: bold; color: #333; margin: 10px; margin-bottom: 8px;">🍳 Kebutuhan Dapur</h2>
            </div>

            <!-- Products Grid -->
            <div class="kdapur-grid">
                <?php if (empty($produkList)): ?>
                    <div class="no-products">
                        <h3>🏪 Toko Sedang Persiapan</h3>
                        <p>Produk sedang dalam tahap persiapan. Silakan kembali lagi nanti!</p>
                        <a href="../admin/page/k-dapur/daftar-kdapur.php" class="admin-link">🔧 Kelola Produk (Admin)</a>
                    </div>
                <?php else: ?>
                    <?php foreach ($produkList as $produk): ?>
                    <div class="kdapur-card">
                        <div class="kdapur-info">
                            <h4 class="kdapur-nama"><?= htmlspecialchars($produk['nama']) ?></h4>
                            <p class="kdapur-harga">Rp <?= number_format($produk['harga'], 0, ',', '.') ?></p>
                            <p class="kdapur-deskripsi"><?= htmlspecialchars($produk['deskripsi']) ?></p>
                        </div>
                        <button class="kdapur-btn-beli" onclick="beliProduk('<?= htmlspecialchars($produk['nama']) ?>', <?= $produk['harga'] ?>)">
                            🛒 Beli Sekarang
                        </button>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
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
// Fungsi untuk handle pembelian produk
function beliProduk(namaProduk, harga) {
    // Tampilkan konfirmasi pembelian
    const konfirmasi = confirm(`Apakah Anda yakin ingin membeli ${namaProduk} seharga Rp ${harga.toLocaleString('id-ID')}?`);
    
    if (konfirmasi) {
        // Simulasi proses pembelian
        alert(`Terima kasih! Anda berhasil membeli ${namaProduk}. Silakan lanjutkan ke pembayaran.`);
        
        // Di sini bisa ditambahkan logika untuk:
        // - Menambah ke keranjang
        // - Redirect ke halaman checkout
        // - Mengirim data ke server
        console.log('Produk dibeli:', namaProduk, 'Harga:', harga);
    }
}

// Efek animasi untuk tombol beli
document.querySelectorAll('.kdapur-btn-beli').forEach(button => {
    button.addEventListener('click', function() {
        const original = this.innerHTML;
        this.innerHTML = '⏳ Memproses...';
        this.disabled = true;

        setTimeout(() => {
            this.innerHTML = original;
            this.disabled = false;
        }, 1500);
    });
});

// Dropdown toggle untuk user menu
document.addEventListener("DOMContentLoaded", function () {
    const toggle = document.getElementById("admin-toggle");
    const dropdown = document.getElementById("admin-dropdown");

    if (toggle && dropdown) {
        toggle.addEventListener("click", function (e) {
            e.preventDefault();
            dropdown.style.display = (dropdown.style.display === "block") ? "none" : "block";
        });

        document.addEventListener("click", function (e) {
            if (!dropdown.contains(e.target) && !toggle.contains(e.target)) {
                dropdown.style.display = "none";
            }
        });

        // Efek hover manual untuk dropdown links
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
    }
});

// Auto refresh halaman setiap 30 detik untuk update produk terbaru
// setInterval(function() {
//     location.reload();
// }, 30000);
</script>

</body>
</html>