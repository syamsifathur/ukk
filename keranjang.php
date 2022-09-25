<?php 
session_start();

 // echo "<pre>";
 // print_r($_SESSION['keranjang']);
 // echo "</pre>";
//Koneksi ke database
include 'koneksi.php';


if (empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"]))
{
	echo "<script>alert('Keranjang anda masih kosong, Silahkan Belanja terlebih dahulu')</script>";
	echo "<script>location='index.php';</script>";
	
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/png" href="img/fav-icon.png">
	<title>Keranjang Belanja</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
	<link rel="stylesheet" href="style.css">

</head>
<body>

<!-- Navbar -->
	<!-- Navbar -->
	<?php include "menu.php" ?>
	
<section class="konten mt-4">
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
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php $nomor=1; ?>
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
					<td>
						<a href="hapuskeranjang.php?id=<?php echo $id_produk ?>" onclick="return confirm('Anda yakin mau menghapus item ini ?')" class="btn btn-danger btn-xs">Hapus</a>
					</td>
				</tr>
				<?php $nomor++ ?>
				<?php endforeach  ?>
			</tbody>
		</table>

		<a href="index.php" class="btn btn-default">Lanjutkan belanja</a>
		<a href="checkout.php" class="btn btn-primary">Checkout</a>
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