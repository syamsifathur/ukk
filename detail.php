<?php 
session_start();
include 'koneksi.php';

// Mendapatkan id_produk dari URL
$id_produk = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

// Query ambil data
$stmt = $koneksi->prepare("SELECT * FROM produk WHERE id_produk = ?");
$stmt->bind_param("i", $id_produk);
$stmt->execute();
$result = $stmt->get_result();
$detail = $result->fetch_assoc();

// Cek apakah produk ditemukan
if (!$detail) {
    echo "<script>alert('Produk tidak ditemukan');</script>";
    echo "<script>location='index.php';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="img/fav-icon.png">
    <title>Detail Produk</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Navbar -->
    <?php include "menu.php" ?>
    
    <section class="konten mt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <img src="img/<?php echo htmlspecialchars($detail['foto_produk']); ?>" alt="" class="img-thumbnail" width="300px">
                </div>
                <div class="col-md-8">
                    <h2><?php echo htmlspecialchars($detail["nama_produk"]); ?></h2>
                    <h4>Rp. <?php echo number_format($detail['harga']); ?></h4>
                    <h5>Stok: <?php echo htmlspecialchars($detail['stock']); ?></h5>

                    <form method="post">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="number" min="1" class="form-control" name="jumlah" max="<?php echo htmlspecialchars($detail['stock']); ?>" placeholder="Masukkan jumlah item yg mau dibeli" required>
                                <div class="input-group-btn">
                                    <button class="btn btn-primary" name="beli">Beli</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <p>Deskripsi Singkat: <br><?php echo nl2br(htmlspecialchars($detail['deskripsi_produk'])); ?></p>

                    <?php 
                    // Jika ada tombol beli
                    if (isset($_POST["beli"])) {
                        // Mendapatkan jumlah yang diinputkan
                        $jumlah = filter_input(INPUT_POST, 'jumlah', FILTER_VALIDATE_INT);
                        if ($jumlah && $jumlah > 0 && $jumlah <= $detail['stock']) {
                            // Masukkan di keranjang belanja
                            $_SESSION["keranjang"][$id_produk] = $jumlah;

                            // Larikan ke halaman keranjang
                            echo "<script>alert('Produk berhasil masuk ke Keranjang belanja');</script>";
                            echo "<script>location='keranjang.php';</script>";
                        } else {
                            echo "<script>alert('Jumlah tidak valid');</script>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>

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
