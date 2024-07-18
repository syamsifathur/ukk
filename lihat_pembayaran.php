<?php 
session_start();
//Koneksi ke database
include 'koneksi.php';

$id_pembelian = $_GET["id"];

$ambil = $koneksi->query("SELECT * FROM pembayaran LEFT JOIN pembelian ON pembayaran.id_pembelian=pembelian.id_pembelian WHERE pembelian. id_pembelian='$id_pembelian'");
$detbay = $ambil->fetch_assoc();

// jika blom ada data pembayaran
if (empty($detbay)) 
{
	echo "<script>alert('Belum ada data pembayaran')</script>";
	echo "<script>location='riwayat.php'</script>";
	exit();
}

// jika data pelanggan yg bayar tidak sesuai dengan yg login
if ($_SESSION["pelanggan"]['id_pelanggan']!==$detbay["id_pelanggan"]) 
{
	echo "<script>alert('Mohon maaf anda tidak berhak melihat pembayaran orang lain')</script>";
	echo "<script>location='riwayat.php'</script>";
	exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/png" href="img/fav-icon1.png">
	<title>Lihat Pembayaran</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
	<link rel="stylesheet" href="style.css">
</head>
<body>

	<!-- Navbar -->
	<?php include "menu.php" ?>

	<div class="container mt-4">
		<h3>Lihat Pembayaran</h3>
		<div class="row">
			<div class="col-md-6">
				<table class="table">
					<tr>
						<th>Nama</th>
						<td><?php echo $detbay["nama"]?></td>
					</tr>
					<tr>
						<th>Bank</th>
						<td><?php echo $detbay["bank"] ?></td>
					</tr>
					<tr>
						<th>Tanggal</th>
						<td><?php echo $detbay["tanggal"] ?></td>
					</tr>
					<tr>
						<th>Jumlah</th>
						<td>Rp. <?php echo number_format($detbay["jumlah"]) ?> </td>
					</tr>
					<tr>
					<th>Username Akun : </th>
					<th><?php echo $detbay['username_akun'] ?></th>
					</tr>
					<tr>
						<th>Password Akun : </th>
						<th><?php echo $detbay['password_akun'] ?></th>
					</tr>
				</table>
			</div>
			<div class="col-md-6">
				<img src="bukti_pembayaran/<?php echo $detbay["bukti"]?>" alt="bukti" class="img-thumbnail rounded mx-auto d-block" width="350">
			</div>
		</div>
	</div>

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