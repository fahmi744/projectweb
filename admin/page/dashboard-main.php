<h2 class="page-title"><i class="fas fa-home"></i> Beranda</h2>

<?php 
require_once '../model/koneksi.php';
$conn = $koneksi->getConnection();
$query = "SELECT * FROM produk";
$result = $conn->query($query);
?>

<h2 class="welcome">Selamat Datang, Admin!</h2>

<div class="add-button-container">
  <a href="../admin/page/tambah-produk.php">
    <button class="btn add-btn">➕ Tambah Produk</button>
  </a>
</div>

<div class="shop-container">
  <?php while ($row = $result->fetch_assoc()): ?>
    <div class="shop-product">
      <div class="shop-box">
        <img src="../img/<?= htmlspecialchars($row['gambar']) ?>" alt="<?= htmlspecialchars($row['nama']) ?>">
      </div>
      <p class="product-name"><?= htmlspecialchars($row['nama']) ?></p>
      <p class="shop-price">Rp <?= number_format($row['harga'], 3, '.', ',') ?></p>
      <div class="button-group">
        <a href="page/edit-produk.php?id=<?= $row['id'] ?>">
          <button class="btn edit-btn">✏️ Edit</button>
        </a>
        <a href="page/hapus-produk.php?id=<?= $row['id'] ?>" onclick="return confirm('Hapus produk ini?')">
          <button class="btn delete-btn">🗑️ Hapus</button>
        </a>
      </div>
    </div>
  <?php endwhile; ?>
</div>

<!-- CSS -->
<style>
  .page-title {
    margin-top: 30px;
    font-size: 24px;
    color: #333;
  }

  .welcome {
    text-align: center;
    color: #2c3e50;
    margin-bottom: 20px;
    font-size: 22px;
  }

  .add-button-container {
    text-align: center;
    margin-bottom: 30px;
  }

  .btn {
    padding: 10px 16px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    color: white;
    font-weight: bold;
    transition: background 0.3s ease;
  }

  .add-btn {
    background-color: #4CAF50;
  }

  .add-btn:hover {
    background-color: #43a047;
  }

  .edit-btn {
    background-color: #3498db;
  }

  .edit-btn:hover {
    background-color: #2980b9;
  }

  .delete-btn {
    background-color: #e74c3c;
  }

  .delete-btn:hover {
    background-color: #c0392b;
  }

  .shop-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 20px;
    padding: 0 20px;
  }

  .shop-product {
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 12px;
    padding: 15px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    transition: transform 0.2s;
    text-align: center;
  }

  .shop-product:hover {
    transform: translateY(-5px);
  }

  .shop-box img {
    max-width: 100%;
    height: 150px;
    object-fit: cover;
    border-radius: 8px;
    margin-bottom: 10px;
  }

  .product-name {
    font-size: 18px;
    font-weight: bold;
    color: #333;
  }

  .shop-price {
    color: #2ecc71;
    font-size: 16px;
    margin: 8px 0;
  }

  .button-group {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-top: 10px;
  }
</style>

<!-- JavaScript -->
<script>
  // Optional: toast feedback (fake example)
  const addButton = document.querySelector('.add-btn');
  addButton.addEventListener('click', () => {
    console.log('Redirecting to tambah-produk.php');
  });

  // Fade-in animation
  document.addEventListener('DOMContentLoaded', () => {
    const items = document.querySelectorAll('.shop-product');
    items.forEach((item, index) => {
      setTimeout(() => {
        item.style.opacity = 1;
        item.style.transform = 'translateY(0)';
      }, index * 100);
    });
  });
</script>
