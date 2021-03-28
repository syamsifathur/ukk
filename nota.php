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
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
	<link rel="stylesheet" href="style.css">
	<title>Nota Pembelian</title>
</head>
<body>

	<!-- Navbar -->
	<?php include "menu.php" ?>

	<section class="konten">
		<div class="container">
			
		<h2>Detail Pembelian</h2>
		<?php 
		$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");
		$detail = $ambil->fetch_assoc();
		?>

		<!-- jika pelanggan yg beli tidak sama dengan pelanggan yg login, maka dilarikan ke riwayat.php -->
		<!-- pelanggan yg beli harus pelanggan yg login -->
		<!--<?php 
		// mendapatkan id_pelanggan yg beli
		//$idpelangganyangbeli = $detail["id_pelanggan"];
		// mendapatkan id_pelanggan yg login
		//$idpelangganyanglogin = $_SESSION["pelanggan"]["id_pelanggan"];

		//if ($idpelangganyanglogin!==$idpelangganyangbeli) 
		//{
		//	echo "<script>alert('Nota ini bukan milik anda');</script>";
		//	echo "<script>location='riwayat.php';</script>";
		//	exit();
		//}
		?>-->


		<div class="row">
			<div class="col-md-6">
				<h3>Pembelian</h3>
				<strong>No. Pembelian: <?php echo $detail['id_pembelian'] ?></strong><br>
				Tanggal: <?php echo $detail['tanggal']; ?><br>
				Total: Rp. <?php echo number_format($detail['total']);  ?><br>
				Status Pembelian : <?php echo $detail['status_pembelian']; ?>
			</div>
			<div class="col-md-6">
				<h3>Pelanggan</h3>
				<strong><?php echo $detail['nama_lengkap']; ?></strong><br>
				<p>
					Email :<?php echo $detail['email']; ?><br>
					No.Hp :<?php echo $detail['no_hp']; ?>
				</p>
			</div>
		</div>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Produk</th>
				<th>Harga</th>
				<th>Jumlah</th>
				<th>Subtotal</th>
			</tr>
		</thead>
		<tbody>
			<?php $nomor=1; ?>
			<?php $ambil=$koneksi->query("SELECT * FROM pembelian_produk JOIN produk ON pembelian_produk.id_produk=produk.id_produk WHERE pembelian_produk.id_pembelian='$_GET[id]'"); ?>
			<?php while($pecah=$ambil->fetch_assoc()){ ?>
			<tr>
				<td><?php echo $nomor; ?></td>
				<td><?php echo $pecah['nama_produk']; ?></td>
				<td>Rp. <?php echo number_format($pecah['harga']) ?></td>
				<td><?php echo $pecah['jumlah']; ?></td>
				<td>
					Rp. <?php echo number_format($pecah['harga']*$pecah['jumlah']) ?>
				</td>
			</tr>
			<?php $nomor++; ?>
			<?php } ?>
		</tbody>
	</table>

	<div class="row">
		<div class="col-md-7">
			<div class="alert alert-info">
				<p> Silahkan Melakukan Pembayaran Rp. <?php echo number_format($detail['total']) ?> ke <br>
					<strong>BANK BCA 4323189019 AN SYAMSI FATHUR RACHMAD</strong><br>
					<strong>SHOPEE PAY 0812345123941 AN SYAMSI FATHUR RACHMAD</strong><br>
					<strong>DANA 0812345123941 AN SYAMSI FATHUR RACHMAD</strong><br>
					<strong>OVO 0812345123941 AN SYAMSI FATHUR RACHMAD</strong><br>
				</p>
			</div>
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