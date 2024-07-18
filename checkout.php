<?php 
session_start();

// Koneksi ke database
include 'koneksi.php';

// Jika tidak ada session pelanggan (belum login), arahkan ke login.php
if (!isset($_SESSION["pelanggan"])) {
    echo "<script>alert('Silahkan login terlebih dahulu');</script>";
    echo "<script>location='login.php';</script>";
    exit();
} 

// Jika tidak ada session keranjang, arahkan ke index.php
if (!isset($_SESSION["keranjang"])) {
    echo "<script>alert('Keranjang anda masih kosong, silahkan belanja terlebih dahulu');</script>";
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
    <title>Checkout</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Navbar -->
    <?php include "menu.php"; ?>

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
                    <?php 
                    $nomor = 1; 
                    $totalbelanja = 0;
                    foreach ($_SESSION["keranjang"] as $id_produk => $jumlah):
                        // Menggunakan prepared statement untuk mengambil data produk
                        $stmt = $koneksi->prepare("SELECT * FROM produk WHERE id_produk = ?");
                        $stmt->bind_param("i", $id_produk);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $pecah = $result->fetch_assoc();
                        $subharga = $pecah["harga"] * $jumlah;
                    ?>
                    <tr>
                        <td><?php echo $nomor; ?></td>
                        <td><?php echo htmlspecialchars($pecah["nama_produk"]); ?></td>
                        <td>Rp. <?php echo number_format($pecah["harga"]); ?></td>
                        <td><?php echo htmlspecialchars($jumlah); ?></td>
                        <td>Rp. <?php echo number_format($subharga); ?></td>
                    </tr>
                    <?php 
                        $nomor++;
                        $totalbelanja += $subharga;
                        $stmt->close();
                    endforeach; 
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4">Total Belanja</th>
                        <th>Rp. <?php echo number_format($totalbelanja); ?></th>
                    </tr>
                </tfoot>
            </table>

            <form method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" readonly value="<?php echo htmlspecialchars($_SESSION["pelanggan"]['nama_lengkap']); ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" readonly value="<?php echo htmlspecialchars($_SESSION["pelanggan"]['no_hp']); ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary" name="checkout">Checkout</button>
            </form>

            <?php 
            if (isset($_POST["checkout"])) {
                $id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
                $tanggal_pembelian = date("Y-m-d");
                $total = $totalbelanja;

                // 1. Menyimpan data ke tabel pembelian
                $stmt = $koneksi->prepare("INSERT INTO pembelian (id_pelanggan, tanggal, total) VALUES (?, ?, ?)");
                $stmt->bind_param("isi", $id_pelanggan, $tanggal_pembelian, $total);
                $stmt->execute();

                // Mendapatkan id_pembelian yang baru saja terjadi
                $id_pembelian_produk = $stmt->insert_id;

                // Menyimpan data ke tabel pembelian_produk dan mengupdate stok
                foreach ($_SESSION["keranjang"] as $id_produk => $jumlah) {
                    $stmt = $koneksi->prepare("INSERT INTO pembelian_produk (id_pembelian, id_produk, jumlah) VALUES (?, ?, ?)");
                    $stmt->bind_param("iii", $id_pembelian_produk, $id_produk, $jumlah);
                    $stmt->execute();

                    $stmt = $koneksi->prepare("UPDATE produk SET stock = stock - ? WHERE id_produk = ?");
                    $stmt->bind_param("ii", $jumlah, $id_produk);
                    $stmt->execute();
                }

                // Mengosongkan keranjang setelah checkout
                unset($_SESSION["keranjang"]);

                // Mengarahkan ke halaman nota
                echo "<script>alert('Pembelian sukses');</script>";
                echo "<script>location='nota.php?id=$id_pembelian_produk';</script>";
            }
            ?>
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