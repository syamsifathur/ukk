<h2>Daftar Pelanggan</h2>

<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Nama</label>
		<input type="text" class="form-control" name="nama" required>
	</div>
	<div class="form-group">
		<label>Email</label>
		<input type="text" class="form-control" name="email" required>
	</div>
	<div class="form-group">
		<label>No.hp</label>
		<input type="number" class="form-control" name="nohp" required>
	<button class="btn btn-primary" name="save">Simpan</button>
</form>
<?php 
if (isset($_POST['save'])) {
	
mysqli_query($koneksi,"INSERT INTO pelanggan (nama_lengkap,email,no_hp) VALUES('$_POST[nama]','$_POST[email]','$_POST[nohp]')");

	echo "<div class='alert alert-info'>Data tersimpan</div>";
	echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=pelanggan'>";

}
?>