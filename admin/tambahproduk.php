<h2>Tambah Produk</h2>

<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Nama Produk</label>
		<input type="text" class="form-control" name="nama" required>
	</div>
	<div class="form-group">
		<label>Stock</label>
		<input type="number" class="form-control" name="stock" required>
	</div><div class="form-group">
		<label>Harga (Rp)</label>
		<input type="number" class="form-control" name="harga" required>
	</div>
	<div class="form-group">
		<label>Foto</label>
		<input type="file" class="form-control" name="foto" required>
	</div>
	<button class="btn btn-primary" name="save">Simpan</button>
</form>
<?php 
if (isset($_POST['save'])) {
	
	$nama = $_FILES['foto']['name'];
	$lokasi = $_FILES['foto']['tmp_name'];
	move_uploaded_file($lokasi, "../img/".$nama);

	$koneksi->query("INSERT INTO produk (nama_produk,stock,harga,foto_produk) VALUES('$_POST[nama]','$_POST[stock]','$_POST[harga]','$nama')");

	echo "<div class='alert alert-info'>Data tersimpan</div>";
	echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=produk'>";

}
?>
