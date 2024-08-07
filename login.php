<?php 
session_start();
//Koneksi ke database
include 'koneksi.php';
?>

<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/png" href="img/fav-icon1.png">
	<title>Login Pelanggan</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css" type="text/css">
	<link rel="stylesheet" href="style.css" type="text/css">
	<link rel="stylesheet" href="style-login.css" type="text/css">
</head>
<body>
	
	<div class="container">
        <div class="row ">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body">
                        <h5 class="card-title text-center">Login Pelanggan</h5>
                        <form class="form-signin" method="post">
                             <div class="form-label-group">
                                    <input id ="inputEmail" type="text" class="form-control" name="email" placeholder="Email" required/>
                                    <label for="inputEmail">Email</label>
                                </div>
                                <div class="form-label-group">
                                    <input id="inputPassword" type="password" class="form-control"  name="password" placeholder="Password" required />
                                    <label for="inputPassword">Password</label>
                                </div>
                             
                             	<button class="btn btn-lg btn-primary btn-block text-uppercase" name="login">Login</button>
                             	<hr class="my-4">
                             	<div class="daftar">
								Belum Memiliki akun? <a href="daftar.php" style="text-decoration: none; color: #000000;">Daftar disini</a> <br>
								Login sebagai administrator? klik <a href="admin/login.php" style="text-decoration: none; color: #000000;">Disini</a>
							  </div>
                        </form>
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
		echo "<div class='alert alert-info'>Login Sukses</div>";
        echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=home'>";

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
		echo "<script>alert('Anda gagal login, mohon periksa email/password anda');</script>";
		echo "<script>location='login.php';</script>";
	}
}
?>

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