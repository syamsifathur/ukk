<?php 
//Koneksi ke database
include 'koneksi.php';
$keyword = $_GET["keyword"];

$semuadata = array();
$ambil = $koneksi->query("SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%' ");
while ($pecah = $ambil->fetch_assoc()) 
{
	$semuadata[]=$pecah;
}

// echo "<pre>";
// print_r($semuadata);
// echo "</pre>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/png" href="img/fav-icon.png">
	<title>Pencarian</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
	<link rel="stylesheet" href="style.css">
</head>
<body>

	<!-- Navbar -->
	<?php include "menu.php" ?>

	<!-- Konten -->
	<div class="container">
		<h3>Hasil Pencarian : <?php echo $keyword ?></h3>
 
		<?php if(empty($semuadata)): ?>
			<div class="alert alert-danger">Produk <strong> <?php echo $keyword ?></strong> tidak ditemukan </div>
		<?php endif ?>

		<div class="row">
			<?php foreach ($semuadata as $key => $value): ?>
			<div class="col-md-3">
				<div class="thumbnail">
					<img src="img/<?php echo $value['foto_produk']; ?>" class="img-thumbnail" alt="" width="200">
					<div class="caption">
						<h3><?php echo $value['nama_produk'] ?></h3>
						<h5>Rp. <?php echo number_format($value['harga']); ?></h5>
						<a href="beli.php?id=<?php echo $value['id_produk']; ?>" class="btn btn-primary">Beli</a>
						<a href="detail.php?id=<?php echo $value['id_produk'];?>" class="btn btn-secondary">Detail</a>
					</div>
				</div>
			</div>
			<?php endforeach ?>
		</div>
	</div>

	<!-- Bagian Footer -->
    <?php include "footer.php" ?>
    <!-- Akhir Footer -->

    <!-- Menu Copyright -->
    <div class="copyright">
        Copyright © 2021 Syamsi Fathur Rachmad
    </div>
    <!-- Akhir Menu Copyright -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="admin/assets/js/jquery-3.5.1.slim.min.js"></script>
    <script src="admin/assets/js/popper.min.js"></script>
    <script src="admin/assets/js/bootstrap.bundle.min.js"></script>

</body>
</html>