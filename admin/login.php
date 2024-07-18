<?php 
session_start();
//Koneksi ke database
include 'koneksi.php';

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="../img/fav-icon1.png">
    <title>Login Administrator</title>
	<!-- BOOTSTRAP STYLES-->
    <link rel="stylesheet" href="assets/css/style-login.css">
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
     <div class="container">
            <div class="row ">
                <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                    <div class="card card-signin my-5">
                        <div class="card-body">
                            <h5 class="card-title text-center">Login Administrator</h5>
                                <form class="form-signin" method="post">
                                     <div class="form-label-group">
                                            <input id ="inputEmail" type="text" class="form-control" name="user" placeholder="username" required/>
                                            <label for="inputEmail">Username</label>
                                        </div>
                                        <div class="form-label-group">
                                            <input id="inputPassword" type="password" class="form-control"  name="pass" placeholder="password" required />
                                            <label for="inputPassword">Password</label>
                                        </div>
                                     
                                     <button class="btn btn-lg btn-primary btn-block text-uppercase" name="login">Login</button>
                                     <hr class="my-4">
                                     Login sebagai pelanggan? klik <a href="../login.php">Disini</a>
                                     <hr class="my-4">
                                    </form>
                                    <?php 
                                    if (isset($_POST['login']))
                                    {
                                      $ambil = $koneksi->query("SELECT * FROM admin WHERE username='$_POST[user]' AND password ='$_POST[pass]'");
                                       $yangcocok = $ambil->num_rows;
                                       if ($yangcocok==1) 
                                       {
                                        $_SESSION['admin']=$ambil->fetch_assoc();
                                        echo "<div class='alert alert-info'>Login Sukses</div>";
                                        echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=home'>";
                                       }
                                       else 
                                       {
                                        echo "<div class='alert alert-danger'>Login Gagal</div>";
                                        echo "<meta http-equiv='refresh' content='1;url=login.php'>";
                                       }
                                    }
                                    ?>
                         </div>
                      </div>
                  </div>
              </div>
          </div>


     <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <script src="assets/js/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
