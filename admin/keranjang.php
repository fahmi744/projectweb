
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Keranjang</title>
  <style>


    html, body {
      margin: 0;
      padding: 0;
      height: 100dvh; /* atau 100vh jika 100dvh belum didukung */
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f8f9fa;
      display: flex;
      justify-content: center;
      align-items: center;
    }


    .cart-container {
      background-color: white;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      padding: 40px;
      max-width: 400px;
      width: 100%;
      text-align: center;
    }

    .cart-container h2 {
      color: #333;
      margin-bottom: 10px;
    }

    .cart-container p {
      color: #777;
      font-size: 16px;
      margin-bottom: 30px;
    }

    .cart-icon {
      font-size: 64px;
      color: #adb5bd;
      margin-bottom: 20px;
    }

    .btn-katalog {
      display: inline-block;
      padding: 12px 24px;
      background-color: #007BFF;
      color: white;
      border: none;
      border-radius: 6px;
      text-decoration: none;
      font-weight: 600;
      transition: background-color 0.3s ease;
    }

    .btn-katalog:hover {
      background-color: #0056b3;
    }

.back-button {
  position: fixed;
  top: 20px;
  left: 20px;
  background-color:rgb(237, 34, 34);
  color: white;
  padding: 10px 18px;
  border-radius: 8px;
  width: fit-content;
  cursor: pointer;
  font-weight: bold;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
  transition: background-color 0.3s;
  user-select: none;
  z-index: 999; /* supaya selalu di atas */
}

.back-button:hover {
  background-color:rgb(163, 30, 30);
}

  </style>
</head>
<body>

<div class="back-button" onclick="window.history.back()">← Kembali</div>

  <div class="cart-container">
    <div class="cart-icon">🛒</div>
    <h2>Keranjang Kamu Kosong</h2>
    <p>Ayo lihat katalog dan temukan produk yang kamu suka.</p>
  </div>


</body>
</html>
