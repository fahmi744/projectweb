<h2 class="page-title">➕ Tambah Produk</h2>

<div class="form-container">
  <form action="../page/proses-tambah.php" method="POST" class="form-card">
    <label for="nama">Nama Produk</label>
    <input type="text" id="nama" name="nama" placeholder="Nama Produk" required>

    <label for="harga">Harga Produk</label>
    <input type="number" id="harga" name="harga" placeholder="Harga Produk" step="0.01" required>

    <label for="gambar">Gambar (contoh: produk1.jpg)</label>
    <input type="text" id="gambar" name="gambar" placeholder="Nama File Gambar" required>

    <button type="submit" class="btn add-btn">📦 Tambah Produk</button>
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

  .add-btn {
    background-color: #4CAF50;
  }

  .add-btn:hover {
    background-color: #43a047;
  }
</style>

<!-- JS -->
<script>
  // Tambahkan efek highlight saat input diisi
  document.addEventListener('DOMContentLoaded', () => {
    const inputs = document.querySelectorAll('input');
    inputs.forEach(input => {
      input.addEventListener('input', () => {
        input.style.backgroundColor = '#ffffff';
      });
    });
  });
</script>
