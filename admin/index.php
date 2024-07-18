<?php 
session_start();
// Koneksi ke database
include 'koneksi.php';

if (!isset($_SESSION['admin'])) {
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
        <a class="navbar-brand" href="index.php?halaman=home"><h5><b><strong>Administrator</strong></b></h5></a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        <!-- Navbar-->
        <ul class="navbar-nav ml-auto">
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
                        <a class="nav-link" href="index.php?halaman=home">
                            <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link" href="index.php?halaman=produk">
                            <div class="sb-nav-link-icon"><i class="fas fa-cube"></i></div>
                            Kelola Produk
                        </a>
                        <a class="nav-link" href="index.php?halaman=pembelian">
                            <div class="sb-nav-link-icon"><i class="fas fa-shopping-basket"></i></div>
                            Konfirmasi Pembelian
                        </a>
                        <a class="nav-link" href="index.php?halaman=laporan_pembelian">
                            <div class="sb-nav-link-icon"><i class="fas fa-file"></i></div>
                            Laporan Pembelian
                        </a>
                        <a class="nav-link" href="index.php?halaman=pelanggan">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            Kelola Pelanggan
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    <?php 
                    $ambil = $koneksi->query("SELECT nama_lengkap FROM admin");
                    while ($pecah = $ambil->fetch_assoc()) { 
                    ?>
                        <strong><?php echo htmlspecialchars($pecah['nama_lengkap']); ?></strong>
                    <?php } ?>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Thuur Store</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php?halaman=home">Dashboard</a></li>
                        <li class="breadcrumb-item active"><?php echo htmlspecialchars($_GET['halaman']); ?></li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-body">
                            <?php 
                            if (isset($_GET['halaman'])) {
                                $halaman = $_GET['halaman'];
                                switch ($halaman) {
                                    case "home":
                                        include 'home.php';
                                        break;
                                    case "produk":
                                        include 'produk.php';
                                        break;
                                    case "pembelian":
                                        include 'pembelian.php';
                                        break;
                                    case "pelanggan":
                                        include 'pelanggan.php';
                                        break;
                                    case "detail":
                                        include 'detail.php';
                                        break;
                                    case "tambahproduk":
                                        include 'tambahproduk.php';
                                        break;
                                    case "tambahpelanggan":
                                        include 'tambahpelanggan.php';
                                        break;
                                    case "hapusproduk":
                                        include 'hapusproduk.php';
                                        break;
                                    case "hapuspelanggan":
                                        include 'hapuspelanggan.php';
                                        break;
                                    case "editproduk":
                                        include 'editproduk.php';
                                        break;
                                    case "editpelanggan":
                                        include 'editpelanggan.php';
                                        break;
                                    case "pembayaran":
                                        include 'pembayaran.php';
                                        break;
                                    case "laporan_pembelian":
                                        include 'laporan_pembelian.php';
                                        break;
                                    default:
                                        echo "Halaman tidak ditemukan!";
                                        break;
                                }
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