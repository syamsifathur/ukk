<?php
session_start();

// Validasi input
$id_produk = isset($_GET['id']) ? $_GET['id'] : null;

if (!is_numeric($id_produk)) {
    // Jika id_produk tidak valid, alihkan ke halaman keranjang
    echo "<script>alert('Permintaan tidak valid');</script>";
    echo "<script>location='keranjang.php';</script>";
    exit();
}

// Hapus produk dari keranjang
unset($_SESSION["keranjang"][$id_produk]);

// Pesan hapus dari keranjang
echo "<script>alert('Produk telah dihapus dari keranjang');</script>";
echo "<script>location='keranjang.php';</script>";
?>
