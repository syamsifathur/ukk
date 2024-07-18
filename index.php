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
    <title>ThuurStore</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Navbar -->
    <?php include "menu.php"; ?>

    <div class="keunggulan mt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
					<?php if (!isset($_SESSION['pelanggan']['nama_lengkap']) || empty($_SESSION['pelanggan']['nama_lengkap'])) {
    				echo '<h3>Selamat Datang</h3>';
					}
		 				else{
    					echo '<h3>Selamat Datang, ' . htmlspecialchars($_SESSION['pelanggan']['nama_lengkap']) . '</h3>';
						}
					?>
                    <hr>
                    <p>Selamat datang di ThuurStore, tempat terbaik untuk memenuhi segala kebutuhan produk digital premium Anda.
					 Kami adalah penyedia produk digital berkualitas tinggi yang dirancang untuk meningkatkan kreativitas, produktivitas,
					dan hiburan Anda. Di ThuurStore, kami menawarkan berbagai pilihan produk digital mulai dari lisensi software , lisensi hardware ,
					akun streaming  premium, serta voucher.</p>
					<p>Kenapa Memilih ThuurStore?</p>
                    <ul>
                        <li>Kualitas Terjamin: Kami hanya menyediakan produk digital berkualitas tinggi yang telah melalui seleksi ketat.</li>
                        <li>Pembayaran Aman: Nikmati berbagai metode pembayaran yang aman dan mudah.</li>
                        <li>Dukungan Pelanggan: Tim kami siap membantu Anda dengan dukungan pelanggan yang ramah dan responsif.</li>
                        <li>Pembaharuan Teratur: Produk-produk kami selalu diperbarui untuk memastikan Anda mendapatkan versi terbaru dengan fitur-fitur terbaru.</li>
                        <li>Bukan Akun Trial/Percobaan : Produk-produk kami merupakan sebuah produk resmi</li>
                        <li>Transaksi Mudah: Proses pembelian yang cepat dan mudah dengan sistem pengiriman digital yang langsung.</li>
                        <li>Bergaransi</li>
                    </ul>
                    <p>Bergabunglah dengan ribuan pelanggan puas yang telah menemukan solusi digital terbaik mereka di ThuurStore. Jadilah bagian dari
						 komunitas kami dan bawa kreativitas serta produktivitas Anda ke level berikutnya dengan produk digital premium dari kami.
					Jadi Tunggu Apalagi, Buruan Order Gan, Stok Terbatas Lho !!</p>
					<h4>ThuurStore - Solusi Digital Premium untuk Anda!</h4>
                </div>
                <div class="col-md-4 mt-4">
                    <img src="img/bg-netflix.jpeg" alt="" class="img-fluid mt-4">
                </div>
            </div>
            <hr>
        </div>
    </div>

    <!-- Produk -->
    <section class="konten">
        <div class="container">
            <h2>Produk Terlaris</h2>
            <div class="row mt-4">
                <?php 
                $query = $koneksi->prepare("SELECT * FROM produk WHERE id_produk BETWEEN 1 AND 3");
                $query->execute();
                $result = $query->get_result();

                while ($perproduk = $result->fetch_assoc()): 
                ?>
                    <div class="col-md-4">
                        <div class="thumbnail">
                            <img src="img/<?= htmlspecialchars($perproduk['foto_produk']); ?>" class="img-thumbnail" alt="" width="200">
                            <div class="caption">
                                <h3><?= htmlspecialchars($perproduk['nama_produk']); ?></h3>
                                <h5>Rp. <?= number_format($perproduk['harga']); ?></h5>
                                <a href="beli.php?id=<?= htmlspecialchars($perproduk['id_produk']); ?>" class="btn btn-primary">Beli</a>
                                <a href="detail.php?id=<?= htmlspecialchars($perproduk['id_produk']); ?>" class="btn btn-secondary">Detail</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
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
