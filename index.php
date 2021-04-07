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

	<div class="keunggulan">
		<div class="container">
			<div class="row">
					<div class="col-md-8">
						<h3>Keunggulan produk kami</h3>
						<hr>
						<p>Berikut ini :</p>
		                        <ul>
		                            <li>TERPERCAYA ORIGINAL 100%</li>
		                            <li>FAST RESPONSE</li>
		                            <li>BERGARANSI FULL 1 BULAN</li>
		                            <li>TIDAK AKAN KENA ON HOLD / TROUBLE PAYMENT KARENA BERLANGGANAN RESMI</li>
		                            <li>BUKAN AKUN TRIAL/PEROCBAAN</li>
		                            <li>HARGA TERJANGKAU</li>
		                            <li>PROSES PENGIRIMAN CEPAT</lI>
		                            <li>PENGIRIMAN TIDAK DIPUNGUT BIAYA</li>
		                            <li>PELAYANAN AFTER SALES TERJAMIN</li>
		                        </ul>
		                 <p>Jadi Tunggu Apalagi, Buruan Order Gan, Stok Terbatas Lho !!</p>
		             </div>
		             <div class="col-md-4 mt-4">
		             	<img src="img/bg-netflix.jpeg" alt="" class="img-fluid mt-4">
	             	</div>
	           	</div>
	           	<hr>
			</div>
		</div>
	

	<!-- produk -->
	<section class="konten">
		<div class="container">
			<h2>Produk Favorit</h2>
			<div class="row mt-4">
				
				<?php $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='1'");
					  $ambil2 = $koneksi->query("SELECT * FROM produk WHERE id_produk='2'");
					  $ambil3 = $koneksi->query("SELECT * FROM produk WHERE id_produk='3'");
					  $ambil4 = $koneksi->query("SELECT * FROM produk WHERE id_produk='4'");
					  $perproduk2= $ambil2->fetch_assoc();
					  $perproduk3= $ambil3->fetch_assoc();
					  $perproduk4= $ambil4->fetch_assoc();?>
				<?php while ($perproduk= $ambil->fetch_assoc()) { ?>
				
				<div class="col-md-3">
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
				<div class="col-md-3">
					<div class="thumbnail">
						<img src="img/<?php echo $perproduk2['foto_produk']; ?>" class="img-thumbnail" alt="" width="200">
						<div class="caption">
							<h3><?php echo $perproduk2['nama_produk'] ?></h3>
							<h5>Rp. <?php echo number_format($perproduk2['harga']); ?></h5>
							<a href="beli.php?id=<?php echo $perproduk2['id_produk']; ?>" class="btn btn-primary">Beli</a>
							<a href="detail.php?id=<?php echo $perproduk2['id_produk'];?>" class="btn btn-secondary">Detail</a>
						</div>
					</div>
				</div>

				<div class="col-md-3">
					<div class="thumbnail">
						<img src="img/<?php echo $perproduk3['foto_produk']; ?>" class="img-thumbnail" alt="" width="200">
						<div class="caption">
							<h3><?php echo $perproduk3['nama_produk'] ?></h3>
							<h5>Rp. <?php echo number_format($perproduk3['harga']); ?></h5>
							<a href="beli.php?id=<?php echo $perproduk3['id_produk']; ?>" class="btn btn-primary">Beli</a>
							<a href="detail.php?id=<?php echo $perproduk3['id_produk'];?>" class="btn btn-secondary">Detail</a>
						</div>
					</div>
				</div>

				<div class="col-md-3">
					<div class="thumbnail">
						<img src="img/<?php echo $perproduk4['foto_produk']; ?>" class="img-thumbnail" alt="" width="200">
						<div class="caption">
							<h3><?php echo $perproduk4['nama_produk'] ?></h3>
							<h5>Rp. <?php echo number_format($perproduk4['harga']); ?></h5>
							<a href="beli.php?id=<?php echo $perproduk4['id_produk']; ?>" class="btn btn-primary">Beli</a>
							<a href="detail.php?id=<?php echo $perproduk4['id_produk'];?>" class="btn btn-secondary">Detail</a>
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