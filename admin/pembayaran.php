<h2>Data Pembayaran</h2>

<?php 
// mendapatkan id_pembelian dari url
$id_pembelian = $_GET['id'];

//mengambil data pembayaran berdasarkan id_pembelian
$ambil = $koneksi->query("SELECT*FROM pembayaran WHERE id_pembelian='$id_pembelian'");
$detail = $ambil->fetch_assoc();

?>

<div class="row">
	<div class="col-md-6">
		<table class="table">
			<tr>
				<th>Nama</th>
				<td><?php echo $detail['nama'] ?></td>
			</tr>
			<tr>
				<th>Bank</th>
				<td><?php echo $detail['bank'] ?></td>
			</tr>
			<tr>
				<th>Jumlah</th>
				<td><?php echo number_format($detail['jumlah']) ?></td>
			</tr>
			<tr>
				<th>Tanggal</th>
				<th><?php echo $detail['tanggal'] ?></th>
			</tr>
		</table>
	</div>
	<div class="col-md-6">
		<img src="../bukti_pembayaran/<?php echo $detail['bukti'] ?>" alt="bukti" width="250">
	</div>
</div>

<form method="post">
	<div class="form-group">
		<label>Status</label>
		<select name="status" class="form-control">
			<option value="">Pilih Status</option>
			<option value="Bukti Pembayaran Tidak valid">Bukti Pembayaran Tidak Valid</option>
			<option value="Sudah Dikirim">Sudah Dikirim</option>
			<option value="Batal">Batal</option>
		</select>
	</div>
	<button class="btn btn-primary" name="proses">Proses</button>
</form>

<?php 
if (isset($_POST["proses"])) 
{
	$status = $_POST["status"];
	$koneksi->query("UPDATE pembelian SET status_pembelian='$status' WHERE id_pembelian='$id_pembelian'");

	echo "<script>alert('Data Pembelian Terupdate');</script>";
    echo "<script>location='index.php?halaman=pembelian';</script>";
}
?>