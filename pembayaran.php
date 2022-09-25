<?php 
session_start();
//Koneksi ke database
include 'koneksi.php';

// Jika tidak ada session pelanggan (blm login)
if (!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"])) 
{
	echo "<script>alert('Silahkan login terlebih dahulu');</script>";
	echo "<script>location='login.php';</script>";
	exit();
}


// mendapatkan id_pembelian dari url
$idpem = $_GET["id"];
$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian='$idpem'");
$detpem = $ambil->fetch_assoc();

//mendapatkan id_pelanggan yg beli
$id_pelanggan_beli = $detpem["id_pelanggan"];
// mendapatkan id_pelanggan yg login
$id_pelanggan_login = $_SESSION["pelanggan"]["id_pelanggan"];

if ($id_pelanggan_login !==$id_pelanggan_beli) 
{
	echo "<script>alert('Pembayaran ini bukan milik anda');</script>";
	echo "<script>location='riwayat.php';</script>";
	exit();
}

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

	<?php 
	$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE id_pelanggan='$id_pelanggan_login'");
	$pecah = $ambil->fetch_assoc();
	 ?>
	<section class="konten">
		<div class="container mt-4">
			<h2>Konfirmasi Pembayaran</h2>
			<p>Kirim bukti pembayaran anda disini</p>
			<div class="alert alert-info">total tagihan Anda <strong>Rp. <?php echo number_format($detpem["total"]); ?> </strong></div>


			<form method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label>Nama Penyetor</label>
					<input type="text" class="form-control" name="nama" value="<?php echo $pecah['nama_lengkap']; ?>" required>
				</div>
				<div class="form-group">
					<label>Bank</label>
					<input type="text" class="form-control" name="bank" required>
				</div>
				<div class="form-group">
					<label>Jumlah</label>
					<input type="number" class="form-control" name="jumlah" min="1" value="<?php echo($detpem["total"]);?>" readonly>
				</div>
				<div class="form-group">
					<label>Foto Bukti</label>
					<input type="file" class="form-control" name="bukti" required>
					<p class="text-danger">Size foto maksimal 2MB</p>
				</div>
				<button class="btn btn-primary" name="kirim">Kirim</button>
			</form>
		</div>
	</section>

	<?php 
	// jika tombol kirim ditekan
	if (isset($_POST["kirim"])) 
	{
		// upload foto bukti
		$namabukti = $_FILES["bukti"]["name"];
		$lokasibukti = $_FILES["bukti"]["tmp_name"];
		$namafiks = date("YmdHis").$namabukti;
		move_uploaded_file($lokasibukti, "bukti_pembayaran/$namafiks");
		
		$nama = $_POST["nama"];
		$bank = $_POST["bank"];
		$jumlah = $_POST["jumlah"];
		$tanggal = date("Y-m-d");

		// simpan pembayaran
		$koneksi->query("INSERT INTO pembayaran(id_pembelian,nama,bank,jumlah,tanggal,bukti) 
			VALUES ('$idpem','$nama','$bank','$jumlah','$tanggal','$namafiks') ");

		// update data pembelian dari pending menjadi sukses
		$koneksi->query("UPDATE pembelian SET status_pembelian='Sudah kirim pembayaran' WHERE id_pembelian='$idpem'");

		echo "<script>alert('Terimakasih sudah Mengirim bukti pembayaran');</script>";
	echo "<script>location='riwayat.php';</script>";
	}
	?>



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