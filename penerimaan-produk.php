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
	<div class="container">
	<h2>Data Pembayaran</h2>

	<?php 
	// mendapatkan id_pembelian dari url
	$id_pembelian = $_GET['id'];

	//mengambil data pembayaran berdasarkan id_pembelian
	$ambil = $koneksi->query("SELECT*FROM pembayaran WHERE id_pembelian='$id_pembelian'");
	$detail = $ambil->fetch_assoc();

	?>

	<div class="row">
		<div class="col-md-6">
			<table class="table">
				<tr>
					<th>Nama</th>
					<td><?php echo $detail['nama'] ?></td>
				</tr>
				<tr>
					<th>Bank</th>
					<td><?php echo $detail['bank'] ?></td>
				</tr>
				<tr>
					<th>Jumlah</th>
					<td><?php echo number_format($detail['jumlah']) ?></td>
				</tr>
				<tr>
					<th>Tanggal</th>
					<th><?php echo $detail['tanggal'] ?></th>
				</tr>
			</table>
		</div>
		<div class="col-md-6">
			<img src="bukti_pembayaran/<?php echo $detail['bukti'] ?>" alt="bukti" width="250">
		</div>
	</div>

	<form method="post">
		<div class="form-group">
			<label>Status</label>
			<select name="status" class="form-control">
				<option value="">Pilih Status</option>
				<option value="Barang Telah Diterima">Barang Telah Diterima</option>
			</select>
		</div>
		<button class="btn btn-primary" name="proses">Proses</button>
	</form>

	<?php 
	if (isset($_POST["proses"])) 
	{
		$status = $_POST["status"];
		$koneksi->query("UPDATE pembelian SET status_pembelian='$status' WHERE id_pembelian='$id_pembelian'");

		echo "<script>alert('Data Pembelian Terupdate');</script>";
	    echo "<script>location='index.php?halaman=pembelian';</script>";
	}
	?>
	</div>
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
    <script src="admin/assets/js/jquery-3.5.1.slim.min.js"></script>
    <script src="admin/assets/js/popper.min.js"></script>
    <script src="admin/assets/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>