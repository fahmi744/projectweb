<?php
session_start();
if(!isset($_SESSION['id_pengguna'])) {
    header("location: login.php");
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/font-awesome/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/simple-sidebar.css">

    <title>::. Administrator .::</title>
  </head>
  <body>
  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-primary border-right text-white" id="sidebar-wrapper">
      <div class="sidebar-heading">MyBlog </div>
      <div class="list-group list-group-flush bg-primary text-white">
        <a href="<?='dashboard.php';?>" class="list-group-item list-group-item-action bg-info text-white active"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="<?='artikel.php';?>" class="list-group-item list-group-item-action bg-primary text-white"><i class="fas fa-newspaper"></i> Artikel</a>
        <a href="#" class="list-group-item list-group-item-action bg-primary text-white"><i class="fas fa-address-card"></i> About</a>
        <a href="#" class="list-group-item list-group-item-action bg-primary text-white"><i class="fas fa-layer-group"></i> Produk</a>
        <a href="#" class="list-group-item list-group-item-action bg-primary text-white"><i class="fas fa-wrench"></i> Layanan</a>
        <a href="#" class="list-group-item list-group-item-action bg-primary text-white"><i class="fas fa-id-card-alt"></i> Kontak</a>
        <a href="<?='galeri.php';?>" class="list-group-item list-group-item-action bg-primary text-white"><i class="fas fa-id-card-alt"></i> galeri</a>
    </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-default" id="menu-toggle"><i class="fas fa-bars"></i> </button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-user"></i> Admin
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#"><i class="fas fa-edit"></i> Profile</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>

      <div class="container-fluid">
        <h2 class="mt-4 mb-4"><i class="fas fa-tachometer-alt"></i> produk</h2>

        <div class="alert alert-info alert-dismissible fade show" role="alert">
          <strong>Hi,</strong> ala
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="row">
          <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2 bg-primary">
                  <div class="card-body ">
                      <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-white mb-1">Artikel</div>
                          <div class="h5 mb-0 font-weight-bold text-white">0</div>
                      </div>
                      <div class="col-auto">
                          <i class="fas fa-newspaper fa-4x text-white"></i>
                      </div>
                      </div>
                  </div>
              </div>
          </div>

          <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2 bg-warning">
                  <div class="card-body ">
                      <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-white mb-1">Produk</div>
                          <div class="h5 mb-0 font-weight-bold text-white rounded-circle">0</div>
                      </div>
                      <div class="col-auto">
                          <i class="fas fa-address-card fa-4x text-white"></i>
                      </div>
                      </div>
                  </div>
              </div>
          </div>

          <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2 bg-success">
                  <div class="card-body ">
                      <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-white mb-1">Layanan</div>
                          <div class="h5 mb-0 font-weight-bold text-white">0</div>
                      </div>
                      <div class="col-auto">
                          <i class="fas fa-wrench fa-4x text-white"></i>
                      </div>
                      </div>
                  </div>
              </div>
          </div>
        </div><!--END row-->        

      </div><!--END container-fluid-->
    </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../assets/js/jquery-3.4.1.slim.min.js" ></script>
    <script src="../assets/js/popper.min.js" ></script>
    <script src="../assets/js/bootstrap.min.js"></script>

  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });

    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })    
  </script>

  </body>
</html>