<?php
require_once '../../model/koneksi.php';
$conn = $koneksi->getConnection();

$id = $_GET['id'];
$data = $conn->query("SELECT * FROM produk WHERE id = $id")->fetch_assoc();
?>

<h2 class="page-title">✏️ Edit Produk</h2>

<div class="form-container">
  <form action="proses-edit.php" method="POST" class="form-card">
    <input type="hidden" name="id" value="<?= $data['id'] ?>">

    <label for="nama">Nama Produk</label>
    <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required>

    <label for="harga">Harga</label>
    <input type="number" id="harga" name="harga" value="<?= htmlspecialchars($data['harga']) ?>" step="0.01" required>

    <label for="gambar">Link Gambar</label>
    <input type="text" id="gambar" name="gambar" value="<?= htmlspecialchars($data['gambar']) ?>" required>

    <button type="submit" class="btn save-btn">💾 Simpan Perubahan</button>
  </form>
</div>

<!-- CSS -->
<style>
  .page-title {
    margin: 30px 0 20px;
    font-size: 24px;
    text-align: center;
    color: #34495e;
  }

  .form-container {
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .form-card {
    background: #f9f9f9;
    border-radius: 12px;
    padding: 30px;
    width: 100%;
    max-width: 400px;
    box-shadow: 0 6px 15px rgba(0,0,0,0.1);
  }

  .form-card label {
    display: block;
    margin-bottom: 6px;
    font-weight: bold;
    color: #2c3e50;
  }

  .form-card input {
    width: 100%;
    padding: 10px;
    margin-bottom: 16px;
    border: 1px solid #ccc;
    border-radius: 8px;
    transition: border-color 0.3s;
  }

  .form-card input:focus {
    outline: none;
    border-color: #3498db;
  }

  .btn {
    padding: 10px 16px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    color: white;
    font-weight: bold;
    width: 100%;
    transition: background 0.3s ease;
  }

  .save-btn {
    background-color: #4CAF50;
  }

  .save-btn:hover {
    background-color: #43a047;
  }
</style>

<!-- JS -->
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const inputs = document.querySelectorAll('input');
    inputs.forEach(input => {
      input.addEventListener('input', () => {
        input.style.backgroundColor = '#ffffff';
      });
    });
  });
</script>
