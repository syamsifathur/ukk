<h2>Edit Pelanggan</h2>

<?php 
$ambil=$koneksi->query("SELECT * FROM pelanggan WHERE id_pelanggan='$_GET[id]'");
$pecah=$ambil->fetch_assoc();

?>

<form method="post">
	<div class="form-group">
		<label>Nama</label>
		<input type="text" name="nama" class="form-control" value="<?php echo $pecah['nama_lengkap']; ?>">
	</div>
	<div class="form-group">
		<label>Email</label>
		<input type="text" name="email" class="form-control" value="<?php echo $pecah['email']; ?>">
	</div>
	<div class="form-group">
		<label>No.Hp</label>
		<input type="number" name="nohp" class="form-control" value="<?php echo $pecah['no_hp']; ?>">
	</div>
	<button class="btn btn-primary" name="updatee">Ubah</button>
</form>

<?php 
if (isset($_POST['updatee'])) 
{
	$koneksi->query("UPDATE pelanggan SET nama_lengkap='$_POST[nama]',email='$_POST[email]',no_hp='$_POST[nohp]' WHERE id_pelanggan='$_GET[id]'");

	echo "<script>alert('data pelanggan telah diubah');</script>";
	echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=pelanggan'>";
}
?>