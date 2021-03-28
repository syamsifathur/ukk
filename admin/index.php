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
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <link rel="icon" type="image/png" href="../img/fav-icon.png">
        <title>Menu Administrator</title>
        <link href="assets/css/styles.css" rel="stylesheet" />
        <script src="assets/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">Administrator</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar search -->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Menu</div>
                            <a class="nav-link" href="index.php"><div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                                Home</a>
                            <a class="nav-link" href="index.php?halaman=produk"><div class="sb-nav-link-icon"><i class="fas fa-store"></i></div>
                                Produk</a>
                            <a class="nav-link" href="index.php?halaman=pembelian"><div class="sb-nav-link-icon"><i class="fas fa-shopping-basket"></i></div>
                                Pembelian</a>
                            <a class="nav-link" href="index.php?halaman=pelanggan"><div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                Pelanggan</a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php $ambil=$koneksi->query("SELECT * FROM admin"); ?>
                        <?php while ($pecah = $ambil->fetch_assoc()){ ?>
                        <strong><?php echo $pecah['username']; ?></strong>
                        <?php } ?>

                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Sidenav Light</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
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
                    </div>
                </main>

                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Syamsi Fathur Rachmad</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="assets/js/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="assets/js/scripts.js"></script>
   
</body>
</html>