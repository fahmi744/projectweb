<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Daftar Akun</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
<style>
  * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
  }

  html, body {
    height: 100%;
    font-family: 'Poppins', sans-serif;
    background:rgb(186, 194, 206);
  }

  .form-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    padding: 1rem;
  }

  .form-container {
    background: white;
    width: 100%;
    max-width: 400px;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 12px 28px rgba(0,0,0,0.1);
    animation: fadeIn 0.5s ease;
  }

  @keyframes fadeIn {
    from { opacity: 0; transform: scale(0.95); }
    to { opacity: 1; transform: scale(1); }
  }

  h2 {
    text-align: center;
    margin-bottom: 1.5rem;
    font-weight: 600;
    color: #333;
  }

  input {
    width: 100%;
    padding: 0.85rem 1rem;
    margin-bottom: 1.25rem;
    border-radius: 8px;
    border: 1.5px solid #ccc;
    font-size: 1rem;
    transition: 0.25s;
  }

  input:focus {
    border-color: #4e91fc;
    outline: none;
    background: #fff;
    box-shadow: 0 0 8px rgba(78, 145, 252, 0.2);
  }

  button {
    width: 100%;
    padding: 0.9rem;
    background: #4e91fc;
    color: white;
    font-weight: 600;
    font-size: 1rem;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background 0.3s ease;
  }

  button:hover {
    background: #346fd1;
  }

  a {
    display: block;
    text-align: center;
    margin-top: 1rem;
    color: #4e91fc;
    text-decoration: none;
    font-size: 0.95rem;
  }

  a:hover {
    text-decoration: underline;
  }
</style>

</head>
<body>
  <div class="form-wrapper">
    <div class="form-container">
      <h2>Daftar Akun</h2>
      <form action="proses-register.php" method="post">
        <input type="text" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="konfirmasi" placeholder="Konfirmasi Password" required>
        <button type="submit">Daftar</button>
      </form>
<p style="margin-top: 1rem; text-align: center;">
  Sudah punya akun? <a href="../admin/login.php">Login</a>
</p>

    </div>
  </div>
</body>

</html>
