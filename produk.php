<?php 
session_start();
//Koneksi ke database
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/png" href="img/fav-icon.png">
	<title>Thuur Store</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
	<link rel="stylesheet" href="style.css">
</head>
<body>

	<!-- Navbar -->
	<?php include "menu.php" ?>

	<!-- konten -->
	<section class="konten mt-4">
		<div class="container">
			<h1>Produk Kami</h1>

			<div class="row">
				
				<?php $ambil = $koneksi->query("SELECT * FROM produk"); ?>
				<?php while ($perproduk= $ambil->fetch_assoc()){?>
				
				<div class="col-md-3 mt-4">
					<div class="thumbnail">
						<img src="img/<?php echo $perproduk['foto_produk']; ?>" class="img-thumbnail" alt="" width="200">
						<div class="caption">
							<h3><?php echo $perproduk['nama_produk'] ?></h3>
							<h5>Rp. <?php echo number_format($perproduk['harga']); ?></h5>
							<a href="beli.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-primary">Beli</a>
							<a href="detail.php?id=<?php echo $perproduk['id_produk'];?>" class="btn btn-secondary">Detail</a>
						</div>
					</div>
				</div>


				<?php } ?>


			</div>
		</div>
	</section>


	<!-- Bagian Footer -->
    <?php include "footer.php" ?>
    <!-- Akhir Footer -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="admin/assets/js/jquery-3.5.1.slim.min.js"></script>
    <script src="admin/assets/js/popper.min.js"></script>
    <script src="admin/assets/js/bootstrap.bundle.min.js"></script>

</body>
</html>