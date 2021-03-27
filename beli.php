<?php 
session_start();
// mendapatkan id produk dari url
$id_produk = $_GET['id'];

//jk sudah ada produk itu dikeranjang, maka produk itu jumlahnya di +1
if (isset($_SESSION['keranjang'][$id_produk]))
{
	$_SESSION['keranjang'][$id_produk]+=1;
}

//Selainitu (blm ada di keranjang), maka produk itu dianggap dibeli 1
else 
{
	$_SESSION['keranjang'][$id_produk] = 1;
}


//larikan ke halaman keranjang
echo "<script>alert('Produk berhasil masuk ke Keranjang belanja');</script>";
echo "<meta http-equiv='refresh' content='1;url=keranjang.php'>";
?>