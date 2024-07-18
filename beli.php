<?php 
session_start();
include "admin/koneksi.php";

// Mendapatkan id produk dari URL dan memfilter input
$id_produk = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

// Jika $id_produk tidak valid, arahkan kembali ke halaman index
if (!$id_produk) {
    echo "<script>alert('ID produk tidak valid.');</script>";
    echo "<meta http-equiv='refresh' content='1;url=index.php'>";
    exit();
}

// Mempersiapkan dan menjalankan query untuk mengambil data produk dari database
$stmt = $koneksi->prepare("SELECT * FROM produk WHERE id_produk = ?");
$stmt->bind_param("i", $id_produk);
$stmt->execute();
$result = $stmt->get_result();
$detail = $result->fetch_assoc();

// Jika stok produk kosong, tampilkan alert dan arahkan kembali ke halaman index
if ($detail['stock'] == "0") {
    echo "<script>alert('Mohon maaf Stock produk lagi kosong, tenang saja akan segera di restock kok');</script>";
    echo "<meta http-equiv='refresh' content='1;url=index.php'>";
    exit();
}

// Jika produk sudah ada di keranjang, tambahkan jumlahnya
if (isset($_SESSION['keranjang'][$id_produk])) {
    $_SESSION['keranjang'][$id_produk] += 1;
    echo "<script>alert('Produk berhasil masuk ke Keranjang belanja');</script>";
    echo "<meta http-equiv='refresh' content='1;url=keranjang.php'>";
} 
// Jika produk belum ada di keranjang, tambahkan produk ke keranjang dengan jumlah 1
else {
    $_SESSION['keranjang'][$id_produk] = 1;
    echo "<script>alert('Produk berhasil masuk ke Keranjang belanja');</script>";
    echo "<meta http-equiv='refresh' content='1;url=keranjang.php'>";
}

// Menutup statement dan koneksi
$stmt->close();
$koneksi->close();
?>
