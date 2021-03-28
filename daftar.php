<?php 
session_start();
//Koneksi ke database
include 'koneksi.php';
?>

<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/png" href="img/fav-icon.png">
	<title>Daftar Pelanggan</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
	<link rel="stylesheet" href="style.css">
</head>
<body>

	<!-- Navbar -->
	<!-- Navbar -->
	<?php include "menu.php" ?>

	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Daftar Pelanggan</h3>
					</div>
					<div class="panel-body">
						<form method="post">
							<div class="form-group">
								<label>Email</label>
								<input type="email" class="form-control" name="email">
							</div>
							<div class="form-group">
								<label>Password</label>
								<input type="password" class="form-control" name="password">
							</div>
							<div class="form-group">
								<label>Nama Lengkap</label>
								<input type="text" class="form-control" name="nama">
							</div>
							<div class="form-group">
								<label>No.hp</label>
								<input type="number" class="form-control" name="nohp">
							</div>
							<button class="btn btn-primary" name="daftar">Daftar</button>
						</form>
						Sudah Memiliki akun? Silahkan <a href="login.php">Login</a>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php 
// jika ada tombol daftar(tombol daftar ditekan)
if (isset($_POST["daftar"]))
{
	$email = $_POST["email"];
	$password = $_POST["password"];
	$nama = $_POST["nama"];
	$nohp = $_POST["nohp"];

	// cek jika email sudah digunakan
	$ambil = $koneksi->query("SELECT*FROM pelanggan WHERE email='$email' ");
	$yangcocok = $ambil->num_rows;
	if ($yangcocok==1) 
	{
		echo "<script>alert('pendaftaran gagal, email sudah digunakan');</script>";
		echo "<script>location='daftar.php';</script>";
	}
	else {
	// lakukan query ke tabel pelanggan
		$koneksi->query("INSERT INTO pelanggan (email,password,nama_lengkap,no_hp) VALUES('$email','$password','$nama','$nohp')");

		echo "<script>alert('anda sukses daftar silahkan login');</script>";
		echo "<script>location='login.php';</script>";
	}
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