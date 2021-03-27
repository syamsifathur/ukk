<?php 
session_start();
//Koneksi ke database
include 'koneksi.php';


if (!isset($_SESSION['admin'])) 
{
    echo "<script>alert('Anda harus Log in');</script>";
    echo "<script>location='login.php';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Administrator Toko</title>
    <!-- Bootstrap css core -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
  <link href="assets/css/simple-sidebar.css" rel="stylesheet">
</head>
<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">Administrator </div>
      <div class="list-group list-group-flush">
        <a href="index.php" class="list-group-item list-group-item-action bg-light">Home</a>
        <a href="index.php?halaman=produk" class="list-group-item list-group-item-action bg-light">Produk</a>
        <a href="index.php?halaman=pembelian" class="list-group-item list-group-item-action bg-light">Pembelian</a>
        <a href="index.php?halaman=pelanggan" class="list-group-item list-group-item-action bg-light">Pelanggan</a>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
          <button class="btn btn-default" id="menu-toggle"><span class="navbar-toggler-icon"></span></button>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="../login.php" target="_blank" rel="nofollow">Login User</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">Log Out</a>
            </li>
          </ul>
        </div>
      </nav>

      <div class="container-fluid">
        
         <?php 
                if (isset($_GET['halaman']))
                {
                    if ($_GET['halaman']=="produk")
                    {
                        include 'produk.php';
                    }
                    elseif ($_GET['halaman']=="pembelian")
                    {
                        include 'pembelian.php';
                    }
                    elseif ($_GET['halaman']=="pelanggan")
                    {
                        include 'pelanggan.php';
                    }
                    elseif ($_GET['halaman']=="detail")
                    {
                        include 'detail.php';
                    }
                    elseif ($_GET['halaman']=="tambahproduk")
                    {
                        include 'tambahproduk.php';
                    }
                    elseif ($_GET['halaman']=="tambahpelanggan") 
                    {
                        include 'tambahpelanggan.php';
                    }
                    elseif ($_GET['halaman']=="hapusproduk")
                    {
                        include 'hapusproduk.php';
                    }
                    elseif ($_GET['halaman']=="hapuspelanggan")
                    {
                        include 'hapuspelanggan.php';
                    }
                    elseif ($_GET['halaman']=="editproduk")
                    {
                        include 'editproduk.php';    
                    }
                    elseif ($_GET['halaman']=="editpelanggan")
                    {
                        include 'editpelanggan.php';
                    }
                    elseif ($_GET['halaman']=="pembayaran") 
                    {
                        include 'pembayaran.php';
                    }
                }
                else 
                {
                    include 'home.php' ;
                }
                ?>
        
      </div>
    </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Bootstrap core JavaScript -->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.bundle.min.js"></script>

  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>
   
</body>
</html>