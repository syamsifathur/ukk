<?php 
session_start();
//Koneksi ke database
include 'koneksi.php';

// Jika tidak ada session pelanggan (blm login)
if (!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"])) 
{
	echo "<script>alert('Silahkan login terlebih dahulu')</script>";
	echo "<script>alert('Silahkan login terlebih dahulu')</script>";
	exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/png" href="img/fav-icon.png">
	<title>Riwayat Belanja</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
	<link rel="stylesheet" href="style.css">
</head>
<body>

	<!-- Navbar -->
	<?php include "menu.php" ?>

	<!-- Konten -->
	<section class="riwayat">
		<div class="container">
			<h3> Riwayat Belanja <?php echo $_SESSION["pelanggan"]["nama_lengkap"] ?> </h3>

			<table class="table table-bordered">
				<thead>
					<tr>
						<th>No.</th>
						<th>Tanggal</th>
						<th>Status</th>
						<th>Total</th>
						<th>Opsi</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$nomor=1;
					// mendapatkan id_pelanggan yg login dari session
					$id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
					$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pelanggan='$id_pelanggan'");
					while ($pecah = $ambil->fetch_assoc()) {
					?>
					<tr>
						<td><?php echo $nomor; ?></td>
						<td><?php echo $pecah["tanggal"] ?></td>
						<td><?php echo $pecah["status_pembelian"] ?></td>
						<td>Rp. <?php echo number_format($pecah["total"]) ?></td>
						<td>
							<a href="nota.php?id=<?php echo $pecah["id_pembelian"] ?>" class="btn btn-secondary">Nota</a>
							<a href="pembayaran.php?id=<?php echo $pecah["id_pembelian"] ?>" class="btn btn-success">Pembayaran</a>
						</td>
					</tr>
					<?php $nomor++; ?>
					<?php } ?>
				</tbody>			
			</table>
		</div>
	</section>
	<!-- Akhir Konten -->












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
    <script src="js/jquery-3.4.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>