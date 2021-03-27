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
	<title>Login Pelanggan</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
	<link rel="stylesheet" href="style.css">
</head>
<body>

	<!-- Navbar -->
	<!-- Navbar -->
	<?php include "menu.php" ?>
	
	<div class="container">
		<div class="row">
			<div class="col-md-4 ">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Login Pelanggan</h3>
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
							<button class="btn btn-primary" name="login">Login</button>
						</form>
							<div class="daftar">
								Belum Memiliki akun? <a href="daftar.php">Daftar disini</a>
							</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php 
// jika ada tombol login(tombol login ditekan)
if (isset($_POST["login"]))
{
	$email = $_POST["email"];
	$password = $_POST["password"];
	// lakukan query ngecek akun di tabel pelanggan di db
	$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email='$email' AND password='$password' ");
	//ngitung akun yang terambil
	$akunyangcocok = $ambil->num_rows;

	// jika 1 akun yang cocok, maka diloginkan
	if ($akunyangcocok==1)
	{
		//anda sudah login
		// mendapatkan akun dlm bentuk array
		$akun = $ambil->fetch_assoc();
		//simpan di session pelanggan
		$_SESSION["pelanggan"] = $akun;
		echo "<script>alert('anda sukses login');</script>";

		//jika sudah belanja langsung checkout
		if (isset($_SESSION["keranjang"]) OR !empty($_SESSION["keranjang"])) 
		{
			echo "<script>location='checkout.php';</script>";
		}
		//jika belum belanja lari ke
		else {
			echo "<script>location='index.php';</script>";
		}
		
	}
	else
	{
		//anda gagal login
		echo "<script>alert('anda gagal login, periksa akun anda');</script>";
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
    <script src="js/jquery-3.4.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>

</body>
</html>