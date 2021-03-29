<?php session_start(); ?>
<?php include 'koneksi.php'; ?>
<?php
// mendapatkan id_produk dari url
$id_produk = $_GET["id"];

// query ambil data
$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
$detail = $ambil->fetch_assoc();

//echo "<pre>";
//print_r($detail);
//echo "</pre>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/png" href="img/fav-icon.png">
	<title>Detail Produk</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
	<link rel="stylesheet" href="style.css">
</head>
<body>

	<!-- Navbar -->
	<!-- Navbar -->
	<?php include "menu.php" ?>
	
	<section class="konten">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<img src="img/<?php echo $detail['foto_produk']; ?>" alt="" class="img-thumbnail " width="300px">
				</div>
				<div class="col-md-8">
					<h2><?php echo $detail["nama_produk"] ?></h2>
					<h4>Rp. <?php echo number_format($detail['harga']); ?></h4>
					<h5>Stok: <?php echo $detail['stock']; ?></h5>

					<form method="post">
						<div class="form-group">
							<div class="input-group">
								<input type="number" min="1" class="form-control" name="jumlah" max="<?php echo $detail['stock']; ?>" placeholder="Masukkan jumlah item yg mau dibeli">
								<div class="input-group-btn">
									<button class="btn btn-primary" name="beli">Beli</button>
								</div>
							</div>
						</div>
					</form>

					<?php 
					// jika ada tombol beli
					if (isset($_POST["beli"])) 
					{
						// mendapatkan jumlah yg diinputkan
						$jumlah = $_POST["jumlah"];
						// masukkan di keranjang belanja
						$_SESSION["keranjang"][$id_produk] = $jumlah;

						//larikan ke halaman keranjang
						echo "<script>alert('Produk berhasil masuk ke Keranjang belanja');</script>";
						echo "<script>location='keranjang.php'</script>";
					}
					?>

					<p>Untuk deskripsi selengkapnya cek <a href="deskripsi.php">disini</p>

				</div>
			</div>
		</div>
	</section>

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