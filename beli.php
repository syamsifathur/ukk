<?php 
session_start();
include "admin/koneksi.php";
// mendapatkan id produk dari url
$id_produk = $_GET['id'];

// query ambil data dari database
$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
$detail = $ambil->fetch_assoc();

//jika stok produknya kosong maka muncul alert, dan produk tidak bisa masuk ke keranjang
if ($detail['stock']=="0") {
	echo "<script>alert('Mohon maaf Stock produk lagi kosong, tenang saja akan segera di restock kok');</script>";
	echo "<meta http-equiv='refresh' content='1;url=index.php'>";
}
//jk sudah ada produk itu dikeranjang, maka produk itu jumlahnya di +1
elseif (isset($_SESSION['keranjang'][$id_produk]))
{
	$_SESSION['keranjang'][$id_produk]+=1;
	echo "<script>alert('Produk berhasil masuk ke Keranjang belanja');</script>";
	echo "<meta http-equiv='refresh' content='1;url=keranjang.php'>";
}

//Selainitu (blm ada di keranjang), maka produk itu dianggap dibeli 1
else 
{
	$_SESSION['keranjang'][$id_produk] = 1;
	//larikan ke halaman keranjang
	echo "<script>alert('Produk berhasil masuk ke Keranjang belanja');</script>";
	echo "<meta http-equiv='refresh' content='1;url=keranjang.php'>";
}



?>