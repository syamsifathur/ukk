<?php 
session_start();
//Koneksi ke database
include 'koneksi.php';

// jika tidak ada session pelanggan (blm login) maka di arahkan ke login.php
if (!isset($_SESSION["pelanggan"])) 
{
 	echo "<script>alert('Silahkan login terlebih dahulu');</script>";
 	echo "<script>location='login.php'</script>";
} 
elseif (!isset($_SESSION["keranjang"])) 
{
 	echo "<script>alert('Keranjang anda masih kosong, silahkan belanja terlebih dahulu');</script>";
 	echo "<script>location='index.php'</script>";
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/png" href="img/fav-icon.png">
	<title>Checkout</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<!-- Navbar -->
	<!-- Navbar -->
	<?php include "menu.php" ?>

	<section class="konten">
		<div class="container">
			<h1>Keranjang Belanja</h1>
			<hr>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>No</th>
						<th>Produk</th>
						<th>Harga</th>
						<th>Jumlah</th>
						<th>Subharga</th>
					</tr>
				</thead>
				<tbody>
					<?php $nomor=1; ?>
					<?php $totalbelanja = 0; ?>
	                <?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah): ?>
	                	<!-- menampilkan produk yg sedang diperulangkan berdasarkan id produk -->
	                	<?php  
	                	$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
	                	$pecah = $ambil->fetch_assoc();
	                	$subharga = $pecah["harga"]*$jumlah;
	                	?>
					<tr>
						<td><?php echo $nomor; ?></td>
						<td><?php echo $pecah["nama_produk"]; ?></td>
						<td>Rp. <?php echo number_format($pecah["harga"]); ?> </td>
						<td><?php echo $jumlah; ?></td>
						<td>Rp. <?php echo number_format($subharga); ?> </td>
					</tr>
					<?php $nomor++ ?>
					<?php $totalbelanja+=$subharga; ?>
					<?php endforeach  ?>
				</tbody>
				<tfoot>
					<tr>
						<th colspan="4">Total Belanja</th>
						<th>Rp. <?php echo number_format($totalbelanja) ?></th>
					</tr>
				</tfoot>
			</table>

			<form method="post">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<input type="text" readonly value="<?php echo($_SESSION["pelanggan"]['nama_lengkap']) ?>" class="form-control">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<input type="text" readonly value="<?php echo($_SESSION["pelanggan"]['no_hp']) ?>" class="form-control">
						</div>
					</div>
				</div>
				<button class="btn btn-primary" name="checkout">Checkout</button>
			</form>

			<?php 
			if (isset($_POST["checkout"])) 
			{
				$id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
				$tanggal_pembelian = date("Y-m-d");

				$total = $totalbelanja;

				// 1. menyimpan data ke tabel pembelian
				$koneksi->query("INSERT INTO pembelian (id_pelanggan,tanggal,total)VALUES ('$id_pelanggan','$tanggal_pembelian','$total')");

				// mendapatkan id_pembelian barusan terjadi
				$id_pembelian_produk = $koneksi->insert_id;

				foreach ($_SESSION["keranjang"] as $id_produk => $jumlah) 
				{
					$koneksi->query("INSERT INTO pembelian_produk (id_pembelian,id_produk,jumlah) VALUES ('$id_pembelian_produk','$id_produk','$jumlah')");

					// script update stok
					$koneksi->query("UPDATE produk SET stock=stock -$jumlah WHERE id_produk='$id_produk'");
				}
				// mengkosongkan keranjang setelah checkout
				unset($_SESSION["keranjang"]);

				//tampilan dialihkan ke halaman nota, nota dari pembelian barusan
				echo "<script>alert('pembelian suksees');</script>";
				echo "<script>location='nota.php?id=$id_pembelian_produk';</script>";
			}
			 ?>
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