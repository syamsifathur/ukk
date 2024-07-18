<?php 
session_start();
// Koneksi ke database
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="img/fav-icon1.png">
    <title>Daftar Pelanggan</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style-login.css">
</head>
<body>

    <div class="container">
        <div class="row ">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body">
                        <h5 class="card-title text-center">Daftar Pelanggan</h5>
                        <form class="form-signin" method="post">
                            <div class="form-label-group">
                                <input id="inputEmail" type="email" class="form-control" name="email" placeholder="Email" required>
                                <label for="inputEmail">Email</label>
                            </div>
                            <div class="form-label-group">
                                <input id="inputPw" type="password" class="form-control" name="password" placeholder="Password" required>
                                <label for="inputPw">Password</label>
                            </div>
                            <div class="form-label-group">
                                <input id="inputNama" type="text" class="form-control" name="nama" placeholder="Nama Lengkap" required>
                                <label for="inputNama">Nama Lengkap</label>
                            </div>
                            <div class="form-label-group">
                                <input id="inputNo" type="number" class="form-control" name="nohp" placeholder="No.Hp" required>
                                <label for="inputNo">No.hp</label>
                            </div>
                            <button class="btn btn-lg btn-primary btn-block text-uppercase" name="daftar">Daftar</button>
                            <hr class="my-4">
                            Sudah Memiliki akun? Silahkan <a href="login.php" style="text-decoration: none; color: black;">Login</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php 
if (isset($_POST["daftar"])) {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST["password"];
    $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
    $nohp = filter_input(INPUT_POST, 'nohp', FILTER_SANITIZE_NUMBER_INT);

    // cek jika email sudah digunakan
    $stmt = $koneksi->prepare("SELECT * FROM pelanggan WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $yangcocok = $stmt->num_rows;

    if ($yangcocok > 0) {
        echo "<script>alert('pendaftaran gagal, email sudah digunakan');</script>";
        echo "<script>location='daftar.php';</script>";
    } else {
        // Hash password sebelum menyimpan ke database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // lakukan query ke tabel pelanggan
        $stmt = $koneksi->prepare("INSERT INTO pelanggan (email, password, nama_lengkap, no_hp) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $email, $hashed_password, $nama, $nohp);
        $stmt->execute();

        echo "<script>alert('anda sukses daftar silahkan login');</script>";
        echo "<script>location='login.php';</script>";
    }

    $stmt->close();
}
?>

<!-- Bagian Footer -->
<?php include "footer.php"; ?>
<!-- Akhir Footer -->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="admin/assets/js/jquery-3.5.1.slim.min.js"></script>
<script src="admin/assets/js/popper.min.js"></script>
<script src="admin/assets/js/bootstrap.bundle.min.js"></script>

</body>
</html>
