<?php
session_start();
if (!isset($_SESSION['id_pengguna']) || $_SESSION['level'] != 0) {
    header("Location: ../user/index-user.php");
    exit;
}

?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>::. Administrator .::</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../assets/font-awesome/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: sans-serif;
    }

    body {
      display: flex;
      min-height: 100vh;
      overflow-x: hidden;
      background-color: #f8f9fa;
    }

    #wrapper {
      display: flex;
      width: 100%;
      transition: all 0.3s ease;
    }

    #sidebar-wrapper {
      width: 250px;
      min-height: 100vh;
      background-color:rgb(54, 26, 26);
      color: white;
      flex-shrink: 0;
      transition: margin-left 0.3s ease;
    }

    .list-group a {
      display: block;
      padding: 15px 20px;
      color: #f8f9fa;
      text-decoration: none;
      border-bottom: 1px solid rgba(255,255,255,0.1);
      transition: background 0.3s, padding-left 0.3s;
    }

    .list-group a i {
      margin-right: 10px;
    }

    .list-group a:hover, .list-group a.active {
      padding-left: 25px;
    }

    #wrapper.toggled #sidebar-wrapper {
      margin-left: -250px;
    }

    .sidebar-heading {
    font-size: 1.8em;
    font-weight: bold;
    padding: 25px 20px;
    background: linear-gradient(135deg,rgb(189, 28, 28),rgb(179, 34, 15)); /* gradasi warna */
    text-align: center;
    text-transform: uppercase;
    color: white;
    letter-spacing: 1px;
    box-shadow: inset 0 -4px 10px rgba(0,0,0,0.3); /* sedikit kedalaman */
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }

    .list-group a {
      display: block;
      padding: 15px 20px;
      color: white;
      text-decoration: none;
      border-top: 1px solid rgba(255,255,255,0.1);
      transition: background 0.3s;
    }

    .list-group a:hover, .list-group a.active {
      background:rgb(182, 39, 29);
    }

    #page-content-wrapper {
      flex-grow: 1;
      transition: all 0.3s ease;
    }

    nav.navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: #e9ecef;
      padding: 10px 20px;
      border-bottom: 1px solid #ccc;
    }

    .navbar .btn {
      background: none;
      border: none;
      cursor: pointer;
      font-size: 18px;
    }

    .nav-item {
      position: relative;
    }

    .nav-link {
      cursor: pointer;
      color: #333;
      text-decoration: none;
      display: flex;
      align-items: center;
    }

    .dropdown-menu {
      display: none;
      position: absolute;
      right: 0;
      background: white;
      border: 1px solid #ccc;
      margin-top: 5px;
      min-width: 150px;
      z-index: 10;
    }

    .dropdown-menu.show {
      display: block;
    }

    .dropdown-item {
      padding: 10px 15px;
      text-decoration: none;
      display: block;
      color: #333;
    }

    .dropdown-item:hover {
      background: #f1f1f1;
    }

    .container-fluid {
      padding: 20px;
    }

    

  </style>
</head>
<body>
  <div id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
      <div class="sidebar-heading">Coupang</div>
      <div class="list-group">
        <a href="dashboard.php" class="active"><i class="fa-solid fa-house"></i>Beranda</a>
        <a href="dashboard.php?module=k-dapur&page=daftar-Kdapur"><i class="fas fa-utensils"></i> Kebutuhan Dapur</a>
        <a href="dashboard.php?module=kategori&page=daftar-kibuanak"><i class="fas fa-baby"></i> Kebutuhan Ibu & Anak</a>
        <a href="dashboard.php?module=k-dapur&page=daftar-Kdapur"><i class="fas fa-utensils"></i> Kebutuhan Dapur</a>
        <a href="dashboard.php?module=kategori&page=daftar-kibuanak"><i class="fas fa-baby"></i> Kebutuhan Ibu & Anak</a>
        <a href="dashboard.php?module=kategori&page=daftar-krumah"><i class="fas fa-couch"></i> Kebutuhan Rumah</a>
        <a href="dashboard.php?module=kategori&page=daftar-makanan"><i class="fas fa-hamburger"></i> Makanan</a>
        <a href="dashboard.php?module=kategori&page=daftar-minuman"><i class="fas fa-coffee"></i> Minuman</a>
        <a href="dashboard.php?module=kategori&page=daftar-organik"><i class="fas fa-leaf"></i> Organik</a>
        <a href="dashboard.php?module=kategori&page=daftar-produks"><i class="fas fa-box-open"></i> Semua Produk</a>
        <a href="dashboard.php?module=kategori&page=daftar-sayuran"><i class="fas fa-carrot"></i> Sayuran</a>
      </div>
    </div>

    <!-- Page Content -->
    <div id="page-content-wrapper">
      <nav class="navbar">
        <button class="btn" id="menu-toggle">☰</button>
        <div class="nav-item">
          <a class="nav-link" id="admin-toggle"></i>👤 Admin <i class="fas fa-caret-down" style="margin-left: 5px;"></i></a>
          <div class="dropdown-menu" id="admin-dropdown">
            <a class="dropdown-item" href="#"><i class="fas fa-edit"></i> Profile</a>
            <a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
          </div>
        </div>
      </nav>

      <div class="container-fluid">
        <?php 
          $page = 'page/dashboard-main.php';
          if (isset($_GET['module']) && isset($_GET['page'])) {
            $page = 'page/' . $_GET['module'] . '/' . $_GET['page'] . '.php';
          }
          require($page);
        ?>
      </div>
    </div>
  </div>

  <!-- JS -->
  <script src="../assets/js/jquery-3.4.1.slim.min.js"></script>
  <script>
    // Toggle sidebar
    document.getElementById("menu-toggle").addEventListener("click", function(e) {
      e.preventDefault();
      document.getElementById("wrapper").classList.toggle("toggled");
    });

    // Toggle Admin dropdown
    document.getElementById("admin-toggle").addEventListener("click", function (e) {
      e.preventDefault();
      document.getElementById("admin-dropdown").classList.toggle("show");
    });

    // Close dropdown if click outside
    document.addEventListener("click", function (e) {
      const dropdown = document.getElementById("admin-dropdown");
      const toggle = document.getElementById("admin-toggle");
      if (!dropdown.contains(e.target) && !toggle.contains(e.target)) {
        dropdown.classList.remove("show");
      }
    });
  </script>
</body>
</html>
