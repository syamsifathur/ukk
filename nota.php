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
	<script src="admin/assets/js/all.min.js" crossorigin="anonymous"></script>
	<title>Nota Pembelian</title>
</head>
<body>

	<!-- Navbar -->
	<?php include "menu.php" ?>

	<?php 
	$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");
	$detail = $ambil->fetch_assoc();
	?>
	<div class="container mt-4">
		<a href="print.php?id=<?php echo $detail['id_pembelian'] ?>" target="_BLANK" style="text-decoration: none; color: #000;"><i class="fas fa-print"></i> Print disini</a>
	</div>

	<section class="konten mt-4">
		<div class="container">
		<h2>Detail Pembelian</h2>
		<?php 
		$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");
		$detail = $ambil->fetch_assoc();
		?>

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
		<br>
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
	<br>
	<div class="row">
		<div class="col-md-12">
			<div class="alert alert-info">
				<?php if ($detail['status_pembelian']=="Pending"): ?>
					<p> Silahkan Melakukan Pembayaran ke salah satu Rp. <?php echo number_format($detail['total']);  ?> :<br>
					<strong>Bank BCA 4323189019 AN SYAMSI FATHUR RACHMAD</strong><br>
					<strong>Dana 0812345123941 AN SYAMSI FATHUR RACHMAD</strong><br>
					<strong>Ovo 0812345123941 AN SYAMSI FATHUR RACHMAD</strong><br>
					Terimakasih Telah Membeli Produk Kami.
				</p>
				<a href="pembayaran.php?id=<?php echo $detail["id_pembelian"] ?>" class="btn btn-success">Konfirmasi Pembayaran</a>
				<?php else: ?>
					<a href="lihat_pembayaran.php?id=<?php echo $detail["id_pembelian"] ?>" class="btn btn-warning">Lihat Transaksi</a>
				<?php endif ?>
			</div>
		</div>
	</div>

		</div>
	</section>

	<!-- Bagian Footer -->
    <?php include "footer.php" ?>
    <!-- Akhir Footer -->

    <!-- Akhir Menu Copyright -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="admin/assets/js/jquery-3.5.1.slim.min.js"></script>
    <script src="admin/assets/js/popper.min.js"></script>
    <script src="admin/assets/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>