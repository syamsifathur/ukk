<h2>Ubah Produk</h2>
<?php 
$ambil=$koneksi->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
$pecah=$ambil->fetch_assoc();

?>

<form method="post">
	<div class="form-group">
		<label>Nama Produk</label>
		<input type="text" name="nama" class="form-control" value="<?php echo $pecah['nama_produk']; ?>">
	</div>
	<div class="form-group">
		<label>Stock</label>
		<input type="number" name="stock" class="form-control" value="<?php echo $pecah['stock']; ?>">
	</div>
	<div class="form-group">
		<label>Harga (Rp)</label>
		<input type="number" name="harga" class="form-control" value="<?php echo $pecah['harga']; ?>">
	</div>
	<div class="form-group">
		<img src="../img/<?php echo $pecah['foto_produk']?>" width="200" >
	</div>
	<div class="form-group">
		<label>Ganti Foto</label>
		<input type="file" name="foto" class="form-control">
	</div>
    <div class="form-group">
		<label>Deskripsi Produk</label>
		<textarea class="form-control" name="deskripsi" required><?php echo $pecah['deskripsi_produk'] ?></textarea>
	</div>
	<button class="btn btn-primary" name="updatee">Ubah</button>
</form>

<?php 
if (isset($_POST['updatee'])) 
{
	$namafoto = $_FILES['foto']['name'];
	$lokasifoto = $_FILES['foto']['tmp_name'];
	// jk foto dirubah
	if (!empty($lokasifoto)) 
	{
		move_uploaded_file($lokasifoto, "../foto_produk/$namafoto");
		$koneksi->query("UPDATE produk SET nama_produk='$_POST[nama]', stock='$_POST[stock]',harga='$_POST[harga]',foto_produk='$namafoto',deskripsi_produk='$_POST[deskripsi]' WHERE id_produk='$_GET[id]'");
	}
	else
	{
		$koneksi->query("UPDATE produk SET nama_produk='$_POST[nama]', stock='$_POST[stock]',harga='$_POST[harga]',deskripsi_produk='$_POST[deskripsi]' WHERE id_produk='$_GET[id]'");
	}
	echo "<script>alert('data produk telah diubah');</script>";
	echo "<script>location='index.php?halaman=produk'</script>";
}
?>